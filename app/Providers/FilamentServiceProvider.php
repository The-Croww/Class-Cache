<?php

namespace App\Providers;

use Filament\Panel;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->brandName('Class Cache');
    }

    public function register()
    {
        // Register any application services.
    }

    public function boot()
    {
        // Bootstrap any application services.
    }
}
