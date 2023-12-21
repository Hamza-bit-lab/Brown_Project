@extends('admin.layout')
@section('page_title', 'Edit Coupon')



@section('container')
    <h1 class="mb10">Edit Coupon</h1>
    <div class="row m-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Edit Coupon</div>
                        <div class="card-body">
                            <form action="{{ route('coupon.update', [$coupon->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div>
                                    <div class="form-group">
                                        <div class="row">
                                    <div class="col-md-4">
                                    <label for="title" class="control-label mb-1">Title</label>
                                    <input id="title" value="{{ $coupon->title }}"
                                           name="title" type="text" class="form-control">
                                    <span class="text-danger">
                                        @error('title')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                    <div class="col-md-4">
                                    <label for="code" class="control-label mb-1">code</label>
                                    <input id="code" value="{{ $coupon->code }}"
                                           name="code" type="text" class="form-control">
                                    <span class="text-danger">
                                        @error('code')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                    <div class="col-md-4">
                                    <label for="value" class="control-label mb-1">value</label>
                                    <input id="value" value="{{ $coupon->value }}"
                                           name="value" type="text" class="form-control">
                                    <span class="text-danger">
                                        @error('value')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="type" class="control-label mb-1">Type</label>
                                                <select id="type" name="type" class="form-control">
                                                    @if($coupon->type == 'Value')
                                                        <option value="value" selected>Value</option>
                                                        <option value="per">%age</option>
                                                    @elseif($coupon->type == 'per')
                                                            <option value="value" selected>Value</option>
                                                            <option value="per" selected>%age</option>
                                                    @else
                                                        <option value="value">Value</option>
                                                        <option value="per">%age</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="min_amount" class="control-label mb-1">Min Amount</label>
                                                <input id="min_amount" value="{{ $coupon->min_amount }}"
                                                       name="min_amount" type="text" class="form-control">
                                                <span class="text-danger">
                                        @error('code')
                                                    {{ $message }}
                                                    @enderror
                                    </span>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="is_one_time" class="control-label mb-1">Is One Time</label>
                                                <select id="is_one_time" name="is_one_time" class="form-control">
                                                    @if($coupon->is_one_time == '1')
                                                        <option value="1" selected>Yes</option>
                                                        <option value="0">No</option>
                                                    @else
                                                        <option value="1">Yes</option>
                                                        <option value="0" selected>No</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Update</span>
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
