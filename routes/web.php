<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Settings\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificaitonController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StaffSalaryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionFeeController;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\PushNotification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */
//require __DIR__.'/auth.php';
Route::get('test', function () {
    event(new App\Events\NotificationStatus('notification-send'));
    return "Event has been sent!";
});
Route::get('web_page', function () {
    return view('welcome');
});
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('logout', function () {
        Session::flush();
        Auth::logout();
        return redirect('login');
    });
    Route::get('home', function () {
        return view('home');
    });
    Route::post('store_token', [UserController::class, 'store_token'])->name('store.token');
    Route::post('/send-web-notification', [UserController::class, 'sendNotification'])->name('send.web-notification');
    Route::get('/send-whatsapp', [UserController::class, 'sendWhatsAppMessage']);
    Route::resource('fetch-notification', NotificaitonController::class);
    Route::get('queue_run', function () {
        Artisan::call('queue:listen');
        dd('done');
    });
    Route::get('all-notifications', [NotificaitonController::class, 'all_notifications'])->name('all-notifications');
    Route::resource('transaction-fee', TransactionFeeController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('currency', CurrencyController::class);
    Route::get('transaction-fee-by-branch/{branch_id}', [TransactionFeeController::class, 'getFeeByBranch'])->name('transaction.fee.by.branch');
    Route::put('transaction/{id}/{status}', [TransactionController::class, 'updateStatus'])->name('transaction.updateStatus');
    Route::get('rec_transaction', [TransactionController::class, 'rec_transaction'])->name('rec_transaction');
    Route::prefix('accounts')->group(function () {
        Route::resource('staff-salaries', StaffSalaryController::class);
        Route::resource('expenses', ExpenseController::class);
    });
    Route::prefix('reports')->group(function () {
        Route::get('branch-summary', [ReportController::class, 'branch_summary'])->name('reports.branch-summary');
        Route::get('profit-report', [ReportController::class, 'profit_report'])->name('profit.report');
    });
});
