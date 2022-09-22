<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Resources\AuthResource;

class AuthController extends Controller
{
    public function providerCallback($provider)
    {
        $provider_user = Socialite::driver($provider)->stateless()->user();
        $find_user = User::where('email',$provider_user->email)->first();
        if($find_user){
            $find_user->createToken('myapptoken')->plainTextToken;
            return response(new AuthResource($find_user,'Selamat datang kembali.'));
        }
            $user = User::updateOrCreate([
                'provider_id' => $provider_user->id,
            ], [
                'name' => $provider_user->name,
                'email' => $provider_user->email,
                'password' => null,
                'email_verified_at' => now(),
                'provider_id' => $provider_user->id,
                'provider_token' =>$provider_user->token
            ]);
            $user->createToken('myapptoken')->plainTextToken;
            return response(new AuthResource($user, 'Selamat bergabung'));
    }


    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }
}
