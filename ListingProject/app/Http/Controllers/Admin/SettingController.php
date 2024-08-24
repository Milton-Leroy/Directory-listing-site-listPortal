<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingService;
use App\Traits\FileUploadTrait;
use Artisan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    use FileUploadTrait;
    function __construct()
    {
        $this->middleware(['permission:setting index']);
    }
    public function index(): View
    {
        return view("admin.settings.index");
    }

    public function updateGeneralSettings(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'site_name' => ['required', 'max:255'],
            'site_email' => ['required', 'max:255', 'email'],
            'site_phone' => ['required', 'max:255'],
            'site_timezone' => ['required', 'max:255'],
            'site_default_currency' => ['required', 'max:3'],
            'site_currency_icon' => ['required'],
            'site_currency_position' => ['required', 'in:right,left'],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(SettingService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Settings saved successfully!');

        Artisan::call('config:cache');

        return redirect()->back();
    }
    public function updatePusherSettings(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'pusher_app_id' => ['required'],
            'pusher_app_key' => ['required'],
            'pusher_secret_key' => ['required'],
            'pusher_cluster' => ['required'],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(SettingService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Settings saved successfully!');

        return redirect()->back();
    }

    public function updateLogoSettings(Request $request): RedirectResponse
    {

        $validatedData = $request->validate([
            'logo' => ['nullable', 'image'],
            'favicon' => ['nullable', 'image'],
        ]);

        $logoPath = $this->uploadImage($request, 'logo', $request->old_logo);
        $faviconPath = $this->uploadImage($request, 'favicon', $request->old_favicon);

        Setting::updateOrCreate(
            ['key' => 'logo'],
            ['value' => !empty($logoPath) ? $logoPath : $request->old_logo]
        );

        Setting::updateOrCreate(
            ['key' => 'favicon'],
            ['value' => !empty($faviconPath) ? $faviconPath : $request->old_favicon]
        );

        $settingsService = app(SettingService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Settings saved successfully!');

        return redirect()->back();
    }

    public function updateAppearanceSettings(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'site_default_color' => 'required'
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(SettingService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Settings saved successfully!');

        return redirect()->back();
    }
}
