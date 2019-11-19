<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
	protected $table = "order_detail";

    public function product(){
    	return $this->belongsTo('App\products','product_id','id');
    }

    public function bill(){
    	return $this->belongsTo('App\Bill','order_id','id');
    }    
}
