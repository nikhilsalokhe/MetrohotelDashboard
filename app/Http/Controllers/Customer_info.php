<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class Customer_info extends Controller
{
    public function Total_customer()
    {
        $data = DB::table('customer_info')->select('*')->get();

        return view('partials.Total_customer',compact('data'));
    }


    public function Todays_customer()
    {
        $today=carbon::today();
        $tomorrow = Carbon::tomorrow();
        //dd($today);
        $data = DB::table('customer_info')
        ->join('Sheet1','customer_info.Customer_Id','=','Sheet1.Customer_Id')
        ->select('customer_info.*')
        ->wherebetween('Sheet1.Arrival_DT',[$today,$tomorrow])->get();

       return view('partials.Todays_customer',compact('data'));
    }

    public function Weeks_customer()
    {
        $today=carbon::today();
        //$tomorrow = Carbon::tomorrow();
        $startWeek = Carbon::now()->subWeek()->startOfWeek();
        //dd($startWeek);
        $data = DB::table('customer_info')
        ->join('Sheet1','customer_info.Customer_Id','=','Sheet1.Customer_Id')
        ->select('customer_info.*')
        ->wherebetween('Sheet1.Arrival_DT',[$startWeek,$today])->get();

       return view('partials.Weeks_customer',compact('data'));
    }

    public function Months_customer()
    {
        $today=carbon::today();
        $lastMonth =Carbon::now()->subMonth()->format('Y-m-d'); // 11

    //dd($lastMonth);

        $data = DB::table('customer_info')
        ->join('Sheet1','customer_info.Customer_Id','=','Sheet1.Customer_Id')
        ->select('customer_info.*')
        ->wherebetween('Sheet1.Arrival_DT',[$lastMonth,$today])->get();

       return view('partials.Months_customer',compact('data'));
    }
    public function MostVistited(){
        $mostVistited= DB::table('Sheet1')
        ->select('Customer_Id','Guest_name',DB::raw('COUNT(*)as `count`'))
        ->groupBy('Customer_Id','Guest_name')->having('count','>',1)->orderBy('count','desc')->get();

        return view('partials.mostvisited',compact('mostVistited'));
    }
}
