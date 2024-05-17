<?php

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::post('board', function(Request $request) {
    $validated = $request->validate([
        'title' => 'required',
        'details' => 'nullable',
    ]);
    Board::Create($validated);
})->middleware('auth:sanctum');

require __DIR__.'/auth.php';
