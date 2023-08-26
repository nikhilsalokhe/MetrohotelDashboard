<?php
namespace App\Http\Controllers\Voucher;

use App\VoucherName;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
class VoucherNameController extends Controller
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
        $voucherNames = VoucherName::all();
        return view('voucher/vouchernames.index', compact('voucherNames'));
        // return view('voucher/vouchernames.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coupontype= Http::get('http://194.163.43.164/MetroBookingEngine/public/api/getcoupontype')->json();

        // $coupontype= Http::get('http://127.0.0.1:8002/api/getcoupontype')->json();
        // dd($coupontype);
        return view('voucher/vouchername.create',compact('coupontype'));
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
        // $this->validate(request(), [
        //     'name' => 'required|max:255',
        //     'short_code' => 'required|unique:voucher_names',
        //     'period' => 'required',
        //     'expired_date' => 'required',
        //     'total_voucher_qty' => 'required',
        //     'discount_percentage' => 'min:0|max:100|step:0.01'
        // ]);

        $name = $request->get('name');
        $short_code = $request->get('short_code');
        $period = $request->get('period');
        $total_voucher_qty = $request->get('total_voucher_qty');
        $expired_date = $request->get('expired_date');
        $discount_type = $request->get('discount_type');
        $discount_amount = $request->get('discount_amount');
        $discount_percentage = $request->get('discount_percentage');
        $coupon_type = $request->get('coupon_type');

        // dd($coupon_type);
        if($coupon_type==1){
            $response = Http::post('http://194.163.43.164/MetroBookingEngine/public/api/storecoupon', [
            // $response = Http::post('http://127.0.0.1:8002/api/storecoupon', [

                
                "coupon_name"=>$name,
                "coupon_type"=>$coupon_type,
                "coupon_validity"=>$expired_date,
                "No_of_coupons"=>$total_voucher_qty,
                "discount_type"=>$discount_type,
                 'discount_percentage'  => $discount_percentage,


                "coupon_status"=>1,
                "coupon_value"=>$discount_amount,
            ]);
        }

        $voucherName = VoucherName::create([
            'name' => $name,
            'short_code' => $short_code,
            'period'    => $period,
            'total_voucher_qty'    => $total_voucher_qty,
            'expired_date'  => $expired_date,
            'discount_type'  => $discount_type,
            'discount_percentage'  => $discount_percentage,

            'discount_amount'  => $discount_amount,
            'coupon_type'  => $coupon_type





        ]);

        $alert="success";
        $message="New Master Voucher is created.";

        return redirect('vouchernames')->with($alert,$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VoucherName  $voucherName
     * @return \Illuminate\Http\Response
     */
    public function show(VoucherName $voucherName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VoucherName  $voucherName
     * @return \Illuminate\Http\Response
     */
    public function edit(VoucherName $voucherName, $id)
    {

        $voucherName = VoucherName::where('id',$id)->first();
        return view('voucher/vouchername.edit',compact('voucherName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VoucherName  $voucherName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VoucherName $voucherName, $id)
    {
        $this->validate(request(), [
            'name' => 'required|max:255',
            'short_code' => 'required',
            'period' => 'required',
            'expired_date' => 'required',
            'total_voucher_qty' => 'required',
            'status' => 'required',
        ]);

        $name = $request->get('name');
        $short_code = $request->get('short_code');
        $period = $request->get('period');
        $total_voucher_qty = $request->get('total_voucher_qty');
        $expired_date = $request->get('expired_date');
        $status = $request->get('status');

        $voucherName = VoucherName::find($id);
        $voucherName->name = $name;
        $voucherName->short_code = $short_code;
        $voucherName->period = $period;
        $voucherName->total_voucher_qty = $total_voucher_qty;
        $voucherName->expired_date = $expired_date;
        $voucherName->active =$status;
        $voucherName->save();

        $alert="success";
        $message="Master Voucher is already updated.";

        return redirect('/vouchernames')->with($alert,$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VoucherName  $voucherName
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoucherName $voucherName)
    {
        //
    }
    public function updateAllCoupon(Request $request){
        VoucherName::where('name',$request->coupon_name)->increment('generate_voucher_qty');
    }
}
