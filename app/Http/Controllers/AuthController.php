<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Twilio\Rest\Client;
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

    public function createOTP()
    {
        $data = auth()->user();
        /* Get credentials from .env */
        $token = env("TWILIO_AUTH_TOKEN");
        $twilio_sid = env("TWILIO_SID");
        $twilio_verify_sid = env("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($data['no_telepon'], "sms");

        return Inertia::render('Auth/OTPValidation', ['no_telepon' => $data['no_telepon']]);
    }

    public function otpVerify(Request $request)
    {

        $data = $request->validate([
            'otp' => ['required'],
            'no_telepon' => ['required', 'string'],
        ]);


        /* Get credentials from .env */
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create(['code' => $data['otp'], 'to' => $data['no_telepon']]);
        if ($verification->valid) {
            $user = tap(User::where('no_telepon', $data['no_telepon']))->update(['isVerified' => true]);
            return redirect()->intended('/')->with(['message' => 'Phone number verified']);
        }

        return back()->with(['no_telepon' => $data['no_telepon'], 'error' => 'Invalid verification code entered!']);
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
