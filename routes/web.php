<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('dashboard');
});

Auth::routes(['verify' => true, 'register' => false]);


Route::get('/home', function () {
    return redirect('dashboard');
});

Route::get('/dashboard', 'DashboardController@index')->name('home');

require __DIR__ . '/profile/profile.php';
require __DIR__ . '/users/users.php';
require __DIR__ . '/roles/roles.php';
require __DIR__ . '/roles/permissions.php';
require __DIR__ . '/modules/modules.php';
require __DIR__ . '/services/services.php';
require __DIR__ . '/contacts/contacts.php';
require __DIR__ . '/contacts/contact_has_services.php';
require __DIR__ . '/installation_orders/installation_orders.php';
require __DIR__ . '/installation_orders/installation_orders_statuses.php';
require __DIR__ . '/promotions/promotions.php';
require __DIR__ . '/services/services_statuses.php';
require __DIR__ . '/invoices/invoices.php';



