<?php

namespace App\Http\Controllers\Voucher;

use Carbon\Carbon;

// use App\Customer;
use App\Customerhistory;
use App\Customer_master;
use App\Voucher;
use App\Email;
use App\VoucherName;
use App\StatusList;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class VoucherListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers=Voucher::where('expired_date','<',now())->update(['status_id' => 2]);
        // dd($vouchers);
        $vouchers = Voucher::with(['Customer','Status','VoucherName'])
                    ->orderBy('status_id', 'asc')
                    ->orderBy('created_at', 'desc')
                    ->get();
                    // dd($vouchers);

        return view('voucher/voucherlist.index', compact('vouchers'));
        //  return view('voucher/voucherlist.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $voucherNames =  VoucherName::where('coupon_type',2)->where('active',1)->get(['id', 'name','expired_date']);
        //  dd($voucherNames);
         $customers=Customer_master::all();
         return view('voucher/voucherlist.create',compact('voucherNames','customers'));
        // return view('voucher/voucherlist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
      $namecount =(count($request->name));
       
        // dd($namecount);
        for($i=0;$i < $namecount; $i++){
            // dd($i);
       
        // dd($request);    
   
      
        $name = $request->name[$i];
        // dd($name);
  
        // $email = $request->get('email');
        $mobile = $request->mobile[$i];

        // - cek dulu apakah email sudah ada di daftar customer
        if ($customer = Customerhistory::where('GUEST_MOBILE', $mobile)->first()){
            // - jika sudah ada ambil id customernya
            $customer_id= $customer->customer_id;
        }else{
            // - jika belum ada, insert dulu ke customer lalu ambil id customernya
            $customer = Customer_master::create([
                'name' => $name,
                'mobile' => $mobile,
            ]);
            $customer_id= $customer->customer_id;
        }

  
        // - selanjutnya cek di daftar voucher, jika customer masih mempunyai voucher yang masih berlaku untuk jenis voucher yang sama yang direquest,customer tidak boleh generate lagi.
        if (Voucher::where('customer_id',$customer_id )
                ->where('expired_date','>',now()) //date belum expired
                ->where('status_id',1) //statusnya masih create
                ->first()){
            $alert="warning";
            $message="You still have active voucher";
        }else{
            // - Jika customer tidak mempunyaivoucher yang sama dan berlaku maka voucher dibuatkan
            $voucherName= VoucherName::where('id',$request->voucher)->first();
            // dd($voucherName);
            $expire_date = $voucherName->expired_date;
            $period = $voucherName->period;
            $short_code=$voucherName->short_code;
            $total_voucher = $voucherName->total_voucher_qty;
            $current_voucher_qty = $voucherName->generate_voucher_qty;

            // dd($expire_date);
     
            //cek jika voucher masih tersedia (generate_voucher_qty < total_voucher_qty)
            if($current_voucher_qty<$total_voucher){

                $dt = Carbon::now();

                $expire_date = $voucherName->expired_date;
                $period = $voucherName->period;
                $short_code=$voucherName->short_code;

                $length_days = ($dt->diffInDays($expire_date))+1;

          
                //cek jika antara date now + period melebihi expire date, maka expired date disesuasikan sisa harinya.
                if($length_days >= $period){
                    $expire_date = $dt->addDays($length_days);
                }
            
                //kode generator( kode di voucher name + id + timestamp tanggalsekarang)
                $code=($short_code.$customer_id);

                $voucher = Voucher::create([
                    'code' => $voucherName->name.$customer->customer_id,
                    'customer_id' => $customer_id,
                    'voucher_name_id' => $request->voucher,
                    'expired_date' => ($expire_date),
                    'status_id' => 1 //for first status: create voucher
                ]);


                // send coupon via email

                Email::send($voucherName,$customer);
                // send data via api to MetrohotelEngine
                $response = Http::post('http://194.163.43.164/MetroBookingEngine/public/api/storeCustomerCoupon', [
                // $response = Http::post('http://127.0.0.1:8002/api/storeCustomerCoupon', [

                    "customer_id"=>$customer->customer_id,
                    "customer_name"=>$customer->GUEST_NAME,
                    "customer_mobile_number"=>$customer->GUEST_MOBILE,
                    "voucher_id"=> $voucherName->id,
                    "voucher_code"=>$voucherName->name.$customer->customer_id,
                    "voucher_price" =>$voucherName->discount_amount,
                    "price_percentage"=>$voucherName->discount_percentage,
                    "expriry_date"=>$voucherName->expired_date,

                ]);
                // setelah voucher dibuat, voucher dikirim ke email;
                if($voucher){
                    $voucherName = VoucherName::find($voucher->voucher_name_id);
                    $voucherName->generate_voucher_qty = $current_voucher_qty+1;
                    $voucherName->save();

                    $alert="success";
                    $message="Voucher code is ".$code." created and will also send to customer email";
                }
            }
            else {
                $alert="warning";
                $message="Voucher out of stock";
            }
        }
        // dd($customer);
        }



        return redirect('/MostVistited')->with($alert,$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher,$id)
    {
        $voucher = Voucher::find($id)->with(['Customer','Status','VoucherName'])->first();
        $voucherNames = VoucherName::where('active',1)->get(['id', 'name','expired_date']);
        $status_lists = StatusList::all(['id', 'status']);
        return view('voucher/voucherlist.edit',compact('voucherNames', 'voucher','status_lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voucher $voucher,$id)
    {

        $status = $request->get('status');

        $voucher = Voucher::find($id);
        $code = $voucher->code;
        $voucher->status_id =$status;
        $voucher->save();

        $alert="success";
        $message="Voucher code ".$code." is already updated.";

        return redirect('/voucher-lists')->with($alert,$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Voucher $voucher, $id)
    {
        $voucher = Voucher::find($id);
        $voucher_name_id = $voucher->voucher_name_id;
        $code = $voucher->code;

        $voucher = $voucher->delete();

        if($voucher){
            $voucherName = VoucherName::find($voucher_name_id);

            $current_qty = $voucherName->generate_voucher_qty;

            $voucherName->generate_voucher_qty = $current_qty-1;
            $voucherName->save();
            $message = "Voucher ".$code." has been delete";
        }

        $vouchers = Voucher::with(['Customer','Status','VoucherName'])->get();

        return redirect('/voucher-lists')->with('success',$message);

    }
    public function createVoucher($id)
    {

         $voucherNames = VoucherName::where('coupon_type',2)->where('active',1)->get(['id', 'name','expired_date']);
         $customers=Customer_master::where('customer_id',$id)->get();
        //  dd($customers);
         return view('voucher/voucherlist.create',compact('voucherNames','customers'));
        // return view('voucher/voucherlist.create');
    }

    // Multiple
    public function createMultipleVouchers(Request $request)
    {
        $voucherNames = VoucherName::where('coupon_type',2)->where('active',1)->get(['id', 'name','expired_date']);
        $selectedEmployees = json_decode($request->input('allSelectedEmployees'), true);
        // dd($selectedEmployees);
        $customers = [];
    
        // Loop through the selected employee IDs and create vouchers for them
        foreach ($selectedEmployees as $employeeId) {
            $customer=Customer_master::where('customer_id',$employeeId)->first();
            if ($customer) {
                $customers[] = $customer; // Add each customer to the $customers array
            }
            
        }
        $count=count($customers);
        // dd($count);

        // dd($customers);
        return view('voucher/voucherlist.create',compact('voucherNames','customers','count'));
    }
    

    public static function StatusChange(Request $request){
        // dd($request->coupon_name);
        $couponusedate = Carbon::now();
        $updatecoupon = Voucher::where('code',$request->coupon_name)->update(array('status_id' => 3));
        $updatecoupon = Voucher::where('code',$request->coupon_name)->update(array('coupon_used_date'=>$couponusedate));

        response(true);

    }
}
