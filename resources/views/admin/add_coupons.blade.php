@extends('admin.layout')
@section('page_title', 'Add Coupon')
@section('coupon_select', 'active')



@section('container')
    <h1 class="mb10">Edit Coupon</h1>
    <div class="row m-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Edit Coupon</div>
                        <div class="card-body">
                            <form action="{{ route('store_coupon') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="title" class="control-label mb-1">title</label>
                                    <input id="title" name="title" type="text" class="form-control"
                                           aria-required="true" aria-invalid="false">
                                    <span class="text-danger">
                                        @error('title')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="code" class="control-label mb-1">code</label>
                                    <input id="code" name="code" type="text" class="form-control"
                                           aria-required="true" aria-invalid="false">
                                    <span class="text-danger">
                                        @error('code')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div><div class="form-group">
                                    <label for="value" class="control-label mb-1">value</label>
                                    <input id="value" name="value" type="text" class="form-control"
                                           aria-required="true" aria-invalid="false">
                                    <span class="text-danger">
                                        @error('value')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="type" class="control-label mb-1">Type</label>
                                            <select id="type" name="type" class="form-control">
                                                    <option value="Per">Per</option>
                                                    <option value="Value">Value</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="min_amount" class="control-label mb-1">Min Amount</label>
                                            <input id="min_amount" name="min_amount" type="text" class="form-control">
                                            <span class="text-danger">
                                        @error('min_amount')
                                                {{ $message }}
                                                @enderror
                                    </span>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="is_one_time" class="control-label mb-1">Is One Time</label>
                                            <select id="is_one_time" name="is_one_time" class="form-control">
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>edi
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Submit</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
