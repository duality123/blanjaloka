<?php

namespace App\Actions\Fortify;

use App\Models\User;
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
        $rules =  [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => ['required','min:8',],
            'no_telepon' => ['required','min:9','max:20',Rule::unique(User::class),],
        ];
        $message = [
              'email.required' => 'Email wajib diisi, silahkan isi sesuai data anda !',
              'password.required' => 'Password wajib diisi, silahkan isi sesuai data anda !',
              'no_telepon.required' => 'No telepon wajib diisi, silahkan isi sesuai data anda !'

        ];
        $validator = Validator::make($input,$rules,$message)->validate();


        return User::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'no_telepon' => '+62'.$input['no_telepon'],
            'role' => 3
        ]);
    }
}
