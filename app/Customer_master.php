<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_master extends Model
{
    protected $table = 'customer_master';
    protected $primaryKey = 'customer_id';
    public function vouchers()
    {
        return $this->hasMany('App\Voucher', 'customer_id');
    }

}
