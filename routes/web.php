<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('index');
Route::view('/ai-essay-writer', 'ai-essay-writer')->name('ai-essay-writer');
Route::view('/ai-story-generator', 'ai-story-generator')->name('ai-story-generator');
Route::view('/resume-maker', 'resume-maker')->name('resume-maker');

Route::controller(ContactController::class)->group(function () {
  Route::get('/contact', 'ContactPage')->name('contact-us');
  Route::post('/contact-store', 'ContactStore')->name('contact-store')->middleware('throttle:3,1');
});


Route::prefix('paraphrase')->group(function () {
  // POST routes (handled by AjaxController)
  Route::controller(AjaxController::class)->group(function () {
    Route::post('/', 'handleParaphrase')->middleware('throttle:3,1');
    Route::post('/generate-essay', 'handleWriteEssay')->middleware('throttle:3,1');
    Route::post('/generate-story', 'handleWriteStory')->middleware('throttle:3,1');
  });

  Route::get('/', function () {
    abort(404);
  });
  Route::get('/generate-essay', function () {
    abort(404);
  });
});
