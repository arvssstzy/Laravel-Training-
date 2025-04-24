<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

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
        Schema::defaultStringLength(191);

         // Get the last invoice record from the database to generate the next ID
        $lastInvoice = DB::table('invoices')->orderBy('id', 'desc')->first();
        $nextId = $lastInvoice ? $lastInvoice->id + 1 : 1;

        // Generate the formatted ID like 'INV-00001'
        $formattedId = 'INV-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        // Share the formatted invoice number with all views
        View::share('formattedInvoiceId', $formattedId);
    }
}
