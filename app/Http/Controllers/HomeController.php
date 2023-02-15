<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        //Total Customer count
        $data = DB::table('customer_info')->select('*')->count();


        //Todays customer
        $today=carbon::today();
        $tomorrow = Carbon::tomorrow();
        $todays= DB::table('customer_info')
        ->join('Sheet1','customer_info.Customer_Id','=','Sheet1.Customer_Id')
        ->select('customer_info.*')
        ->wherebetween('Sheet1.Arrival_DT',[$today,$tomorrow])->count();

        //This Week customer
        $today=carbon::today();
        $startWeek = Carbon::now()->subWeek()->startOfWeek();
        $Weeks = DB::table('customer_info')
        ->join('Sheet1','customer_info.Customer_Id','=','Sheet1.Customer_Id')
        ->select('customer_info.*')
        ->wherebetween('Sheet1.Arrival_DT',[$startWeek,$today])->count();

       // This months customer
        $lastMonth =Carbon::now()->subMonth()->format('Y-m-d');  //dd($lastMonth);
            $Months= DB::table('customer_info')
            ->join('Sheet1','customer_info.Customer_Id','=','Sheet1.Customer_Id')
            ->select('customer_info.*')
            ->wherebetween('Sheet1.Arrival_DT',[$lastMonth,$today])->count();

            //Avrage of room rate
            $rate= DB::table('Sheet1')->AVG('Bill_amount');

            //Avrage of Bookings
            $oldest = DB::table('Sheet1' )->orderBy('Arrival_DT','asc')->get();
            $first = $oldest->first()->Arrival_DT;
            $diff=$today->diffInDays($first);
            $totaloccupancy= $diff*26;// dd($totalDays);
            $booking= DB::table('Sheet1')
            ->wherebetween('Sheet1.Arrival_DT',[$first,$today])->count();
            $percent=($booking/$totaloccupancy)*100;
           //dd($percent);
        //    $avgbooking = $booking/26;// dd($booking);



            //Most visited customers
            $mostVistited= DB::table('Sheet1')
            ->select('Customer_Id','Guest_name',DB::raw('COUNT(*)as `count`'))
            ->groupBy('Customer_Id','Guest_name')->having('count','>',1)->orderBy('count','desc')->get();


            // pie chart
            $city=DB::select(DB::raw("select count(*) as total_city ,CITY from customer_info group by CITY"));
//dd($city);
            $chartdata="";

            foreach($city as $list)
            {
                // $chartdata= $list->CITY ;
                $chartdata.="['".$list->CITY."',   ".$list->total_city."],";
            }
            //dd($chartdata);
            $arr['chartdata']=rtrim($chartdata,",");



        return view('home',compact('todays','data','Weeks','Months','rate','booking','mostVistited','totaloccupancy','percent','chartdata'));

    }


}
