    @extends('front/layout')
@section('page_title','Search')
@section('container')

    <!-- product category -->
    <section id="aa-product-category">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="aa-product-catg-content">

                        <div class="aa-product-catg-body">
                            <ul class="aa-product-catg">
                                <!-- start single product item -->
                                @if(isset($products) && $products->isNotEmpty())
                                    @foreach($products as $product)
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="{{ url('product/'.$product->slug) }}"><img src="{{asset('images/'.$product->image)}}" width="250px" height="300px"></a>
                                                <a class="aa-add-card-btn" href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="{{ url('product/'.$product->slug) }}">{{ $product->name }}</a></h4>
                                                    @if ($product->productAttributes->isNotEmpty())
                                                        <span class="aa-product-price">RS: {{ $product->productAttributes->first()->price }}</span>
                                                        <span><del class="small text-dark">RS: {{ $product->productAttributes->first()->mrp }}</del></span>
                                                    @endif
                                                </figcaption>
                                            </figure>
                                        </li>
                                    @endforeach
                                @else
                                    <li>
                                        <figure>
                                            No Product found
                                        </figure>
                                    </li>
                                @endif

                            </ul>
                            <!-- quick view modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / product category -->

    <input type="hidden" id="qty" value="1"/>
    <form id="frmAddToCart">
        <input type="hidden" id="size_id" name="size_id"/>
        <input type="hidden" id="color_id" name="color_id"/>
        <input type="hidden" id="pqty" name="pqty"/>
        <input type="hidden" id="product_id" name="product_id"/>
        @csrf
    </form>

@endsection
