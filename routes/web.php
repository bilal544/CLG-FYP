<?php

use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('index');
Route::view('/ai-essay-writer', 'ai-essay-writer')->name('ai-essay-writer');
Route::view('/ai-story-generator', 'ai-story-generator')->name('ai-story-generator');
Route::prefix('paraphrase')->group(function () {
  Route::post('/', [AjaxController::class, 'handleParaphrase'])->middleware('throttle:3,1');;
  Route::get('/', function () {
    abort(404);
  });
});
