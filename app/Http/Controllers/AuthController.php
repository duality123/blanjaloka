<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\verify_user;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function login(){
		if(Auth::check()){
			return redirect('/home');
		}
		
		return view('auth.login');
		
	}
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
     }
    }
    
    public function resetPasswordPage(){
        return view('auth.reset_password');
    }
    
    public function resetPasswordProcess(Request $request){
        $target = User::where('email',$request->email).first();
        $redirect = 'reset_page';
        if(!is_null($target)){
             Mail::send('email.email_konfirmasi', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Email Platform Blanjaloka');
              $redirect = 'notificationResetPage';
         });
        }
        return redirect()->route($redirect)->with('message',$message);
        
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function register(){
        return view('auth.register');
        
    }
	
	public function proses_konfirmasi(Request $request){
		$newUser = User::create(['name'=>$request->name,
						  'email'=>$request->email,
						  'password'=>Hash::make($request->password)]);
			
		
		 $token = Str::random(5);
        
  
		 verify_user::create([
              'user_id' => $newUser->id, 
              'token' => $token
          ]);	
          
         Mail::send('email.email_konfirmasi', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Verifikasi Email Blanjaloka');
         });
         
        return redirect()->route('page_konfirmasi',$newUser->id);  
	}
    
    public function page_konfirmasi($id){
        $cek =User::where("id",$id)->first();
        if(is_null($cek) ||$cek->is_verified){
            return redirect('/');
        }
        return view('auth.page_konfirmasi');
    }
	
	public function tokenInputVerify(Request $request){
        $message = "Token anda salah";
        $target = 'page_konfirmasi';
       
        $getUser = verify_user::where('token', $request->token)->first();
        if($getUser){
            if(time()-$getUser->dibuat >= 86400){
                $message = "Token anda telah hangus , silahkan register ulang :)";
                $target = 'register';
            }
            else{
                $user = $getUser->user;
                $user->is_verified = 1;
                $user->save();
                $message = "Akun anda telah diverifikasi, sekarang silahkan login :)";
                $target = 'login';
            }
        

        }
		return redirect()->route($target,$request->id)->with('message', $message);
	}
    
    public function tokenLinkVerify($token){
        $message = "Link telah hangus, lakukan register ulang !";
        $target = 'page_konfirmasi';
        $getUser = verify_user::where('token', $token)->first();
        if($getUser){
            if(time()-$getUser->dibuat >= 86400){
                $message = "Token anda telah hangus , silahkan register ulang :)";
                $target = 'register';
            }
            else{
                $user = $getUser->user;
                $user->is_verified = 1;
                $user->save();
                $message = "Akun anda telah diverifikasi, sekarang silahkan login :)";
                $target = 'login';
            }
       

        }
		return redirect()->route($target,$getUser->user->id)->with('message', $message);
        
        
    }
}
