@extends('front/layout')
@section('page_title','Category')
@section('container')

    <!-- product category -->
    <section id="aa-product-category">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
                    <div class="aa-product-catg-content">
                        <div class="aa-product-catg-head">
                            <div class="aa-product-catg-head-right">
                                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
                            </div>
                        </div>
                        <div class="aa-product-catg-body">
                            <ul class="aa-product-catg">
                                @foreach ($products as $product)
                                    <li>
                                        <figure>
                                            <a class="aa-product-img" href="{{ url('product/'.$product->slug) }}"><img src="{{ asset('images/'.$product->image) }}" alt="polo shirt img" width="250px" height="300px"></a>
                                            <a class="aa-add-card-btn" href="{{ url('product/'.$product->slug) }}">
                                                view Details
                                            </a>
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
                            </ul>
                            <!-- quick view modal -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
                    <aside class="aa-sidebar">
                        <!-- single sidebar -->
                        <div class="aa-sidebar-widget">
                            <h3>Category</h3>
                            <ul class="aa-catg-nav">
                                @foreach($categoriesLeft as $left_cat)
                                <li><a href="{{ url('categories/'.$left_cat->category_slug) }}">{{ $left_cat->category_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- single sidebar -->
                    </aside>
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


    <form id="filter">
        <input type="hidden" id="sort" name="sort"/>
        <input type="hidden" id="price_start" name="price_start"/>
        <input type="hidden" id="price_end" name="price_end"/>
    </form>
@endsection
