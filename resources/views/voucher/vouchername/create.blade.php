@extends('voucher/layouts.app')

@section('content')
<!-- Breadcomb area Start-->
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Voucher</h2>
                                    <p>Create Master Voucher</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcomb area End-->
<!-- Form area start-->
<div class="form-example-area">
    <div class="container">
        <form method="post" action="{{ action('Voucher\VoucherNameController@store') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-example-wrap">
                        <div class="form-example-int">
                            {{-- Voucher Name --}}
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-support"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control" placeholder="Voucher Name" name="name" required value="{{ old('name') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Short-Coupon Code --}}
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-mail"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control" placeholder="Short Code" name="short_code" required value="{{ old('short_code') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- coupontype -->
                            <!-- <label for="coupon_type">Coupon Type</label> -->
                            <!-- <select class="form-control" name="coupon_type">
                                <option value="discount">Select Coupon Type</option>
                                @foreach($coupontype[0] as $coupontypes)
                                <option value="{{$coupontypes['coupon_type_id']}}">{{$coupontypes['coupon_type_name']}}</option>
                                @endforeach

                            </select> -->

                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-support"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <select class="form-control" name="coupon_type">
                                                <option value="discount">Select Coupon Type</option>
                                                @foreach($coupontype[0] as $coupontypes)
                                                <option value="{{$coupontypes['coupon_type_id']}}">{{$coupontypes['coupon_type_name']}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Dicount Code --}}

                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-support"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <select name="discount_type" id="discountType" class="form-control">
                                                <option value="" disabled selected>Select discount type</option>
                                                <option value="flat">Flat</option>
                                                <option value="percentage">Percentage</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="flatdiscount" style="display: none">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-support"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="number" class="form-control" placeholder="Dicount Amount" name="discount_amount" min="0" value="{{ old('discount_amount') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="percentagediscount" style="display: none;">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-support"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="number" class="form-control" placeholder="Discount Percentage" id="discountPercentageInput" name="discount_percentage" value="{{ old('discount_percentage') }}">
                                            <span>%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>








                            {{-- Total Voucher Quantity --}}
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-support"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="number" class="form-control" placeholder="Total Voucher" name="total_voucher_qty" required min="1" value="{{ old('total_voucher_qty') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Voucher Age --}}
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-support"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="number" class="form-control" placeholder="Voucher Aging (days)" name="period" required value="{{ old('period') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Expiry Date --}}
                            <div class="row">
                                <div class="form-group ic-cmp-int float-lb floating-lb col-md-4">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><label class="nk-label">&nbsp;&nbsp;&nbsp;Expired</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="nk-int-st">
                                                <input type="date" class="form-control" name="expired_date" value="{{ old('expired_date') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int mg-t-15">
                            <button class="btn btn-success notika-btn-success" type="submit">Create Master
                                Voucher</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    var discountTypeDropdown = document.getElementById('discountType');
    var flatDiscountDiv = document.getElementById('flatdiscount');
    var percentageDiscountDiv = document.getElementById('percentagediscount');

    discountTypeDropdown.addEventListener('change', function() {
        if (this.value === 'flat') {
            flatDiscountDiv.style.display = 'block';
            percentageDiscountDiv.style.display = 'none';
        } else if (this.value === 'percentage') {
            flatDiscountDiv.style.display = 'none';
            percentageDiscountDiv.style.display = 'block';
        } else {
            flatDiscountDiv.style.display = 'none';
            percentageDiscountDiv.style.display = 'none';
        }
    });
</script>
<script>
    var discountPercentageInput = document.getElementById('discountPercentageInput');

    discountPercentageInput.addEventListener('input', function() {
        if (parseFloat(this.value) < 0) {
            this.value = '0';
        } else if (parseFloat(this.value) > 100) {
            this.value = '100';
        }
    });
</script>


<!-- Form area End-->
@endsection
