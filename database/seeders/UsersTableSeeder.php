<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    private static $password;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('users')->insert(
        //     [
        //         'name' => 'Administrador',
        //         'email' => 'admin@gmail.com',
        //         'email_verified_at' => now(),
        //         'password' => static::$password ??= Hash::make('password'),
        //         'remember_token' => 'dskfdhfçasdlhfkasdlfh',
        //     ]
        // ); 
        
        User::factory()->count(40)->create()->each(function($user) {
            $store = Store::factory()->make();
            $user->store()->save($store);
        });
    }
}
