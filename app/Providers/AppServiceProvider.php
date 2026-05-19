<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // <--- Tambah Use ini

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Beritahu Laravel untuk gunakan design Tailwind bagi Pagination
        Paginator::useTailwind();
    }
}
