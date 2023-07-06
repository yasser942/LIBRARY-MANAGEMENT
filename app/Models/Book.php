<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['image','isbn','title', 'author', 'year','category', 'count'];

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}
