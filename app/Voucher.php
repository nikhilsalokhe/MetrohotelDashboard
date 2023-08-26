<?php

namespace App;

use App\Customer_master;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    public function Customer()
    {
        return $this->belongsTo('App\Customer_master', 'customer_id', 'customer_id');
    }


    public function VoucherName()
    {
        return $this->belongsTo('App\VoucherName');
    }

    public function Status()
    {
        return $this->belongsTo('App\StatusList');
    }
}
