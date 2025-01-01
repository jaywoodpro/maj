<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Infolists\Infolist;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentView;
use Filament\Tables\Table;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
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
        Table::$defaultDateDisplayFormat = 'Y-m-d';
        Table::$defaultDateTimeDisplayFormat = 'Y-m-d (H:i:s)';
        Infolist::$defaultDateDisplayFormat = 'Y-m-d';
        Infolist::$defaultDateTimeDisplayFormat = 'Y-m-d (H:i:s)';
        FilamentView::registerRenderHook(
            PanelsRenderHook::SIDEBAR_NAV_START,
            fn (): string => view('filament::components.back-to-home')->render()
        );
    }
}
