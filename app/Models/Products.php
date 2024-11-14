<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{


    protected $table = 'products';
    protected $fillable = ['name', 'price', 'description'];
    protected $dates = ['created_at', 'updated_at'];


}
