<?php

use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\WithdrawalRequestsController;
use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Investor\DashboardController as InvestorDashboard;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\OfferingsController;
use App\Http\Controllers\Admin\OfferingsTypeController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\AccreditedInvestorController;
use App\Http\Controllers\Admin\settingsController;
use App\Http\Controllers\Investor\FundsController;
use App\Http\Controllers\Investor\BankAccountController;
use App\Http\Controllers\Investor\TransactionsController as InvestorTransactionsController;
use App\Http\Controllers\Investor\AccountSettingsController;
use App\Http\Controllers\Investor\InvestorInvestmentsController;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

// General Routes
Route::get('/', [GeneralController::class, 'home'])->name('home');
Route::get('about-us', [GeneralController::class, 'aboutUs'])->name('about-us');
Route::get('contact-us', [GeneralController::class, 'contactUs'])->name('contact-us');
Route::group(['prefix' => 'offerings'], function () {
    Route::get('open-investments/{filter_type?}/{param?}', [GeneralController::class, 'openInvestments'])->name('open-investments');
    Route::get('fully-funded/{filter_type?}/{param?}', [GeneralController::class, 'fullyFunded'])->name('fully-funded');
    Route::get('past-investments/{filter_type?}/{param?}', [GeneralController::class, 'pastInvestments'])->name('past-investments');
    Route::get('details/{id}', [GeneralController::class, 'offeringDetails'])->name('offering-details');
    Route::group(['middleware' => ['auth', 'investor', 'user.verified', 'disabled']], function () {
        Route::get('details/invest/{id}', [GeneralController::class, 'offeringDetailsInvest'])->name('offering-details.invest');
    });
});
Route::get('/test', function (){
    \App\Models\User::find(1)->notify((new TestNotification())->delay(now()->addSecond(5)));
    dd("asdasd");
})->name('test');


// Admin Routes
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    //Users Route
    Route::get('users/listing', [UsersController::class, 'index'])->name('users.list');
    Route::get('users', [UsersController::class, 'users'])->name('users');
    Route::post('users', [UsersController::class, 'usersStatusChange'])->name('users.status.change');
    Route::get('users/{user}', [UsersController::class, 'show'])->name('users.show');
    Route::get('users/offering-investments/{user_id}', [UsersController::class, 'showOfferingInvestments'])->name('users.offering-investments');

    //Accredited Users
    Route::get('users/accredited/listing', [UsersController::class, 'accreditedListing'])->name('users.accredited.list');
    Route::get('users/accredited', [UsersController::class, 'accreditedUsers'])->name('users.accredited');

    //Newsletter Routes
    Route::get('newsletter/listing', [NewsletterController::class, 'index'])->name('newsletter.list');
    Route::get('newsletter', [NewsletterController::class, 'newsletter'])->name('newsletter');
    Route::post('newsletter/user/remove', [NewsletterController::class, 'newsletterRemove'])->name('newsletter.user.remove');
    //Export Routes
    Route::get('file/export/csv', [NewsletterController::class, 'exportCsv'])->name('export.csv');
    Route::get('file/export/xlsx', [NewsletterController::class, 'exportExcel'])->name('export.xlsx');

    //Offerings Route
    Route::get('offerings/current/listing', [OfferingsController::class, 'currentOffering'])->name('offerings.current.list');
    Route::get('offerings/completed/listing', [OfferingsController::class, 'completedOffering'])->name('offerings.completed.list');
    Route::get('offerings', [OfferingsController::class, 'offerings'])->name('offerings');
    Route::get('offerings/investments/{offering}', [OfferingsController::class, 'offeringInvestments'])->name('offerings.investments');
    Route::get('offerings/investments/list/{offering}', [OfferingsController::class, 'offeringInvestmentList'])->name('offerings.investments.list');

    Route::get('offerings/create', [OfferingsController::class, 'create'])->name('offerings.create');
    Route::post('offerings/create', [OfferingsController::class, 'save'])->name('offerings.create.post');

    Route::get('offerings/view/{id}', [OfferingsController::class, 'view'])->name('offerings.view');

    Route::get('offerings/edit/{id}', [OfferingsController::class, 'edit'])->name('offerings.edit');
    Route::post('offerings/update', [OfferingsController::class, 'update'])->name('offerings.update');

    Route::post('offerings/attachments/delete', [OfferingsController::class, 'deleteAttachments'])->name('offerings.attachments.delete');

    //Offering Marked as Completed
    Route::get('offerings/marked/completed/{id}', [OfferingsController::class, 'markedCompletedGet'])->name('offerings.marked.completed');
    Route::post('offerings/marked/completed', [OfferingsController::class, 'markedCompletedPost'])->name('offerings.marked.completed.post');

    //Offering Documents Required
    Route::post('offerings/document/remove/required', [OfferingsController::class, 'removeRequired'])->name('offerings.document.remove.required');

    //Transactions Route
    Route::get('transactions/listing', [TransactionsController::class, 'listTransactions'])->name('transactions.list');
    Route::get('transactions', [TransactionsController::class, 'transactions'])->name('transactions');

    //Withdrawal Requests Route
    Route::get('withdrawal-requests/listing', [WithdrawalRequestsController::class, 'listWithdrawalRequests'])->name('withdrawal.requests.list');
    Route::get('withdrawal-requests', [WithdrawalRequestsController::class, 'withdrawalRequests'])->name('withdrawal.requests');
    Route::post('withdrawal-status-change', [WithdrawalRequestsController::class, 'withdrawalStatusChange'])->name('withdrawal.request.status.change');

// Offering Types
    Route::get('offering/type', [OfferingsTypeController::class, 'offeringType'])->name('offerings.type');
    Route::get('offering/type/listing', [OfferingsTypeController::class, 'offeringTypeListing'])->name('offerings.type.listing');
    Route::get('offerings-type/create', [OfferingsTypeController::class, 'createType'])->name('offerings.type.create');
    Route::post('offerings-type/store', [OfferingsTypeController::class, 'storeType'])->name('offerings.type.store');
    Route::post('offerings-type', [OfferingsTypeController::class, 'typeStatusChange'])->name('offerings.type.status.change');
// Accredited Investor
    Route::get('accredited-investor', [AccreditedInvestorController::class, 'accreditedUser'])->name('accredited.index');
    Route::get('accredited-investor/listing', [AccreditedInvestorController::class, 'currentAccreditedInvestor'])->name('current.accredited.investor');
    Route::get('accredited-investor/view/{id}', [AccreditedInvestorController::class, 'view'])->name('accredited.view');
    Route::post('accredited-investor/approve/store', [AccreditedInvestorController::class, 'storeApproval'])->name('accredited.approve.store');
//Admin Profile Settings
    Route::get('profile/settings', [UsersController::class, 'settings'])->name('user.settings');
    Route::post('profile/update', [UsersController::class, 'settingsUpdate'])->name('settings.update');
});

// Investor Routes
Route::group(['as' => 'investor.', 'prefix' => 'investor', 'middleware' => ['auth', 'investor', 'user.verified', 'disabled']], function () {
    Route::get('dashboard', [InvestorDashboard::class, 'index'])->name('dashboard');

    // Transactions Routes
    Route::get('transactions', [InvestorTransactionsController::class, 'transactions'])->name('transactions');
    Route::get('transactions/listing', [InvestorTransactionsController::class, 'transactionsListing'])->name('transactions.listing');

    // Fund Deposit Routes
    Route::get('fund-deposits/listing', [FundsController::class, 'fundDepositsListing'])->name('fund.deposits.listing');
    Route::get('fund-deposits', [FundsController::class, 'fundDeposits'])->name('fund.deposits');
    Route::post('fund-deposits', [FundsController::class, 'fundDeposited'])->name('fund.deposits.money');

    // Fund Withdrawal Routes
    Route::get('fund-withdrawals/listing', [FundsController::class, 'fundWithdrawalsListing'])->name('fund.withdrawals.listing');
    Route::get('fund-withdrawals', [FundsController::class, 'fundWithdrawals'])->name('fund.withdrawals');
    Route::post('fund-withdrawals', [FundsController::class, 'fundWithdrawaled'])->name('fund.withdrawals.money');

    //Portfolio Routes
    Route::get('portfolio/current/investments/listing', [InvestorDashboard::class, 'currentInvestmentsListing'])->name('portfolio.current.investments');
    Route::get('portfolio/completed/investments/listing', [InvestorDashboard::class, 'completedInvestmentsListing'])->name('portfolio.completed.investments');
    Route::get('portfolio', [InvestorDashboard::class, 'portfolio'])->name('portfolio');

    //Bank Accounts Routes
    Route::get('bank-accounts', [BankAccountController::class, 'add'])->name('bank.accounts');
    Route::post('bank-accounts/add', [BankAccountController::class, 'save'])->name('add.bank.accounts');
    Route::get('bank-accounts/edit/{id}', [BankAccountController::class, 'edit'])->name('edit.bank.account');
    Route::post('bank-accounts/delete', [BankAccountController::class, 'delete'])->name('delete.bank.accounts');

    //Settings Routes
    Route::get('settings', [AccountSettingsController::class, 'settings'])->name('settings');
    Route::post('settings', [AccountSettingsController::class, 'update'])->name('settings.update');

    //Upgrade Accredited Investor
    Route::get('upgrade', [AccountSettingsController::class, 'accreditedInvestor'])->name('upgrade.accredited');
    Route::post('upgrade/save', [AccountSettingsController::class, 'accreditedInvestorSave'])->name('upgrade.accredited,post');

    //Investor Investment
    Route::post('investment', [InvestorInvestmentsController::class, 'create'])->name('invest');
});
