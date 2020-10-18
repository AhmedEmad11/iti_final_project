<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'user_id', 'return_date'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
