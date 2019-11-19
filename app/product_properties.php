<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_properties extends Model
{
    //
    protected $table = "products_properties";
     public function product_size()
    {
        return $this->belongsTo('App\product_size','size_id','id');
    }
}
