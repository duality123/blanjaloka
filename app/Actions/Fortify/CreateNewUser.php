<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $input['no_telepon'] = '+62'.$input['no_telepon'];
        $rules =  [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:Users',
            ],
            'password' => ['required','min:8',],
            'no_telepon' => ['required','min:9','max:15','unique:Users',]
        ];
        $message = [
              'email.required' => 'Email wajib diisi, silahkan isi sesuai data anda !',
              'password.required' => 'Password wajib diisi, silahkan isi sesuai data anda !',
              'no_telepon.required' => 'No telepon wajib diisi, silahkan isi sesuai data anda !',
              'no_telepon.unique' => 'No telepon tersebut sudah ada yang menggunakan !',
              'email.unique' => 'Email tersebut sudah ada yang menggunakan !'

        ];
        $validator = Validator::make($input,$rules,$message)->validate();

        $user = User::create([
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'no_telepon' => $input['no_telepon'],
                'role' => 3
                ]);
        
        if ($input['investor']) {
            Role::where('user_id','=',$user->id)->update(['number'=>3]);
            $user->profilPerusahaan()->create([]);
            $user->dokumenPerusahaan()->create([]);
        }
        elseif($input['umkm']){
            Role::where('user_id','=',$user->id)->update(['number'=>2]);
            $user->profil()->create([]);
            $user->usaha()->create([]);
            $user->produk()->create([]);
            $user->finansial()->create([]);
        }
        return  $user;

    }
}
