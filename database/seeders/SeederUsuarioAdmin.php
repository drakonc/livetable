<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Apellido;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SeederUsuarioAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Jose Alfonso',
            'email' => 'jcastro@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$16CbMKiccwMT6M3v/GBdfecm.KpRsX2.6lJhDyZuGsf7aq.bJIq9.', // Passw0rd!!
            'remember_token' => Str::random(10),
        ]);

        Apellido::factory()->create([
            'user_id' => $user->id,
            'lastname' => 'Castro Cantillo'
        ]);
    }
}
