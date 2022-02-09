<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Apellido;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getRolAttribute(): string{
        if($this->role === 'admin')
            return 'Administrador';

        return $this->role === 'seller' ? 'Vendedor':'Cliente';        
    }

    public function r_lastname(){
        return $this->hasOne(Apellido::class, 'user_id', 'id');
    }

    public function scopeTermino($query, $termino){
        if($termino == '') return;

        return $query->where('name','like', "%{$termino}%")
                ->orWhere('email','like', "%{$termino}%")
                ->orWhereHas('r_lastname',function($query2) use ($termino){
                    $query2->where('lastname', 'like', "%{$termino}%");
                });
    }

    public function scopeRole($query, $role){
        if($role == '') return;
        
        return $query->whereRole($role);
    }

}
