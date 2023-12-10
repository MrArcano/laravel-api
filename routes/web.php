<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TecnologyController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\CSVController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Route Guest (pubblica)
Route::get('/',[PageController::class,'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','verified'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function(){
            // DashboardController
            Route::get('/',[DashboardController::class,'index'])->name('home');

            // ProjectController
            Route::get('project/no-tecnology',[ProjectController::class,'noTecnology'])->name('project.no-tecnology');
            Route::resource('project', ProjectController::class);
            Route::get('project/{project}/delete-image',[ProjectController::class,'destroy_image'])->name('project.delete-image');
            Route::get('project/order-by/{field}/{order}',[ProjectController::class,'orderBy'])->name('project.order-by');

            // TecnologyController
            Route::resource('tecnology', TecnologyController::class);
            Route::get('project/tecnology/{tecnology}',[TecnologyController::class,'projectTecnology'])->name('tecnology.projects-tecnology');

            // TypeController
            Route::resource('type', TypeController::class);

            // CSVController
            Route::get('import-export-csv',[CSVController::class,'importExportCSV'])->name('import-export-csv');
            Route::post('import-csv',[CSVController::class,'importCsv'])->name('import-csv');
            Route::get('export-csv',[CSVController::class,'exportCsv'])->name('export-csv');
        });

require __DIR__.'/auth.php';
