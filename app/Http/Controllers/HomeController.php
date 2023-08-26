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
        // $data =  DB::table('customer_master')
        //             ->select('customer_id')
        //             ->distinct()
        //             ->count();  
        $historydata = DB::table('customerhistory')->select('*')->get();

            $groupedData = $historydata->groupBy('customer_id');

            $groupedArray = [];
            foreach ($groupedData as $customerId => $group) {
                $customerMasterData = DB::table('customer_master')
                    ->where('customer_id', $customerId)
                    ->first();

                $groupedArray[] = [
                    'customer_id' => $customerId,
                    'customer_master' => $customerMasterData,
                    'records' => $group->toArray(),
                ];
            }
        $data = count($groupedArray);

        // Customer Bookings Count
        $customer_history_count = DB::table('customerhistory')->count();


        //Todays customer
        $today=carbon::today();
        $tomorrow = Carbon::tomorrow();
        $todays= DB::table('customer_master')
        ->join('customerhistory','customer_master.customer_id','=','customerhistory.customer_id')
        ->select('customer_master.*')
        ->wherebetween('customerhistory.ARRIVAL',[$today,$tomorrow])->count();

        //This Week customer
        $today=carbon::today();
        $startWeek =today()->subDays(7);
        $Weeks = DB::table('customer_master')
        ->join('customerhistory','customer_master.customer_id','=','customerhistory.customer_id')
        ->select('customer_master.*')
        ->wherebetween('customerhistory.ARRIVAL',[$startWeek,$today])->count();

       // This months customer
       $lastMonth=Carbon::now()->startOfMonth();
        // $lastMonth =Carbon::now()->subMonth()->format('Y-m-d');
       //dd($lastMonth);
            $Months= DB::table('customer_master')
            ->join('customerhistory','customer_master.customer_id','=','customerhistory.customer_id')
            ->select('customer_master.*')
            ->wherebetween('customerhistory.ARRIVAL',[$lastMonth,$today])->count();

        //    dd($Months);
            //Avrage of room rate
            // $rate= DB::table('customerhistory')->AVG('BILL AMOUNT');
            $rate = DB::table('customerhistory')
                  ->selectRaw('AVG(REPLACE(`BILL AMOUNT`, ",", "") + 0) AS average_amount')
                  ->get()[0]->average_amount;

            //Avrage of Bookings
            $oldest = DB::table('customerhistory' )->orderBy('ARRIVAL','asc')->get();
            $first = $oldest->first()->ARRIVAL;
            $diff=$today->diffInDays($first);
            $totaloccupancy= $diff*26;// dd($totalDays);
            $booking= DB::table('customerhistory')
            ->wherebetween('customerhistory.ARRIVAL',[$first,$today])->sum('DAYS');
            $percent=($booking/$totaloccupancy)*100;
           //dd($percent);
        //    $avgbooking = $booking/26;// dd($booking);



            //Most visited customers
            $mostVistiteddata= DB::table('customerhistory')
            ->select('customer_id','Guest_name',DB::raw('COUNT(*)as `count`'))
            ->groupBy('customer_id','Guest_name')
            ->having('count','>=',5)
            ->orderBy('count','desc')
            ->get();

            //Get count for most visited customers having more than 5 visits
            $mostVistited=count($mostVistiteddata);
            // dd($mostVistited);

            //Least visited customers
            $leastVistiteddata= DB::table('customerhistory')
            ->select('customer_id','Guest_name',DB::raw('COUNT(*)as `count`'))
            ->groupBy('customer_id','Guest_name')
            ->havingRaw('COUNT(*) < 5')
            ->orderBy('count','desc')
            ->get();

            //Get count for lesst visited customers having more than 5 visits
            $leastVistited=count($leastVistiteddata);
            // dd($leastVistited);

                $Company_Bookings = DB::table('customer_master')
                ->whereNotNull('gst_no')
                ->join('customerhistory', 'customer_master.customer_id', '=', 'customerhistory.customer_id')
                ->groupBy('customer_master.gst_no') // Group by GST number
                ->select('customer_master.gst_no', DB::raw('COUNT(*) as count')) // Select GST number and count of customers
                ->get();
            // dd($customersWithSameGst);

                $company_count=count($Company_Bookings);


            // pie chart
            $city=DB::select(DB::raw("select count(*) as total_city ,city from customer_master group by city ORDER BY count(*) DESC limit 10"));
            //dd($city);
            $chartdata="";
             foreach($city as $list)
            {
                //$chartdata= $list->city ;
               $chartdata.="['".$list->city."',   ".$list->total_city."],";
            }
           // dd($chartdata);
            $arr['chartdata']=rtrim($chartdata,",");

        //     $ci=DB::select(DB::raw("select count(*) as total_city ,city from customer_master group by city ORDER BY count(*) DESC"));
        //    // dd($ci);

        return view('home',compact('customer_history_count','todays','data','Weeks','Months','rate','booking','mostVistited','leastVistited','totaloccupancy','percent','company_count','chartdata'));

    }

}
