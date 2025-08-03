<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\Staff\RequestController as StaffRequestController;
use App\Http\Controllers\Staff\AssignmentController as StaffAssignmentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Inventory\EquipmentController;
use App\Http\Controllers\Inventory\SupplyController;

Route::middleware(['auth','role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
    Route::post('/requests', [StaffRequestController::class, 'store'])->name('requests.store');
    Route::post('/assignments/{assignment}/sign-off', [StaffAssignmentController::class, 'signOff'])->name('assignments.signoff');
});

Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/system', [SystemController::class, 'edit'])->name('system.edit');
    Route::post('/system', [SystemController::class, 'update'])->name('system.update');
});

Route::middleware(['auth','role:admin|manager'])->prefix('inventory')->name('inventory.')->group(function () {
    Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipment.index');
    Route::post('/equipment', [EquipmentController::class, 'store'])->name('equipment.store');
    Route::get('/supplies', [SupplyController::class, 'index'])->name('supplies.index');
    Route::post('/supplies', [SupplyController::class, 'store'])->name('supplies.store');
});

