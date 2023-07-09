<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['image','isbn','title', 'author', 'year','category', 'count','pdf_path'];

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
    public function fines()
    {
        return $this->hasMany(Fine::class);
    }

    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }
}
