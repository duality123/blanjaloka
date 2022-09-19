<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\verify_user;
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

        $user = User::updateOrCreate([
            'google_id' => $provider_user->id,
        ], [
            'name' => $provider_user->name,
            'email' => $provider_user->email,
            'password' => null,
            'email_verified_at' => now(),
            'google_id' => $provider_user->id,
            'google_token' =>$provider_user->token
        ]);

        Auth::login($user);
        return redirect()->intended('/');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
}
