<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

// Tambahkan dua baris ini untuk memanggil Interface dan Repository
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;

// Tambahkan dua baris ini untuk memanggil Model dan Observer
use App\Models\StockMovement;
use App\Observers\StockMovementObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Daftarkan binding Repository di sini
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    // Daftarkan Observer
        StockMovement::observe(StockMovementObserver::class);
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}