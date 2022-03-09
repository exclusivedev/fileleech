<?php

use Illuminate\Support\Facades\Route;
use ExclusiveDev\FileLeech\Http\Controllers\AttachmentsController;

if (config('attachments.route.root') !== null) {
    Route::group(['prefix' => config('attachments.route.root'), 'middleware' => ['api', 'auth', 'core']], static function () {
        Route::group(['as' => config('attachments.route.group').'.'], static function () {
            Route::apiResource(config('attachments.route.group'), AttachmentsController::class)
            ->only(['store', 'index', 'destroy', 'show']);
        });
    });
}


