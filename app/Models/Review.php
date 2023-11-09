<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    function mat(){
        return $this->belongsTo('App\Models\Mat');
    }
    use HasFactory;

    protected $fillable=['content','rating','image'];
}
