<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestBlogController;
use App\Http\Controllers\JobRequestController;
use App\Http\Controllers\MailFormController;
use App\Http\Controllers\MoneyTransferCompanyController;
use App\Http\Controllers\MoneyTransferController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PresenceAbsenceController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SiteUIController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'SiteUIController@welcome')->name('welcome');
Route::get('/web', 'SiteUIController@main')->name('main');
Route::get('/orders', 'SiteUIController@orders')->name('orders');
Route::get('/order/{order}', 'SiteUIController@order')->name('order');
Route::post('/order/thanks/#thanks', 'SiteUIController@orderStore')->name('order.store');
Route::get('/job/request', 'SiteUIController@jobRequest')->name('job.request');
Route::post('/job/request/store', 'SiteUIController@jobRequestStore')->name('job.request.store');
Route::get('/blog/{pageNumber}', [SiteUIController::class, 'blog'])->name('blog');
Route::get('/blogs/{slug}', [SiteUIController::class, 'blogDetails'])->name('blog.details');
Route::get('/works', 'SiteUIController@latestWorks')->name('latestWorks');
Route::get('/works/{pageNumber}', 'SiteUIController@works')->name('works');
Route::post('/contact/store', [SiteUIController::class, 'contactStore'])->name('contact.store');
Route::post('/subscribe/store', [SiteUIController::class, 'subscribeStore'])->name('subscribe.store');

Route::get('/packages', 'SiteUIController@packages')->name('packages');


Route::get('/privacy', function () {
    return view('privacy.privacy');
});


// Route::post('/', 'PostController@store' )->name('post.store');
Auth::routes();

Route::group(['middleware' => ['auth', 'AdminAuth'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('notification', [DashboardController::class, 'notification'])->name('notification');
    Route::post('sendNotification', [DashboardController::class, 'sendNotification'])->name('send.notification');
    // Route::get('/notification', 'DashboardController@notification')->name('notification');
    // Route::post('/send-notification', 'DashboardController@sendNotification')->name('send.notification');

    Route::get('/users', 'DashboardController@users')->name('users');

    Route::get('/send-email/{id}', [MailFormController::class, 'sendEmail'])->name('send.email');
    Route::post('/insert/emails', [MailFormController::class, 'insertEmails'])->name('emails.insert');
    Route::get('/mails', [MailFormController::class, 'index'])->name('mails');
    Route::get('/mail/show/{id}', [MailFormController::class, 'show'])->name('mail.show');
    Route::get('/mail/create', [MailFormController::class, 'create'])->name('mail.create');
    Route::post('/mail/store', [MailFormController::class, 'store'])->name('mail.store');
    Route::get('/mail/edit/{id}', [MailFormController::class, 'edit'])->name('mail.edit');
    Route::post('/mail/update/{id}', [MailFormController::class, 'update'])->name('mail.update');
    Route::get('/mail/destroy/{id}', [MailFormController::class, 'destroy'])->name('mail.destroy');

    Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');

    Route::get('/slider/show', [SliderController::class, 'index'])->name('slider.show');
    Route::get('/slider/trashed', [SliderController::class, 'slidersTrashed'])->name('slider.trashed');
    Route::get('/slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('/slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/slider/edit/{slug}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('/slider/update/{slug}', [SliderController::class, 'update'])->name('slider.update');
    Route::get('/slider/destroy/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
    Route::get('/slider/hdelete/{id}', [SliderController::class, 'hdelete'])->name('slider.hdelete');
    Route::get('/slider/restore/{id}', [SliderController::class, 'restore'])->name('slider.restore');

    Route::get('b/blogs/show', [BlogController::class, 'index'])->name('blogs.show');
    Route::get('b/blogs/trashed', [BlogController::class, 'blogsTrashed'])->name('blogs.trashed');
    Route::get('b/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('b/blog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('b/blog/show/{slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('b/blog/edit/{slug}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('b/blog/update/{slug}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('b/blog/destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
    Route::get('b/blog/hdelete/{id}', [BlogController::class, 'hdelete'])->name('blog.hdelete');
    Route::get('b/blog/restore/{id}', [BlogController::class, 'restore'])->name('blog.restore');


    Route::get('/services/show', [ServicesController::class, 'index'])->name('services.show');
    Route::get('/services/trashed', [ServicesController::class, 'servicesTrashed'])->name('services.trashed');
    Route::get('/service/create', [ServicesController::class, 'create'])->name('service.create');
    Route::post('/service/store', [ServicesController::class, 'store'])->name('service.store');
    Route::get('/service/show/{slug}', [ServicesController::class, 'show'])->name('service.show');
    Route::get('/service/edit/{slug}', [ServicesController::class, 'edit'])->name('service.edit');
    Route::post('/service/update/{slug}', [ServicesController::class, 'update'])->name('service.update');
    Route::get('/service/destroy/{id}', [ServicesController::class, 'destroy'])->name('service.destroy');
    Route::get('/service/hdelete/{id}', [ServicesController::class, 'hdelete'])->name('service.hdelete');
    Route::get('/service/restore/{id}', [ServicesController::class, 'restore'])->name('service.restore');


    Route::get('/clients/show', [ClientController::class, 'index'])->name('clients.show');
    Route::get('/clients/trashed', [ClientController::class, 'clientsTrashed'])->name('clients.trashed');
    Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('/client/store', [ClientController::class, 'store'])->name('client.store');
    Route::get('/client/show/{id}', [ClientController::class, 'show'])->name('client.show');
    Route::get('/client/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
    Route::post('/client/update/{id}', [ClientController::class, 'update'])->name('client.update');
    Route::get('/client/destroy/{id}', [ClientController::class, 'destroy'])->name('client.destroy');
    Route::get('/client/hdelete/{id}', [ClientController::class, 'hdelete'])->name('client.hdelete');
    Route::get('/client/restore/{id}', [ClientController::class, 'restore'])->name('client.restore');


    Route::get('/works/show', [WorkController::class, 'index'])->name('works.show');
    Route::get('/works/trashed', [WorkController::class, 'worksTrashed'])->name('works.trashed');
    Route::get('/work/create', [WorkController::class, 'create'])->name('work.create');
    Route::post('/work/store', [WorkController::class, 'store'])->name('work.store');
    // Route::get('/work/show/{id}', [WorkController::class, 'show'])->name('work.show');
    Route::get('/work/edit/{id}', [WorkController::class, 'edit'])->name('work.edit');
    Route::post('/work/update/{id}', [WorkController::class, 'update'])->name('work.update');
    Route::get('/work/update/favorite/{id}', [WorkController::class, 'updateFavorite'])->name('work.updateFavorite');
    Route::get('/work/destroy/{id}', [WorkController::class, 'destroy'])->name('work.destroy');
    Route::get('/work/hdelete/{id}', [WorkController::class, 'hdelete'])->name('work.hdelete');
    Route::get('/work/restore/{id}', [WorkController::class, 'restore'])->name('work.restore');


    Route::get('/subscribes/show', [SubscribeController::class, 'index'])->name('subscribes.show');
    Route::get('/subscribes/trashed', [SubscribeController::class, 'subscribesTrashed'])->name('subscribes.trashed');
    Route::get('/subscribe/destroy/{id}', [SubscribeController::class, 'destroy'])->name('subscribe.destroy');
    Route::get('/subscribe/hdelete/{id}', [SubscribeController::class, 'hdelete'])->name('subscribe.hdelete');
    Route::get('/subscribe/restore/{id}', [SubscribeController::class, 'restore'])->name('subscribe.restore');


    Route::get('/contacts/show', [ContactController::class, 'index'])->name('contacts.show');
    Route::get('/contacts/trashed', [ContactController::class, 'contactsTrashed'])->name('contacts.trashed');
    Route::get('/contact/destroy/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
    Route::get('/contact/hdelete/{id}', [ContactController::class, 'hdelete'])->name('contact.hdelete');
    Route::get('/contact/restore/{id}', [ContactController::class, 'restore'])->name('contact.restore');

    Route::get('/orders/show', [OrderController::class, 'index'])->name('orders.show');
    Route::get('/orders/trashed', [OrderController::class, 'ordersTrashed'])->name('orders.trashed');
    Route::get('/order/destroy/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('/order/hdelete/{id}', [OrderController::class, 'hdelete'])->name('order.hdelete');
    Route::get('/order/restore/{id}', [OrderController::class, 'restore'])->name('order.restore');


    Route::get('/job/requests/show', [JobRequestController::class, 'index'])->name('job.requests.show');
    Route::get('/job/requests/trashed', [JobRequestController::class, 'ordersTrashed'])->name('job.requests.trashed');
    Route::get('/job/destroy/{id}', [JobRequestController::class, 'destroy'])->name('job.request.destroy');
    Route::get('/job/hdelete/{id}', [JobRequestController::class, 'hdelete'])->name('job.request.hdelete');
    Route::get('/job/restore/{id}', [JobRequestController::class, 'restore'])->name('job.request.restore');

    Route::get('/officers', [OfficerController::class, 'index'])->name('officers.show');
    Route::get('/officers/trashed', [OfficerController::class, 'clientsTrashed'])->name('officers.trashed');
    Route::get('/officers/create', [OfficerController::class, 'create'])->name('officer.create');
    Route::post('/officers/store', [OfficerController::class, 'store'])->name('officer.store');
    Route::get('/officers/edit/{id}', [OfficerController::class, 'edit'])->name('officer.edit');
    Route::post('/officers/update/{id}', [OfficerController::class, 'update'])->name('officer.update');
    Route::get('/officers/destroy/{id}', [OfficerController::class, 'destroy'])->name('officer.destroy');
    Route::get('/officers/hdelete/{id}', [OfficerController::class, 'hdelete'])->name('officer.hdelete');
    Route::get('/officers/restore/{id}', [OfficerController::class, 'restore'])->name('officer.restore');

    Route::get('/transfers/{id}', [MoneyTransferController::class, 'index'])->name('transfers.show');
    Route::get('/transfers/trashed/{id}', [MoneyTransferController::class, 'transfersTrashed'])->name('transfers.trashed');
    Route::post('/transfers/store', [MoneyTransferController::class, 'store'])->name('transfer.store');
    Route::get('/transfers/edit/{id}', [MoneyTransferController::class, 'edit'])->name('transfer.edit');
    Route::post('/transfers/update/{id}', [MoneyTransferController::class, 'update'])->name('transfer.update');
    Route::get('/transfers/destroy/{id}', [MoneyTransferController::class, 'destroy'])->name('transfer.destroy');
    Route::get('/transfers/hdelete/{id}', [MoneyTransferController::class, 'hdelete'])->name('transfer.hdelete');
    Route::get('/transfers/restore/{id}', [MoneyTransferController::class, 'restore'])->name('transfer.restore');
    Route::post('/print', [MoneyTransferController::class, 'print'])->name('print');

    Route::get('/companys', [CompanyController::class, 'index'])->name('companys.show');
    Route::get('/companys/trashed', [CompanyController::class, 'clientsTrashed'])->name('companys.trashed');
    Route::get('/companys/create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('/companys/store', [CompanyController::class, 'store'])->name('company.store');
    Route::get('/companys/edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');
    Route::post('/companys/update/{id}', [CompanyController::class, 'update'])->name('company.update');
    Route::get('/companys/destroy/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');
    Route::get('/companys/hdelete/{id}', [CompanyController::class, 'hdelete'])->name('company.hdelete');
    Route::get('/companys/restore/{id}', [CompanyController::class, 'restore'])->name('company.restore');

    Route::get('/transfers/company/{id}', [MoneyTransferCompanyController::class, 'index'])->name('transfers.company.show');
    Route::get('/transfers/company/trashed/{id}', [MoneyTransferCompanyController::class, 'transfersTrashed'])->name('.company.trashed');
    Route::post('/transfers/company/store', [MoneyTransferCompanyController::class, 'store'])->name('transfer.company.store');
    Route::get('/transfers/company/edit/{id}', [MoneyTransferCompanyController::class, 'edit'])->name('transfer.company.edit');
    Route::post('/transfers/company/update/{id}', [MoneyTransferCompanyController::class, 'update'])->name('transfer.company.update');
    Route::get('/transfers/company/destroy/{id}', [MoneyTransferCompanyController::class, 'destroy'])->name('transfer.company.destroy');
    Route::get('/transfers/company/hdelete/{id}', [MoneyTransferCompanyController::class, 'hdelete'])->name('transfer.company.hdelete');
    Route::get('/transfers/company/restore/{id}', [MoneyTransferCompanyController::class, 'restore'])->name('transfer.company.restore');
    Route::post('/pdf', [MoneyTransferCompanyController::class, 'pdf'])->name('pdf');

    Route::get('/financial-claim', [MoneyTransferCompanyController::class, 'setFinancialClaim'])->name('transfers.financial.claim');
    Route::post('/financial-claim', [MoneyTransferCompanyController::class, 'getFinancialClaimsByMonth'])->name('transfers.financial.claim.month');
    Route::get('/tax-invoice/{id}', [MoneyTransferCompanyController::class, 'taxInvoice'])->name('tax-invoice');
    Route::get('/tax-invoice/company/{id}', [MoneyTransferCompanyController::class, 'taxInvoiceindex'])->name('tax-invoice.index');
    Route::post('/tax-invoice', [MoneyTransferCompanyController::class, 'taxInvoiceStore'])->name('tax-invoice.store');
    Route::get('/tax-invoice/edit/{id}', [MoneyTransferCompanyController::class, 'taxInvoiceEdit'])->name('tax-invoice.edit');
    Route::post('/tax-invoice/update/{id}', [MoneyTransferCompanyController::class, 'taxInvoiceUpdate'])->name('tax-invoice.update');
    Route::post('/tax-invoice/delete', [MoneyTransferCompanyController::class, 'taxInvoiceDelete'])->name('tax-invoice.delete');
    Route::get('/tax-invoice/delete/{id}', [MoneyTransferCompanyController::class, 'taxInvoiceDeleteGet'])->name('tax-invoice.delete-get');

    Route::get('/sections', [SectionController::class, 'index'])->name('sections.show');
    Route::get('/sections/trashed', [SectionController::class, 'sectionsTrashed'])->name('sections.trashed');
    Route::post('/sections/store', [SectionController::class, 'store'])->name('section.store');
    Route::post('/sections/update/{id}', [SectionController::class, 'update'])->name('section.update');
    Route::get('/sections/destroy/{id}', [SectionController::class, 'destroy'])->name('section.destroy');
    Route::get('/sections/hdelete/{id}', [SectionController::class, 'hdelete'])->name('section.hdelete');
    Route::get('/sections/restore/{id}', [SectionController::class, 'restore'])->name('section.restore');

    Route::get('/presence-absence', [PresenceAbsenceController::class, 'index'])->name('presence.absence.index');
    Route::post('/presence-absence', [PresenceAbsenceController::class, 'edit'])->name('presence.absence.edit');
    Route::post('/presence-absence/store', [PresenceAbsenceController::class, 'store'])->name('presence.absence.store');
    Route::post('/presence-absence/update', [PresenceAbsenceController::class, 'update'])->name('presence.absence.update');
    Route::get('/presence-absence/officer/{id}', [PresenceAbsenceController::class, 'officer'])->name('presence.absence.officer');
    Route::post('/presence-absence/officer/{id}', [PresenceAbsenceController::class, 'filterOfficer'])->name('presence.absence.filterOfficer');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    Route::get('/payments/show/{id}', [PaymentController::class, 'show'])->name('payments.show');
});

Route::get('blogs', [GuestBlogController::class, 'index'])->name('guest.blogs.show');
Route::get('create/blog', [GuestBlogController::class, 'create'])->name('guest.blog.create');
Route::post('store/blog', [GuestBlogController::class, 'store'])->name('guest.blog.store');
Route::get('show/blog/{slug}', [GuestBlogController::class, 'show'])->name('guest.blog.show');
Route::get('edit/blog/{slug}', [GuestBlogController::class, 'edit'])->name('guest.blog.edit');
Route::post('update/blog/{slug}', [GuestBlogController::class, 'update'])->name('guest.blog.update');

// Route::get('blogs/updateSlugs', [BlogController::class, 'updateSlugs'])->name('blogs.update.slugs');
