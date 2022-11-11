<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Domi;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create( [
            'name'=>'administrador',
            'lastname'=>'tudomiya',
            'email'=>'administradordomiya@gmail.com',
            'phone'=>'30000000',
            'nit'=>'0000000000',
            'password'=> bcrypt('admdomiya2022*'),
            'role_type'=>'Admin',
            'role_id'=>0
        ]);

        $id = Domi::create()->id;

        User::create( [
            'name'=>'domi',
            'lastname'=>'domi',
            'email'=>'domi@gmail.com',
            'phone'=>'30000000',
            'nit'=>'0000000000',
            'password'=> bcrypt('admdomiya2022*'),
            'role_type'=>'App\\Models\\Domi',
            'role_id'=>$id
        ]);

    }
}
