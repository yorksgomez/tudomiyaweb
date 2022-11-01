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
        $domi = Domi::create();
        User::create( [
            'name'=>'domitest',
            'lastname'=>'domitest',
            'email'=>'domi@gmail.com',
            'phone'=>'3187132627',
            'nit'=>'1000123962',
            'password'=>'abc12345',
            'role_type'=>'\App\Models\Domi',
            'role_id'=>$domi->id
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
