<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function providerCallback($provider)
    {
        $provider_user = Socialite::driver($provider)->user();
        $find_user = User::where('email',$provider_user->email).first()
        if($find_user){
             $this->loginAndRedirect($provider_user);
             return
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

        $this->loginAndRedirect($provider_user);
        return
    }
    public function loginAndRedirect($user){
        Auth::login($user);
        return redirect()->intended('/');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
}
