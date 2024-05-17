<?php

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::post('board', function(Request $request) {
    Board::Create($request->all());
})->middleware('auth:sanctum');

require __DIR__.'/auth.php';
