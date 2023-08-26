<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherName extends Model
{
    protected $fillable = ['name','short_code','period','expired_date','total_voucher_qty','discount_type','discount_amount','coupon_type','discount_percentage'];
    // protected $guarded = [
    //     'id',
    //     'created_at',
    //     'updated_at'
    // ];
}
