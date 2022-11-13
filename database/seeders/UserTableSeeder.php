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
<<<<<<< HEAD
        for ($i=0; $i <102 ; $i++) {
          $user = User::create([
              'name'      => 'Administrator',
              'email'     => 'admin@'.$i.'gmail.com',
              'password'  => bcrypt('12345678'),
              'role'      => 'umkm',
          ]);

        }


=======
        //create user
        $user = User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('adminblanjaloka1522'),
        ]);

        //get all permissions
        $permissions = Permission::all();

        //get role admin
        $role = Role::find(1);

        //assign permission to role
        $role->syncPermissions($permissions);

        //assign role to user
        $user->assignRole($role);
>>>>>>> 4d26dc5c2536a724370326f1054053f22d834f13
    }
}
