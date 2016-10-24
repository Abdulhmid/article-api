<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_category extends Model
{
    protected $table      = 'category_product';
    protected $primaryKey = 'id';
    protected $guarded    = ['id'];

}
