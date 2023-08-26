<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;



class Email extends Model
{
    public static function send($voucherName,$customer){
        // dd($voucherName);

        $expiry_data= Carbon::parse($voucherName->expired_date)->format('jS F Y');
        $data["email"]="nikhilnsalokhe12@gmail.com";
        $data["title"]="Metro Hotel Coupon";
        $data["customer_name"]=$customer->GUEST_NAME;
        $data["customer_number"]=$customer->GUEST_MOBILE;
        $data["voucher_name"]=$voucherName->name.$customer->customer_id;
        $data["expired_date"]= $expiry_data;
        if($voucherName->discount_amount==null){
            $data["discount_amount"]=$voucherName->discount_percentage.'%';
        }else{
            $data["discount_amount"]='₹'.$voucherName->discount_amount;
        }

        // $data["discount_percentage"]=$voucherName->discount_percentage;
        // $data["discount_percentage"]=$voucherName->discount_amount;


        // dd($voucherName->name);s


Mail::send('email', $data, function ($message) use ($data) {
$message->to($data["email"])
->subject($data["title"]);
});
    }
}
