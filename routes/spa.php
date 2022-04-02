<?php

use App\Http\Controllers\SpaController;

Route::get('{path}', SpaController::class)->where('path', '(.*)');
