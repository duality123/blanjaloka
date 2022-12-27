<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\LoginResponse;
use Inertia\Inertia;
use Laravel\Fortify\Contracts\LogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse
        {
            public function toResponse($request)
            {
                return redirect('/halaman_verifikasi');
            }
        });

        $this->app->instance(LoginResponse::class, new class implements LoginResponse
        {
            public function toResponse($request)
            {

              $request->session()->flash('success','Selamat datang');
              if ($request->user()->Role->number == 2 ) {
                if ($request->user()->accepted == 1 ) {
                    return redirect('/profil/1');
                }
                else{
                    return redirect('/profil/1');
                }
            }
               elseif ($request->user()->Role->number == 3 ){
                if ($request->user()->accepted == 1 ) {
                    return redirect('/profil/1');
                }
                else{
                    return redirect('/profil/1');
                }
                }
                
                elseif($request->user()->Role->number == 1){
                         return redirect('/admin/dashboard/');
                    }
                }
        });

        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse
        {
            public function toResponse($request)
            {
                return redirect('/');
            }
        });
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        //login
        Fortify::loginView(function () {
            return Inertia::render('Auth/Login');
        });

        Fortify::verifyEmailView(function (Request $request) {
            return Inertia::render('Auth/Confirmation_email',['request'=>$request->email]);
        });


        Fortify::registerView(function () {
            return Inertia::render('Auth/Register');
        });

        //forgot
        Fortify::requestPasswordResetLinkView(function (Request $request) {
            return Inertia::render('Auth/Reset_password');
        });

        //reset
        Fortify::resetPasswordView(function (Request $request) {
            return Inertia::render('Auth/Change_password_via_reset_email',['request'=>$request->route('token')]);
        });
    }
}
