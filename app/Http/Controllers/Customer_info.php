<?php

namespace App\Http\Controllers;

use App\Customerhistory;
use Carbon\CarbonImmutable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
// use lluminate\Database\MySqlConnection;
use App\Sheet1;
// use DB;


class Customer_info extends Controller
{
    public function Total_customer(Request $request)
    {
        if ($request->has('start_date') && $request->has('end_date')) {
            $start = date('Y-m-d', strtotime($request->input('start_date')));
            $end = date('Y-m-d', strtotime($request->input('end_date')));
        
            $data = DB::table('customerhistory')->select('*')->get();
        
            $groupedData = $data->groupBy('customer_id');
        
            $groupedArray = [];
            foreach ($groupedData as $customerId => $group) {
                $customerMasterData = DB::table('customer_master')
                    ->where('customer_id', $customerId)
                    ->first();
        
                // Apply the date filter to the records within the group
                $filteredRecords = array_filter($group->toArray(), function ($record) use ($start, $end) {
                    $arrivalDate = date('Y-m-d', strtotime($record->ARRIVAL));
                    return ($arrivalDate >= $start && $arrivalDate <= $end);
                });
        
                // Only add to groupedArray if there are filtered records
                if (!empty($filteredRecords)) {
                    $groupedArray[] = [
                        'customer_id' => $customerId,
                        'customer_master' => $customerMasterData,
                        'records' => $filteredRecords,
                    ];
                }
            }
        }  else {
            $data = DB::table('customerhistory')->select('*')->get();

            $groupedData = $data->groupBy('customer_id');

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
        }
        // dd($customer_history);
        $count = count($groupedArray);

        return view('partials.Total_customer', compact('count', 'groupedArray','request'));
    }
    public function Customer_History()
    {
        $customer_history = DB::table('customerhistory')->select('*')->get();
        $customer_history_count = DB::table('customerhistory')->count();
        // dd($customer_history);
        return view('partials.customer_history', compact('customer_history', 'customer_history_count'));
    }


    public function Todays_customer()
    {
        $today = carbon::today();
        $tomorrow = Carbon::tomorrow();
        //dd($today);
        $data = DB::table('customer_master')
            ->join('customerhistory', 'customer_master.customer_id', '=', 'customerhistory.customer_id')
            ->select('*')
            ->wherebetween('customerhistory.ARRIVAL', [$today, $tomorrow])->get();
        // dd($data);
        $todayscount = DB::table('customer_master')
            ->join('customerhistory', 'customer_master.customer_id', '=', 'customerhistory.customer_id')
            ->select('customer_master.*')
            ->wherebetween('customerhistory.ARRIVAL', [$today, $tomorrow])->count();

        return view('partials.Todays_customer', compact('data', 'todayscount'));
    }

    public function Weeks_customer(Request $request)
    {
        // dd($request['start_date']);
        if ($request['start_date'] != null) {
            $start = date('Y-m-d ', strtotime($request['start_date']));
        } else {
            $start = '';
        }
        // $start=date('Y-m-d ', strtotime($request['start_date']));
        // dd($start);
        // $start1=date('Y-m-d', strtotime($request['start_date']))->addDays($days);
        //  $start=$s->format('d-m-Y');

        //    dd($start);
        if ($request['start_date'] == '') {
            $today = carbon::today();
            //$tomorrow = Carbon::tomorrow();
            $startWeek = today()->subDays(7);
            //dd($startWeek);
            $data = DB::table('customer_master')
                ->join('customerhistory', 'customer_master.customer_id', '=', 'customerhistory.customer_id')
                ->select('*')
                ->wherebetween('customerhistory.ARRIVAL', [$startWeek, $today])->orderBy('ARRIVAL', 'desc')->get();
        } else {
            $data = DB::table('customer_master')
                ->select('*')
                ->join('customerhistory', 'customer_master.customer_id', '=', 'customerhistory.customer_id')
                ->where('customerhistory.ARRIVAL', 'like', '%' . $start . '%')->get();
        }
        // dd($data);
        $weekscount = DB::table('customer_master')
            ->join('customerhistory', 'customer_master.customer_id', '=', 'customerhistory.customer_id')
            ->select('customer_master.*')
            ->wherebetween('customerhistory.ARRIVAL', [$startWeek, $today])->count();

        return view('partials.Weeks_customer', compact('data', 'start', 'weekscount'));
    }

    public function Months_customer(Request $request)
    {
        // dd($request);
        $customMonth = $request['custom_month'];
        // dd($customMonth);
        if ($customMonth) {
            $parsedMonth = Carbon::createFromFormat('Y-m', $customMonth, 'UTC')->startOfMonth();
            // dd($parsedMonth);
            $start = $parsedMonth->copy();
            $end = $parsedMonth->copy()->endOfMonth();
            $formattedMonth = $parsedMonth->format('F Y');
        } else {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now();
            $formattedMonth = Carbon::now()->format('F Y');
        }
        // dd($formattedMonth);
        $monthTotal = DB::table('customer_master')
            ->join('customerhistory', 'customer_master.customer_id', '=', 'customerhistory.customer_id')
            ->select('customer_master.*')
            ->whereBetween('customerhistory.ARRIVAL', [$start, $end])
            ->count();

        $data = DB::table('customer_master')
            ->join('customerhistory', 'customer_master.customer_id', '=', 'customerhistory.customer_id')
            ->select('*')
            ->whereBetween('customerhistory.ARRIVAL', [$start, $end])
            ->orderBy('customerhistory.ARRIVAL', 'desc')
            ->get();
            // dd($data);


        return view('partials.Months_customer', compact('data', 'monthTotal','formattedMonth'));
    }

    public function MostVistited(Request $request)
    {
        // $mostVistited= DB::table('Sheet1')->select(DB::raw('select customer_id,Guest_name from Sheet1 Group By customer_id,Guest_name ',DB::raw('COUNT(customer_id)as `count`')));

        $today = carbon::today();

        if (($request['start_date'] != null) && ($request['end_date'] != null)) {

            $start = date('Y-m-d ', strtotime($request['start_date']));
            $end = date('Y-m-d', strtotime($request['end_date']));

            $mostVistited = DB::table('customerhistory')
                ->select('customer_id', 'GUEST_NAME','GUEST_MOBILE', DB::raw('COUNT(customer_id)as `count`'))
                ->groupBy('customer_id', 'GUEST_NAME','GUEST_MOBILE')
                ->orderBy('count', 'desc')
                ->havingRaw('COUNT(customer_id) >= 5')
                ->wherebetween('customerhistory.ARRIVAL', [$start, $end])
                ->get();
        } else {
            $mostVistited = DB::table('customerhistory')
                ->select('customer_id', 'GUEST_NAME','GUEST_MOBILE', DB::raw('COUNT(customer_id)as `count`'))
                ->groupBy('customer_id', 'GUEST_NAME','GUEST_MOBILE')
                ->orderBy('count', 'desc')
                ->havingRaw('COUNT(customer_id) >= 5')
                ->get();
        }

        // $mostVistited = DB::table('customerhistory')
        //     ->select('customer_id', 'GUEST_NAME', DB::raw('COUNT(customer_id)as `count`'))
        //     ->groupBy('customer_id', 'GUEST_NAME')
        //     ->orderBy('count', 'desc')->get();


        // dd($mostVistited);
        $mostcount = count($mostVistited);


        return view('partials.mostvisited', compact('mostVistited', 'mostcount','request'));
    }
    public function LeastVistited(Request $request)
    {
        // $mostVistited= DB::table('Sheet1')->select(DB::raw('select customer_id,Guest_name from Sheet1 Group By customer_id,Guest_name ',DB::raw('COUNT(customer_id)as `count`')));

        $today = carbon::today();

        if (($request['start_date'] != null) && ($request['end_date'] != null)) {

            $start = date('Y-m-d ', strtotime($request['start_date']));
            $end = date('Y-m-d', strtotime($request['end_date']));

            $leastVistited = DB::table('customerhistory')
                ->select('customer_id', 'GUEST_NAME','GUEST_MOBILE', DB::raw('COUNT(customer_id)as `count`'))
                ->groupBy('customer_id', 'GUEST_NAME','GUEST_MOBILE')
                ->orderBy('count', 'asc')
                ->wherebetween('customerhistory.ARRIVAL', [$start, $end])
                ->get();
        } else {
            $leastVistited = DB::table('customerhistory')
                ->select('customer_id', 'GUEST_NAME','GUEST_MOBILE', DB::raw('COUNT(customer_id)as `visitcount`'))
                ->groupBy('customer_id', 'GUEST_NAME','GUEST_MOBILE')
                ->orderBy('visitcount', 'asc')
                ->havingRaw('COUNT(customer_id) < 5')
                ->get();
        }

        // $leastVistited = DB::table('customerhistory')
        //     ->select('customer_id', 'GUEST_NAME', DB::raw('COUNT(customer_id)as `count`'))
        //     ->groupBy('customer_id', 'GUEST_NAME')
        //     ->orderBy('count', 'desc')->get();


        // dd($leastVistited);
        $leastcount = count($leastVistited);
        // dd($leastcount);


        return view('partials.leastvisited', compact('leastVistited', 'leastcount'));
    }

    public function Company_Bookings(Request $request)
    {
        $customersWithSameGst = DB::table('customer_master')
            ->whereNotNull('gst_no')
            ->join('customerhistory', 'customer_master.customer_id', '=', 'customerhistory.customer_id')
            ->groupBy('customer_master.gst_no') // Group by GST number
            ->select('customer_master.gst_no', DB::raw('COUNT(*) as count')) // Select GST number and count of customers
            ->get();
        // dd($customersWithSameGst);
        $customerDetails = DB::table('customer_master')
            ->whereIn('gst_no', $customersWithSameGst->pluck('gst_no'))
            ->get();
        // dd($customerDetails);
        $company_count = count($customersWithSameGst);

        return view('partials.company_bookings', compact('customersWithSameGst', 'company_count', 'customerDetails'));
    }

    public function Company_Customers($gst_no)
    {
        $customersWithGst = DB::table('customer_master')
            ->where('gst_no', $gst_no)
            ->join('customerhistory', 'customer_master.customer_id', '=', 'customerhistory.customer_id')
            ->select('customer_master.*', 'customerhistory.*')
            ->get();
        $groupedCustomers = $customersWithGst->groupBy('customer_id');
        
        // dd($customersWithGst);
        // dd($gst_no);
        $customerDetails = DB::table('customer_master')
            ->whereIn('gst_no', $customersWithGst->pluck('gst_no'))
            ->get();
        $company_name=$customerDetails[0]->company_name;
        // dd($company_name);
        $company_customers_count = count($customersWithGst);

        return view('partials.company_customers', compact('groupedCustomers', 'company_customers_count', 'gst_no','company_name'));
    }



    public function Checkin_3_hr()
    {

        $a = '00:00:00.000000';
        $a1 = '02:59:00.000000';
        $b = '03:00:00.000000';
        $b1 = '05:59:00.000000';
        $c = '06:00:00.000000';
        $c1 = '08:59:00.000000';
        $d = '09:00:00.000000';
        $d1 = '11:59:00.000000';
        $e = '12:00:00.000000';
        $e1 = '14:59:00.000000';
        $f = '15:00:00.000000';
        $f1 = '17:59:00.000000';
        $g = '18:00:00.000000';
        $g1 = '20:59:00.000000';
        $h = '21:00:00.000000';
        $i = '24:00:00.000000';

        $time1 = DB::table('customerhistory')->select('*')->wherebetween(DB::raw('TIME(ARRIVAL)'), [$a, $a1])->count();
        $time2 = DB::table('customerhistory')->select('*')->wherebetween(DB::raw('TIME(ARRIVAL)'), [$b, $b1])->count();
        $time3 = DB::table('customerhistory')->select('*')->wherebetween(DB::raw('TIME(ARRIVAL)'), [$c, $c1])->count();
        $time4 = DB::table('customerhistory')->select('*')->wherebetween(DB::raw('TIME(ARRIVAL)'), [$d, $d1])->count();        //dd($time);
        $time5 = DB::table('customerhistory')->select('*')->wherebetween(DB::raw('TIME(ARRIVAL)'), [$e, $e1])->count();
        $time6 = DB::table('customerhistory')->select('*')->wherebetween(DB::raw('TIME(ARRIVAL)'), [$f, $f1])->count();
        $time7 = DB::table('customerhistory')->select('*')->wherebetween(DB::raw('TIME(ARRIVAL)'), [$g, $g1])->count();
        $time8 = DB::table('customerhistory')->select('*')->wherebetween(DB::raw('TIME(ARRIVAL)'), [$h, $i])->count();
        $time9 = DB::table('customerhistory')->select('*')->wherebetween(DB::raw('TIME(ARRIVAL)'), [$a, $i])->count();
        //  dd($time9);
        return view('sidebar_elements.Checkin_3_hr', compact('time1', 'time2', 'time3', 'time4', 'time5', 'time6', 'time7', 'time8', 'time9'));
    }

    // public function Monthly_Bill()
    // {
    //     $des21 = '2021-12-01 00:00:00';
    //     $enddes21 = '2021-12-31 00:00:00';
    //     $jan22 = '2022-01-01 00:00:00';
    //     $endjan22 = '2022-01-31 00:00:00';
    //     $feb22 = '2022-02-01 00:00:00';
    //     $endfeb22 = '2022-02-28 00:00:00';
    //     $mar22 = '2022-03-01 00:00:00';
    //     $endmar22 = '2022-03-31 00:00:00';
    //     $apr22 = '2022-04-01 00:00:00';
    //     $endapr22 = '2022-04-30 00:00:00';
    //     $may22 = '2022-05-01 00:00:00';
    //     $endmay22 = '2022-05-31 00:00:00';
    //     $jun22 = '2022-06-01 00:00:00';
    //     $endjun22 = '2022-06-30 00:00:00';
    //     $july22 = '2022-07-01 00:00:00';
    //     $endjuly22 = '2022-07-31 00:00:00';
    //     $Aug22 = '2022-08-01 00:00:00';
    //     $endAug22 = '2022-08-31 00:00:00';
    //     $Sept22 = '2022-09-01 00:00:00';
    //     $endSep22 = '2022-09-30 00:00:00';
    //     $Oct22 = '2022-10-01 00:00:00';
    //     $endOct22 = '2022-10-31 00:00:00';
    //     $Nov22 = '2022-11-01 00:00:00';
    //     $endNov22 = '2022-11-30 00:00:00';
    //     $des22 = '2022-12-01 00:00:00';
    //     $enddes22 = '2022-12-31 00:00:00';
    //     $jan23 = '2023-01-01 00:00:00';
    //     $endjan23 = '2023-01-30 00:00:00';
    //     $feb23 = '2023-02-01 00:00:00';
    //     $endfeb23 = '2023-02-28 00:00:00';



    //     $December21r = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$des21, $enddes21])->sum('DAYS'); //dd($December21r);
    //     $December21 = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$des21, $enddes21])->AVG('Bill_amount');
    //     $January22 = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$jan22, $endjan22])->AVG('Bill_amount');
    //     $February22 = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$feb22, $endfeb22])->AVG('Bill_amount');
    //     $March22 = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$mar22, $endmar22])->AVG('Bill_amount');
    //     $April22 = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$apr22, $endapr22])->AVG('Bill_amount');
    //     $May22 = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$may22, $endmay22])->AVG('Bill_amount');
    //     $June22 = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$jun22, $endjun22])->AVG('Bill_amount');
    //     $July22 = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$july22, $endjuly22])->AVG('Bill_amount');
    //     $August22 = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$Aug22, $endAug22])->AVG('Bill_amount');
    //     $September22 = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$Sept22, $endSep22])->AVG('Bill_amount');
    //     $October22 = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$Oct22, $endOct22])->AVG('Bill_amount');
    //     $November22 = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$Nov22, $endNov22])->AVG('Bill_amount');
    //     $December22 = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$des22, $enddes22])->AVG('Bill_amount');
    //     $January23 = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$jan23, $endjan23])->AVG('Bill_amount');
    //     $February23 = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$feb23, $endfeb23])->AVG('Bill_amount');


    //     $January22r = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$jan22, $endjan22])->sum('DAYS');
    //     $February22r = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$feb22, $endfeb22])->sum('DAYS');
    //     $March22r = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$mar22, $endmar22])->sum('DAYS');
    //     $April22r = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$apr22, $endapr22])->sum('DAYS');
    //     $May22r = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$may22, $endmay22])->sum('DAYS');
    //     $June22r = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$jun22, $endjun22])->sum('DAYS');
    //     $July22r = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$july22, $endjuly22])->sum('DAYS');
    //     $August22r = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$Aug22, $endAug22])->sum('DAYS');
    //     $September22r = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$Sept22, $endSep22])->sum('DAYS');
    //     $October22r = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$Oct22, $endOct22])->sum('DAYS');
    //     $November22r = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$Nov22, $endNov22])->sum('DAYS');
    //     $December22r = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$des22, $enddes22])->sum('DAYS');
    //     $January23r = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$jan23, $endjan23])->sum('DAYS');
    //     $February23r = DB::table('Sheet1')->wherebetween('Sheet1.Arrival_DT', [$feb23, $endfeb23])->sum('DAYS');



    //     return view('partials.Monthly_Bill', compact(
    //         'December21',
    //         'January22',
    //         'February22',
    //         'March22',
    //         'April22',
    //         'May22',
    //         'June22',
    //         'July22',
    //         'August22',
    //         'September22',
    //         'October22',
    //         'November22',
    //         'December22',
    //         'January23',
    //         'December21r',
    //         'January22r',
    //         'February22r',
    //         'March22r',
    //         'April22r',
    //         'May22r',
    //         'June22r',
    //         'July22r',
    //         'August22r',
    //         'September22r',
    //         'October22r',
    //         'November22r',
    //         'December22r',
    //         'January23r',
    //         'February23r',
    //         'February23'
    //     ));
    // }
    public function Monthly_Bill()
    {
        $startDate = Carbon::create(2021, 12, 1, 0, 0, 0);
        $endDate = Carbon::today(); // Adjust the end date as needed

        $months = [];

        while ($startDate <= $endDate) {
            $endOfMonth = $startDate->copy()->endOfMonth();
            $avgBill = DB::table('customerhistory')
                ->whereBetween('customerhistory.ARRIVAL', [$startDate, $endOfMonth])
                ->selectRaw('AVG(REPLACE(`BILL AMOUNT`, ",", "") + 0) AS average_amount')
                ->get()[0]->average_amount;

            $months[] = [
                'start' => $startDate->copy(), // Store the Carbon instance
                'end' => $endOfMonth,
                'avgBill' => $avgBill,
                'sumDays' => DB::table('customerhistory')->whereBetween('customerhistory.ARRIVAL', [$startDate, $endOfMonth])->sum('DAYS'),
            ];

            $startDate->addMonth();
        }


        return view('partials.Monthly_Bill', compact('months'));
    }
    public function Details($customer_id)
    {
        $details1 =  DB::table('customer_master')->where('customer_master.customer_id', $customer_id)->first();
        $details = DB::table('customerhistory')->where('customer_id', $customer_id)->get();
    	// Add a serial number to each record
        $serialNumber = 1;
        $detailsWithSerial = [];
        foreach ($details as $detail) {
            $detail->serial_no = $serialNumber;
            $detailsWithSerial[] = $detail;
            $serialNumber++;
        }
        $revenue_amount = $details->sum(function ($item) {
            return $item->{'BILL AMOUNT'} ? str_replace(',', '', $item->{'BILL AMOUNT'}) : 0;
        });
        $arr = $details->sum('DAYS') > 0
            ? round(
                $details->sum(function ($item) {
                    return $item->{'BILL AMOUNT'} ? str_replace(',', '', $item->{'BILL AMOUNT'}) : 0;
                }) / str_replace(',', '', $details->sum('DAYS'))
            )
            : 0;
        // dd($arr);

        // dd($revenue_amount);
        // dd($details);
        return view('partials.Detailsinfo', compact('details', 'details1', 'revenue_amount', 'arr'));

        // return view('partials.Detailsinfo')->with('arr',Sheet1::find($customer_id));

    }
    public function CouponDetails($customer_id)
    {
        $details1 =  DB::table('customer_master')->where('customer_master.customer_id', $customer_id)->first();
        $details = DB::table('customerhistory')->where('customer_id', $customer_id)->get();
        //   dd($details1);
        return view('voucher.voucherlist.create', compact('details', 'details1'));

        // return view('partials.Detailsinfo')->with('arr',Sheet1::find($customer_id));

    }


    public function btwdates()
    {
        // $startDate = Carbon::createFromFormat('Y-m-d', '2022-06-01');
        // $endDate = Carbon::createFromFormat('Y-m-d', '2022-06-30');
        // $users = DB::wherpartials.eDate('Arrival_DT', '>=', $startDate)
        //         ->whereDate('DEPART', '<=', $endDate)
        //         ->get();

        // dd($users);

        //         $visitor = DB::table("Sheet1")
        //         ->select("Stay_id","Guest_name","Arrival_DT","DEPART")
        //         ->where(DB::raw("(DATE_FORMAT(Arrival_DT,'%Y-%m-%d HH:MM:SS'))"),"2022-05-27 13:00:00")
        //         ->get();
        // dd($visitor);

        // $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->subMonth()->toDateString();
        // $lastDayofPreviousMonth = Carbon::now()->endOfMonth()->subMonth()->toDateString();
        // $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->subMonthsNoOverflow()->toDateString();

        // $lastDayofPreviousMonth = Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString();
        // dd($firstDayofPreviousMonth,$lastDayofPreviousMonth);

        // $lastDayofMonth = \Carbon\Carbon::now()->endOfMonth()->toDateString();

        //     dd($lastDayofMonth);

        //  $year=2023;
        //  $month=01;


        $startOfMonth = CarbonImmutable::create(2023, 01, 29);
        // $endOfMonth = $startOfMonth->endOfMonth(2023,01, 5);
        $endOfMonth = 5;
        //  return view('dates',compact(['date'=>$startOfMonth->toPeriod($endOfMonth)]));
        //   echo $dates;
        //     foreach($dates as $key){
        // echo $key;
        //     }
        //     endforeach
        $s = ['dates' => $startOfMonth->toPeriod($endOfMonth)];

        //  $A  = array (
        //         'year' => $startOfMonth->year,
        //         'month' => $startOfMonth->format('F'),
        //       'dates' => $startOfMonth->toPeriod($endOfMonth),

        //  );
        echo ($s[0]);
        //  return view('dates',compact('A'));
    }
}
