<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RescuerController;

Route::get('/',function(){
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/complaint/add', [DashboardController::class, 'addComplaint'])->name('complaint.add');


Route::get('/rescuer/complaints', [RescuerController::class, 'viewComplaints'])->name('rescuer.complaints');
Route::post('/rescuer/complaints/{id}/accept', [RescuerController::class, 'acceptComplaint'])->name('rescuer.complaints.accept');
Route::post('/rescuer/complaints/{id}/reject', [RescuerController::class, 'rejectComplaint'])->name('rescuer.complaints.reject');

Route::get('/rescuer/animal-records', [RescuerController::class, 'viewAnimalRecords'])->name('rescuer.animal.records');
Route::post('/rescuer/animal-records/add', [RescuerController::class, 'addAnimalRecord'])->name('rescuer.animal.records.add');



require __DIR__.'/auth.php';
