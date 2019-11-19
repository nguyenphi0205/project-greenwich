<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recommends extends Model
{
    protected $table = ' recommends';

    protected $fillable = [
        'id', 'pro_id', 'uid',
    ];
}
