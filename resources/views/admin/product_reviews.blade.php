@extends('admin.layout')
@section('page_title', 'Review')
@section('reviews_select', 'active')

@section('container')
    <h1>Product Reviews</h1>

    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
        <tr>
            <th>Product Name</th>
            <th>Customer Name</th>
            <th>Rating</th>
            <th>Review</th>
            <th>Added On</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($reviews as $review)
            <tr>
                <td>{{ $review->product->name ?? 'N/A' }}</td>
                <td>{{ $review->customer->name ?? 'Anonymous' }}</td>
                <td>{{ $review->rating }}</td>
                <td>{{ $review->review }}</td>
                <td>{{ $review->added_on }}</td>
                <td>
                    @if($review->status==1)
                        <a href="{{url('admin/update_product_review_status/0')}}/{{$review->id}}"><button type="button" class="btn btn-primary">Active</button></a>
                    @elseif($review->status==0)
                        <a href="{{url('admin/update_product_review_status/1')}}/{{$review->id}}"><button type="button" class="btn btn-warning">Deactive</button></a>
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="5"><hr></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
