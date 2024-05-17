<?php

use App\Http\Controllers\BoardController;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});



require __DIR__.'/auth.php';
