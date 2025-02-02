<?php

namespace App\Providers;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application service.
     */
    public function register(): void
    {
        //
    }
    
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(callback: function ($notifiable, $url) {
            return (new MailMessage)
              ->subject("subject")
              ->line("verify")
              ->greeting("Hello !")
              ->action("verification subject", $url)
              ->line("info")
              ->salutation("text");
        });
    }
}