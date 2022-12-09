<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Policies\AdminPolicy;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [




        'App\Models\Model' => 'App\Policies\AdminPolicy',
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('visit-page', function ($condition) {
            return $condition;
        });
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
        return (new MailMessage)
            ->subject('Verifikasi Email Blanjaloka')
            ->markdown('email.email_konfirmasi', ['token' => $url]);
    });

    }
}
