<?php

use App\Http\Middleware\AuthCheck;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CallByController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\ContuctController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContuctUsController;
use App\Http\Controllers\InstallByController;
use App\Http\Controllers\CallRecordeController;
use App\Http\Controllers\RegistrationController;


Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contuct');
Route::get('/service', [PageController::class,'service'])->name('service');
Route::get('/image-galary', [PageController::class, 'imageGalary'])->name('imageGalary');
Route::get('/privacy-and-policy', [PageController::class, 'privecy'])->name('privecy');
Route::get('/terms-and-conditions', [PageController::class, 'termCondition'])->name('term&conditions');
Route::get('/refund-and-Cancellation', [PageController::class, 'refund'])->name('refund&Cancellation');


//user routes
Route::post('/user-login', [UserController::class, 'login'])->name('login');
Route::get('/login', [UserController::class, 'index'])->name('pages.login');
//contuct routes
 Route::post('/contuct-create',[ContuctController::class ,'store'])->name('contuct.create');
 Route::post('/contuct-us',[ContuctUsController::class ,'store'])->name('contuctUs.create');
 Route::get('/text-slider', [HeaderController::class,'showText'])->name('textSlider.show');
 
Route::middleware([AuthCheck::class])->group(function () {
        Route::middleware([AuthCheck::class])->group(function (){
                Route::get('/admin-page', [IndexController::class, 'index'])->name('admin.dashbord');
                Route::get('/add-employees', [IndexController::class, 'addEmployee'])
                ->name('addEmployees');
                Route::post('/create-employees', [UserController::class, 'register'])
                ->name('createEmployees');
                Route::get('/employees', [UserController::class, 'employesTable'])
                ->name('employees');
                Route::post('/update-employee-status/{id}', [UserController::class, 'updateEmployeeStatus'])
                ->name('updateEmployeeStatus');
                Route::delete('/delete-employee/{id}', [UserController::class, 'deleteEmployee'])
                ->name('deleteEmployee');
                Route::patch('/update-employee/{id}', [UserController::class, 'updateEmployee'])
                ->name('updateEmployee');

                // Contuct Us routes
                Route::get('/contuct-us', [ContuctUsController::class, 'index'])->name('contuctUs.index');
                Route::get('/contuct-us/{id}', [ContuctUsController::class, 'destroy'])->name('contuctUs.destroy');

                // Image Gallery routes
                Route::get('/image-gallery/from', [GalleryController::class, 'create'])->name('imageGallery.from');  
                Route::post('/image-gallery/create', [GalleryController::class, 'upload'])->name('imageGallery.create');
                Route::get('/image-delete/{id}', [GalleryController::class, 'deleteImage'])->name('delete.image');

                // Text Slider routes
                Route::post('/text-slider/store', [HeaderController::class,'addText'])->name('textSlider.store');
                Route::get('/text-slider/add', [HeaderController::class, 'addSlide'])->name('textSlider.add');
                Route::get('/text-slider/delete', [HeaderController::class, 'deleteText'])->name('textSlider.delete');
                
                //Slider image routes
                Route::get('/slider-image/index', [IndexController::class, 'showSliderImage'])->name('sliderImage.index');
                Route::post('/slider-image/store', [IndexController::class,'upload'])->name('sliderImage.store');
                Route::get('/slider-image/delete/{id}', [IndexController::class, 'delete'])->name('sliderImage.delete');
                
        });
        // Product routes
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::delete('/product/delete', [ProductController::class, 'destroy'])->name('products.delete');
        Route::patch('/product/update', [ProductController::class, 'update'])->name('products.update');
        Route::post('/import', [ProductController::class, 'import'])->name('prodlist.import');
        Route::post('/create', [ProductController::class, 'create'])->name('product.create');
        Route::get('/show-csv-file', [ProductController::class, 'showCsv'])->name('show.csv');
        Route::get('/export-excel', [ProductController::class, 'csvExporter'])->name('export.csv');
        Route::get('/export-pdf', [ProductController::class, 'exportPDF'])->name('export.pdf');


        // InstallBy routes
        Route::get('/install&call-by', [InstallByController::class, 'index'])->name('installBy.index');
        // Route::post('/install-by/create', [InstallByController::class, 'create'])->name('installBy.create');
        // Route::post('/install-by/update', [InstallByController::class, 'update'])->name('installBy.update');
        // Route::get('/install-by/delete/{id}', [InstallByController::class, 'delete'])->name('installBy.delete');

        // CallBy routes
        Route::post('/call-by/create', [CallByController::class, 'create'])->name('callBy.create');
        // Route::get('/call-by/delete/{id}', [CallByController::class, 'delete'])->name('callBy.delete');
        // Route::post('/call-by/update', [CallByController::class, 'update'])->name('callBy.update');


        // Registration routes
        Route::get('/registration-form', [RegistrationController::class, 'registrationForm'])->name('registration.form');
        Route::post('/registration', [RegistrationController::class, 'create'])->name('registration.create');
        Route::get('/registration-table', [RegistrationController::class, 'index'])->name('registrations.index');
        Route::get('/registration/{id}', [RegistrationController::class, 'show'])->name('registration.show');
        Route::get('/edit-registration/{id}', [RegistrationController::class, 'edit'])->name('registration.edit');
        Route::put('/registration/update/{id}', [RegistrationController::class, 'update'])->name('registration.update');
        Route::get('/registration-export', [RegistrationController::class, 'exportCsv'])->name('registration.export');
        Route::get('/registration-monthly-data', [RegistrationController::class, 'monthlyData'])->name('registration.monthly');
        Route::post('/registration-monthly-data-update', [RegistrationController::class, 'updateStatus'])->name('registration.updateStatus');
        Route::post('/registration-renual-export', [RegistrationController::class, 'exportRegistrations'])->name('registration.renualExport');



        // CallRecord routes
        Route::get('/call-records', [CallRecordeController::class, 'getCallRecordsByDateRange'])->name('callRecords.index');
        Route::post('/call-record/update', [CallRecordeController::class, 'addCallStatus'])->name('callRecord.update');
        Route::get('/call-books/{id}', [CallRecordeController::class, 'getCallBooks'])->name('callBooks.show');
        Route::get('/call-details/{id}', [CallRecordeController::class, 'callrecordesDetails'])->name('callBooks.details');


        // Logout route
        Route::get('/logout', [UserController::class, 'logout'])->name('logout');

        // Header routes
        Route::post('/headers/store', [HeaderController::class,'store'])->name('headers.store');
        Route::get('/headers/create', [HeaderController::class, 'create'])->name('headers.create');
        Route::get('/headers/{id}', [HeaderController::class, 'destroy'])->name('headers.destroy');
       
        // Contuct routes
        Route::get('/contucts', [ContuctController::class, 'index'])->name('contucts.index');
        Route::get('/contucts/{id}', [ContuctController::class, 'destroy'])->name('contucts.destroy');

        
        Route::patch('/password-change', [UserController::class, 'changePassword'])->name('changePassword');
});

    



