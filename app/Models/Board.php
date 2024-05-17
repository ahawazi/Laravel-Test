<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Board extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'details',
    ];

    protected $visible = [
        'title',
        'details',
    ];

    // by this code we can add the thing to own json and assert the information:
    // public function toArray(): array
    // {
    //     return [
    //         'title' => $this->title,
    //         'details' => $this->details,
    //         'create_at' => $this->created_at->diffForHumans,
    //         'user' => $this->user->name,
    //     ];
    // }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
