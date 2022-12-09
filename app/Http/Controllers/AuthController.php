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

    public function providerCallback($provider,Request $request)
    {
        $provider_user = Socialite::driver($provider)->user();
        $find_user = User::where('email',$provider_user->email)->first();
        if($find_user){
            Auth::login($find_user);
            $request->session()->flash('success','Selamat datang');
            if($find_user->Role->number == 1){
                 return redirect()->intended('admin/dashboard/');
            }
            else if ($find_user->Role->number == 2){
                return redirect()->intended('umkm/dashboard/');
            }
            else if ($find_user->Role->number == 3){
                return redirect()->intended('investor/dashboard/');
            }
           
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

        $request->session()->flash('success','Selamat datang');
        if($user->Role->number == 1){
                 return redirect()->intended('admin/dashboard/');
            }
        elseif ($find_user->Role->number == 2){
                return redirect()->intended('umkm/dashboard/');
            }
        elseif ($find_user->Role->number == 3){
                return redirect()->intended('investor/dashboard/');
            }
        
    }
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }





 

}
