<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //
        $data = DB::table('customer_info')->select('*')->count();


        //
        $today=carbon::today();
        $tomorrow = Carbon::tomorrow();
        $todays= DB::table('customer_info')
        ->join('Sheet1','customer_info.Customer_Id','=','Sheet1.Customer_Id')
        ->select('customer_info.*')
        ->wherebetween('Sheet1.Arrival_DT',[$today,$tomorrow])->count();

        //
        $today=carbon::today();
        //$tomorrow = Carbon::tomorrow();
        $startWeek = Carbon::now()->subWeek()->startOfWeek();
        //dd($startWeek);
        $Weeks = DB::table('customer_info')
        ->join('Sheet1','customer_info.Customer_Id','=','Sheet1.Customer_Id')
        ->select('customer_info.*')
        ->wherebetween('Sheet1.Arrival_DT',[$startWeek,$today])->count();

       // $today=carbon::today();
        $lastMonth =Carbon::now()->subMonth()->format('Y-m-d'); // 11

        //dd($lastMonth);

            $Months= DB::table('customer_info')
            ->join('Sheet1','customer_info.Customer_Id','=','Sheet1.Customer_Id')
            ->select('customer_info.*')
            ->wherebetween('Sheet1.Arrival_DT',[$lastMonth,$today])->count();

            $rate= DB::table('customer_info')
            ->join('Sheet1','customer_info.Customer_Id','=','Sheet1.Customer_Id')
            ->select('customer_info.*')
            ->wherebetween('Sheet1.Arrival_DT',[$lastMonth,$today])->avg('Bill_amount');

            $booking= DB::table('customer_info')
            ->join('Sheet1','customer_info.Customer_Id','=','Sheet1.Customer_Id')
            ->select('customer_info.*')
            ->wherebetween('Sheet1.Arrival_DT',[$lastMonth,$today])->count();
            $avgbooking = $booking/780;


            $mostVistited= DB::table('Sheet1')
            ->select('Customer_Id','Guest_name',DB::raw('COUNT(*)as `count`'))
            ->groupBy('Customer_Id','Guest_name')->having('count','>',1)->orderBy('count','desc')->get();



        return view('home',compact('todays','data','Weeks','Months','rate','avgbooking','mostVistited'));

    }
    

}
