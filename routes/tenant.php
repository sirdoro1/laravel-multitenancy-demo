<?php

declare(strict_types=1);

use App\Http\Controllers\Tenants\Auth\LoginController;
use App\Http\Controllers\Tenants\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Tenants\HomeController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function(){
        return view('tenants.welcome');
    });

    Route::get('/login',[LoginController::class,'showLoginForm']);
    Route::get('/register',[RegisterController::class,'showLoginForm']);
});
