<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


Route::middleware(['web'])->group(function () {
    Route::get('/role/fetch', [RoleController::class, 'fetch'])->name('panel.super_admin_role.fetch');

    Route::resource('role', RoleController::class)->names([
        'index' => 'panel.super_admin_role.index',
        'create' => 'panel.super_admin_role.create',
        'store' => 'panel.super_admin_role.store',
        'edit' => 'panel.super_admin_role.edit',
        'update' => 'panel.super_admin_role.update',
        'show' => 'panel.super_admin_role.show',
        'destroy' => 'panel.super_admin_role.destroy'
    ]);
});