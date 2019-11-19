<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $table = 'product';

    public function bill_detail(){
    	return $this->hasMany('App\BillDetail','product_id','id');
    }
	public function Category(){
    	return $this->belongsTo('App\Category','id_type','id');
    }
    public function product_properties()
    {
        return $this->hasMany('App\product_properties','pro_id','id');
    }
}
