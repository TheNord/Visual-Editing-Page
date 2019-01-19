<?php

namespace App\Providers;

use App\Http\ViewComposers\MenuPagesComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // when rendering layouts.app inject MenuPagesComposer
        View::composer('layouts.app', MenuPagesComposer::class);
    }
}