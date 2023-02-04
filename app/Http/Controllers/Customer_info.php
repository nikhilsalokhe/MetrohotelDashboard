<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Customer_info extends Controller
{
    public function Total_customer()
    {

        return view('partials.Total_customer')->with('totalarr',);
    }
}
