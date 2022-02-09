<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Apellido;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\SeederUsuarioAdmin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Apellido::factory(100)->create();
        $this->call([SeederUsuarioAdmin::class]);
    }
}
