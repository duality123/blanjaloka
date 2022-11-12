<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <102 ; $i++) {
          $user = User::create([
              'name'      => 'Administrator',
              'email'     => 'admin@'.$i.'gmail.com',
              'password'  => bcrypt('12345678'),
              'role'      => 'umkm',
          ]);

        }


    }
}
