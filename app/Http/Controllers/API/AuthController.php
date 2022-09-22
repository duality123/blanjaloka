<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function providerCallback($provider)
    {
        $provider_user = Socialite::driver($provider)->stateless()->user();
        $find_user = User::where('email',$provider_user->email)->first();
        if($find_user){
            Auth::login($find_user);
            return ResponseFormatter::success($find_user,'success get user');
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

        Auth::login($user);
        return ResponseFormatter::success($user, 'user created success');
    }
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }
}
