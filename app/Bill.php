<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = "order";


    public function bill_detail(){
    	return $this->hasMany('App\BillDetail','order_id','id');
    }

    public function bill(){
    	return $this->belongsTo('App\khachang','id_customer','id');
    }
	 public function khachhang(){
    	return $this->belongsTo('App\khachhang','customer_id','id');
    }
}
