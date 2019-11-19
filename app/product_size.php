<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_size extends Model
{
    //
    protected $table = "product_size";
    
     public function product_properties()
    {
        return $this->hasMany('App\product_properties','size_id','id');
    }
}
