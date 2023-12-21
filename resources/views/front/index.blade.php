@extends('front/layout')
@section('page_title', 'Home Page')
@section('container')

    <!-- Slider section -->
    <section id="aa-slider">
        <div class="aa-slider-area">
            <div id="sequence" class="seq">
                <div class="seq-screen">
                    <ul class="seq-canvas">
                        <!-- single slide item -->
                        @foreach($banners as $banner)
                            <li>
                                <div class="seq-model">
                                    <img data-seq src="{{asset('images/'.$banner->image)}}" />
                                </div>
                                @if($banner->btn_text!='')
                                    <div class="seq-title">
                                        <a data-seq target="_blank" href="{{$banner->btn_link}}" class="aa-shop-now-btn aa-secondary-btn">{{$banner->btn_text}}</a>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- slider navigation btn -->
                <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
                    <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
                    <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
                </fieldset>
            </div>
        </div>
    </section>
    <!-- / Slider section -->

    <!-- Featured, Trending, and Discounted products section -->
    <section id="aa-popular-category">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="aa-popular-category-area">
                            <!-- Product Tabs -->
                            <ul class="nav nav-tabs aa-products-tab">
                                <li class="active"><a href="#featured" data-toggle="tab">Featured</a></li>
                                <li><a href="#trending" data-toggle="tab">Trending</a></li>
                                <li><a href="#discounted" data-toggle="tab">Discounted</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- Featured Products -->
                                <div class="tab-pane fade in active" id="featured">
                                    <ul class="aa-product-catg aa-featured-slider">
                                        @if(isset($homeFeaturedProduct) && $homeFeaturedProduct->isNotEmpty())
                                        @foreach($homeFeaturedProduct as $product)
                                                <li>
                                                    <figure>
                                                        <a class="aa-product-img" href="{{ url('product/'.$product->slug) }}">
                                                            <img src="{{ asset('images/'.$product->image) }}" alt="polo shirt img" width="250px" height="300px">
                                                        </a>
                                                        <a class="aa-add-card-btn" href="{{ url('product/'.$product->slug) }}">
                                                            view Details
                                                        </a>
                                                        <figcaption>
                                                            <h4 class="aa-product-title"><a href="{{ url('product/'.$product->slug) }}">{{ $product->name }}</a></h4>
                                                            @if ($product->productAttributes->isNotEmpty())
                                                                @php
                                                                    $mrp = $product->productAttributes->first()->mrp;
                                                                    $price = $product->productAttributes->first()->price;
                                                                @endphp

                                                                @if ($mrp)
                                                                    <span class="aa-product-price">RS: {{ $price }}</span>
                                                                    <span><del class="small text-dark">RS: {{ $mrp }}</del></span>
                                                                @else
                                                                    <span class="aa-product-price">RS: {{ $price }}</span>
                                                                @endif
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
                                </div>
                                <!-- / Featured Products -->

                                <!-- Trending Products -->
                                <div class="tab-pane fade" id="trending">
                                    <ul class="aa-product-catg aa-featured-slider">
                                        @if(isset($homeTrendingProduct) && $homeTrendingProduct->isNotEmpty())
                                            @foreach($homeTrendingProduct as $product)
                                                <li>
                                                    <figure>
                                                        <a class="aa-product-img" href="{{ url('product/'.$product->slug) }}"><img src="{{ 'images/'.$product->image }}" alt="polo shirt img" width="250px" height="300px"></a>
                                                        <a class="aa-add-card-btn" href="{{ url('product/'.$product->slug) }}">
                                                            view Details
                                                        </a>
                                                        <figcaption>
                                                            <h4 class="aa-product-title"><a href="#">{{ $product->name }}</a></h4>
                                                            @if ($product->productAttributes->isNotEmpty())
                                                                @php
                                                                    $mrp = $product->productAttributes->first()->mrp;
                                                                    $price = $product->productAttributes->first()->price;
                                                                @endphp

                                                                @if ($mrp)
                                                                    <span class="aa-product-price">RS: {{ $price }}</span>
                                                                    <span><del class="small text-dark">RS: {{ $mrp }}</del></span>
                                                                @else
                                                                    <span class="aa-product-price">RS: {{ $price }}</span>
                                                                @endif
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
                                </div>
                                <!-- / Trending Products -->

                                <!-- Discounted Products -->
                                <div class="tab-pane fade" id="discounted">
                                    <ul class="aa-product-catg aa-featured-slider">
                                        @if(isset($homeDiscountedProduct) && $homeDiscountedProduct->isNotEmpty())
                                            @foreach($homeDiscountedProduct as $product)
                                                <li>
                                                    <figure>
                                                        <a class="aa-product-img" href="{{ url('product/'.$product->slug) }}"><img src="{{ 'images/'.$product->image }}" alt="polo shirt img" width="250px" height="300px"></a>
                                                        <a class="aa-add-card-btn" href="{{ url('product/'.$product->slug) }}">
                                                            view Details
                                                        </a>                                                        <figcaption>
                                                            <h4 class="aa-product-title"><a href="{{ url('product/'.$product->slug) }}">{{ $product->name }}</a></h4>
                                                            @if ($product->productAttributes->isNotEmpty())
                                                                @php
                                                                    $mrp = $product->productAttributes->first()->mrp;
                                                                    $price = $product->productAttributes->first()->price;
                                                                @endphp

                                                                @if ($mrp)
                                                                    <span class="aa-product-price">RS: {{ $price }}</span>
                                                                    <span><del class="small text-dark">RS: {{ $mrp }}</del></span>
                                                                @else
                                                                    <span class="aa-product-price">RS: {{ $price }}</span>
                                                                @endif
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
                                </div>
                                <!-- / Discounted Products -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Featured, Trending, and Discounted products section -->

    <!-- Support section -->
    <section id="aa-support">
        <!-- Your support section HTML remains unchanged based on the provided code -->
    </section>
    <!-- / Support section -->

    <!-- Client Brand section -->
    <section id="aa-client-brand">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-client-brand-area">
                        <ul class="aa-client-brand-slider">
                            @foreach($brands as $brand)
                            <li><a href="#"><img src="{{ 'images/'.$brand->image }}" alt="java img" width="154px" height="64px"></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Client Brand section -->

    <!-- Hidden Form for Adding to Cart -->
    <input type="hidden" id="qty" value="1">
    <form id="frmAddToCart">
        <input type="hidden" id="color_id" name="color_id">
        <input type="hidden" id="size_id" name="size_id">
        <input type="hidden" id="pqty" name="pqty">
        <input type="hidden" id="product_id" name="product_id">
        @csrf
    </form>

@endsection
