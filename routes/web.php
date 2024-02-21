<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FileController;

Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/store', [ClientController::class, 'store'])->name('clients.store');
Route::get('/', [ClientController::class, 'index'])->name('clients.index');
Route::get('/upload-form', [FileController::class, 'showForm']);
Route::post('/upload-and-modify', [FileController::class, 'mapAndModifyFile']);
Route::get('/download-modified-file', [FileController::class, 'downloadTextFile'])->name('file.downloadTextFile');

// Add other routes as needed
