<?php

namespace App\Http\Controllers\Voucher;

use App\Customer;
use App\Customer_master;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
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

        // Already Commented
        // $customers = Customer::with(['Customer','Status','VoucherName'])->get();

        $customers = customer_master::has('vouchers')->get();
        // dd($customers);
        return view('voucher.customers.index', compact('customers'));
        // return view('voucher.customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer_master $customer)
    {
        // dd($customer);
        
        $customer = Customer_master::with('vouchers')
                    ->where('customer_id', $customer->customer_id)
                    ->get();
        // $customers = Customer_master::with(['Customer','Status','VoucherName'])
        //             ->where('customer_id', $customer->customer_id)
        //             ->get();
        // dd($customer);

        return view('voucher/customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer_master $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer_master $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer_master $customer)
    {
        //
    }
}
