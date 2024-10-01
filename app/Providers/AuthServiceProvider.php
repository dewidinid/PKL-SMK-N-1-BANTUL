<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Pemetaan kebijakan untuk aplikasi.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Mendaftarkan layanan otentikasi/otorisasi.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
