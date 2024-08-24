<?php

namespace App\Providers;

use App\Services\SettingService;
use Illuminate\Support\ServiceProvider;

class SettingsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingService::class, function () {
            return new SettingService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $settingService = $this->app->make(SettingService::class);
        $settingService->setGlobalSettings();
    }
}
