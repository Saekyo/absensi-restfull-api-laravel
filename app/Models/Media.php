<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'path',
        'type'
    ];
     /**
     * Get the user that owns the comment.
     */


    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
