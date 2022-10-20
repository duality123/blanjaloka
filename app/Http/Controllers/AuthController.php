<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function emailVerificationNotice()
    {
        return Inertia::render('Auth/Confirmation_email');
    }

    public function emailVerificationVerify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/email/verify/success');
    }

    public function emailVerificationSend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function emailVerificationSuccess()
    {
        return Inertia::render('Auth/EmailSuccess');
    }



    public function providerCallback($provider)
    {
        $provider_user = Socialite::driver($provider)->user();
        $find_user = User::where('email', $provider_user->email)->first();
        if ($find_user) {
            Auth::login($find_user);
            return redirect()->intended('/');
        }
        $user = User::updateOrCreate([
            'provider_id' => $provider_user->id,
        ], [
            'name' => $provider_user->name,
            'email' => $provider_user->email,
            'password' => null,
            'email_verified_at' => now(),
            'provider_id' => $provider_user->id,
            'provider_token' => $provider_user->token
        ]);

        Auth::login($user);
        return redirect()->intended('/');
    }
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
}
