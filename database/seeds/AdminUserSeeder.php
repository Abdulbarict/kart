<?php

use Illuminate\Database\Seeder;
use App\User;
use Cviebrock\EloquentSluggable\Services\SlugService; 

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'name' => 'admin',
            'username'=>'admin',
            'email' => 'admin@gmail.com',
            'mobile' =>'9453219919',
            'password' => bcrypt('admin@2020'),
            'is_superadmin' =>1,
        ]);
        User::updateOrCreate([
            'name' => 'demouser',
            'username'=>'demo',
            'email' => 'demo@demo.com',
            'mobile' =>'9453219956',
            'password' => bcrypt('password'),
        ]);
    }
}
