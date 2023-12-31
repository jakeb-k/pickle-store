<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    use HasFactory;
    function product(){
        return $this->belongsTo('App\Models\Product');
    }

    protected $fillable=['values'];

}
