<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customerhistory extends Model
{
    protected $table = 'customerhistory';
    public function vouchers()
    {
        return $this->hasMany('App\Voucher');
    }

}
