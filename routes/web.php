<?php
use Illuminate\Support\Facades\Route;

// Auth Controllers
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// User Controllers
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\User\WithdrawalController;
use App\Http\Controllers\User\InvestmentController;

// Admin Controllers
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\SettingsController;

// ─── Home ───────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

// ─── Auth Routes ────────────────────────────────────
Route::get('/login',          [LoginController::class, 'showLogin'])->name('login');
Route::post('/login',         [LoginController::class, 'login']);
Route::get('/register',       [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register',      [RegisterController::class, 'register']);
Route::post('/logout',        [LoginController::class, 'logout'])->name('logout');

// ─── User Routes (protected) ────────────────────────
Route::middleware(['auth.user'])->prefix('dashboard')->name('user.')->group(function () {
    Route::get('/',                        [DashboardController::class, 'index'])->name('dashboard');

    // Investments
    Route::get('/investments',             [InvestmentController::class, 'index'])->name('investments');
    Route::get('/investments/crypto',      [InvestmentController::class, 'crypto'])->name('investments.crypto');
    Route::get('/investments/stocks',      [InvestmentController::class, 'stocks'])->name('investments.stocks');
    Route::get('/investments/realestate',  [InvestmentController::class, 'realestate'])->name('investments.realestate');
    Route::post('/investments/buy',        [InvestmentController::class, 'buy'])->name('investments.buy');

    // Deposits
    Route::get('/deposit',                 [DepositController::class, 'index'])->name('deposit');
    Route::post('/deposit',                [DepositController::class, 'store'])->name('deposit.store');

    // Withdrawals
    Route::get('/withdrawal',              [WithdrawalController::class, 'index'])->name('withdrawal');
    Route::post('/withdrawal',             [WithdrawalController::class, 'store'])->name('withdrawal.store');

    // Transactions
    Route::get('/transactions',            [DashboardController::class, 'transactions'])->name('transactions');

    // Profile
    Route::get('/profile',                 [DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile',                [DashboardController::class, 'updateProfile'])->name('profile.update');
});

// ─── Admin Routes (protected) ───────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Login (not protected)
    Route::get('/login',   [AdminDashboardController::class, 'showLogin'])->name('login');
    Route::post('/login',  [AdminDashboardController::class, 'login']);
    Route::post('/logout', [AdminDashboardController::class, 'logout'])->name('logout');

    // Admin Protected Routes
    Route::middleware(['auth.admin'])->group(function () {
        Route::get('/dashboard',                    [AdminDashboardController::class, 'index'])->name('dashboard');

        // Users
        Route::get('/users',                        [UserController::class, 'index'])->name('users');
        Route::get('/users/{id}',                   [UserController::class, 'show'])->name('users.show');
        Route::post('/users/{id}/suspend',          [UserController::class, 'suspend'])->name('users.suspend');
        Route::post('/users/{id}/activate',         [UserController::class, 'activate'])->name('users.activate');

        // Transactions
        Route::get('/transactions',                 [TransactionController::class, 'index'])->name('transactions');
        Route::post('/transactions/{id}/approve',   [TransactionController::class, 'approve'])->name('transactions.approve');
        Route::post('/transactions/{id}/reject',    [TransactionController::class, 'reject'])->name('transactions.reject');

        // Settings
        Route::get('/settings',                     [SettingsController::class, 'index'])->name('settings');
        Route::post('/settings',                    [SettingsController::class, 'update'])->name('settings.update');
    
    });
});
// Forgot Password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', function () {
    return back()->with('status', 'If that email exists, a reset link has been sent!');
})->name('password.email');