<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    use HasFactory;
    protected $table = 'shelfs';


    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
