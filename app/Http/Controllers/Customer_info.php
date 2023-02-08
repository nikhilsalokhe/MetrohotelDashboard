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

    public function Checkin_3_hr(){

        $a='00:00:00.000000';
        $a1='02:59:00.000000';
        $b='03:00:00.000000';
        $b1='05:59:00.000000';
        $c='06:00:00.000000';
        $c1='08:59:00.000000';
        $d='09:00:00.000000';
        $d1='11:59:00.000000';
        $e='12:00:00.000000';
        $e1='14:59:00.000000';
        $f='15:00:00.000000';
        $f1='17:59:00.000000';
        $g='18:00:00.000000';
        $g1='20:59:00.000000';
        $h='21:00:00.000000';
        $i='24:00:00.000000';

        $time1 = DB::table('Sheet1')->select('*')->wherebetween(DB::raw('TIME(Arrival_DT)'),[$a,$a1])->count();
        $time2 = DB::table('Sheet1')->select('*')->wherebetween(DB::raw('TIME(Arrival_DT)'),[$b,$b1])->count();
        $time3 = DB::table('Sheet1')->select('*')->wherebetween(DB::raw('TIME(Arrival_DT)'),[$c,$c1])->count();
        $time4 = DB::table('Sheet1')->select('*')->wherebetween(DB::raw('TIME(Arrival_DT)'),[$d,$d1])->count();        //dd($time);
        $time5 = DB::table('Sheet1')->select('*')->wherebetween(DB::raw('TIME(Arrival_DT)'),[$e,$e1])->count();
        $time6 = DB::table('Sheet1')->select('*')->wherebetween(DB::raw('TIME(Arrival_DT)'),[$f,$f1])->count();
        $time7 = DB::table('Sheet1')->select('*')->wherebetween(DB::raw('TIME(Arrival_DT)'),[$g,$g1])->count();
        $time8 = DB::table('Sheet1')->select('*')->wherebetween(DB::raw('TIME(Arrival_DT)'),[$h,$i])->count();

        return view('sidebar_elements.Checkin_3_hr',compact('time1','time2','time3','time4','time5','time6','time7','time8'));
    }

public function Monthly_Bill(){
    $des21='2021-12-01 00:00:00';$enddes21='2021-12-31 00:00:00';
    $jan22='2022-01-01 00:00:00';$endjan22='2022-01-31 00:00:00';
    $feb22='2022-02-01 00:00:00';$endfeb22='2022-02-28 00:00:00';
    $mar22='2022-03-01 00:00:00';$endmar22='2022-03-31 00:00:00';
    $apr22='2022-04-01 00:00:00';$endapr22='2022-04-30 00:00:00';
    $may22='2022-05-01 00:00:00';$endmay22='2022-05-31 00:00:00';
    $jun22='2022-06-01 00:00:00';$endjun22='2022-06-31 00:00:00';
    $july22='2022-07-01 00:00:00';$endjuly22='2022-07-31 00:00:00';
    $Aug22='2022-08-01 00:00:00';$endAug22='2022-08-31 00:00:00';
    $Sept22='2022-09-01 00:00:00';$endSep22='2022-09-31 00:00:00';
    $Oct22='2022-10-01 00:00:00';$endOct22='2022-10-31 00:00:00';
    $Nov22='2022-11-01 00:00:00';$endNov22='2022-11-31 00:00:00';
    $des22='2022-12-01 00:00:00';$enddes22='2022-12-31 00:00:00';
    $jan23='2023-01-01 00:00:00';$endjan23='2023-01-31 00:00:00';



    $December21= DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT',[$des21,$enddes21])->AVG('Bill_amount');
    $January22= DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT',[$jan22,$endjan22])->AVG('Bill_amount');
    $February22= DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT',[$feb22,$endfeb22])->AVG('Bill_amount');
    $March22= DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT',[$mar22,$endmar22])->AVG('Bill_amount');
    $April22= DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT',[$apr22,$endapr22])->AVG('Bill_amount');
    $May22= DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT',[$may22,$endmay22])->AVG('Bill_amount');
    $June22= DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT',[$jun22,$endjun22])->AVG('Bill_amount');
    $July22= DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT',[$july22,$endjuly22])->AVG('Bill_amount');

    $August22= DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT',[$Aug22,$endAug22])->AVG('Bill_amount');

    $September22= DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT',[$Sept22,$endSep22])->AVG('Bill_amount');

    $October22= DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT',[$Oct22,$endOct22])->AVG('Bill_amount');

    $November22= DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT',[$Nov22,$endNov22])->AVG('Bill_amount');

    $December22= DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT',[$des22,$enddes22])->AVG('Bill_amount');

    $January23= DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT',[$jan23,$endjan23])->AVG('Bill_amount');
return view('partials.Monthly_Bill',compact('December21','January22','February22','March22','April22','May22','June22','July22','August22','September22','October22','November22','December22','January23' ));

}

}
