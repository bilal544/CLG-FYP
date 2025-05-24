<?php

use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('index');
Route::prefix('paraphrase')->group(function () {
  Route::post('/', [AjaxController::class, 'handleParaphrase']);
  Route::get('/', function () {
    abort(404);
  });
});
