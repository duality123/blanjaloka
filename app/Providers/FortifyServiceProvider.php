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
<<<<<<< HEAD

=======
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\LoginResponse;
>>>>>>> 8fab310b5485797573cffc3009e98b4dae5ae271
class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
<<<<<<< HEAD
        //
=======
		$this->app->instance(RegisterResponse::class, new class implements RegisterResponse {
        public function toResponse($request)
        {
            return redirect('email/verify');
        }
    });
        
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
        public function toResponse($request)
        {
            return redirect('/');
        }
    });
        
>>>>>>> 8fab310b5485797573cffc3009e98b4dae5ae271
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
<<<<<<< HEAD
=======
        
        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset_password', ['request' => $request]);
        });
        
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot_password');
        });
		Fortify::loginView(function () {
			return view('auth.login');
		});
		Fortify::registerView(function () {
			return view('auth.register');
		});
		Fortify::verifyEmailView(function () {
            return view('auth.page_konfirmasi');
        });
>>>>>>> 8fab310b5485797573cffc3009e98b4dae5ae271

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

<<<<<<< HEAD
            return Limit::perMinute(5)->by($email . $request->ip());
=======
            return Limit::perMinute(5)->by($email.$request->ip());
>>>>>>> 8fab310b5485797573cffc3009e98b4dae5ae271
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
<<<<<<< HEAD

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });
=======
>>>>>>> 8fab310b5485797573cffc3009e98b4dae5ae271
    }
}
