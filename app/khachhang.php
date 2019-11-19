<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khachhang extends Model
{
    protected $table = 'customer';
	public function bill(){
    	return $this->hasMany('App\Bill','customer_id','id');
    }
}
