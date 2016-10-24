<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'id';
    protected $guarded    = ['id'];

    public function category() {
        return $this->belongsTo('App\Models\Product_category', 'category_id', 'id');
    }
}
