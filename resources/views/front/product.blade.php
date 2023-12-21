@extends('front/layout')
@section('page_title', $product->name)
@section('container')
{{--    <div id="alertContainer">jhvv</div>--}}

<style>
    .aa-color-tag a.active {
        box-shadow: 0 0 0 2px black;
    }
</style>

    <section id="aa-product-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-product-details-area">
                        <div class="aa-product-details-content">
                            <div class="row">
                                <!-- Modal view slider -->
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <div class="aa-product-view-slider">
                                        <div id="demo-1" class="simpleLens-gallery-container">
                                            <div class="simpleLens-container">
                                                <div class="simpleLens-big-image-container"><a data-lens-image="{{ asset('images/'.$product->image) }}" class="simpleLens-lens-image"><img src="{{ asset('images/'.$product->image) }}" class="simpleLens-big-image"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal view content -->
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class="aa-product-view-content">
                                        <h3>{{ $product->name }}</h3>
                                        <div class="aa-price-block">
                                            <span class="aa-product-view-price text-danger">Rs {{ $product->productAttributes->first()->price }}&nbsp;&nbsp;</span>
                                            <span class=""><del class="small">Rs {{ $product->productAttributes->first()->mrp }}</del></span>
                                            <p class="aa-product-avilability">Avilability: <span>In stock</span></p>

                                        </div>
                                        <p>{!! $product->short_desc !!}</p>


                                        <h4>Sizes</h4>
                                        <div class="aa-prod-view-size" >
                                            @foreach($uniqueSizes as $index => $size)
                                                <a href="javascript:void(0)" onclick="showColor('{{ $size }}')" id="size_{{ $size }}" class="size_link @if($index === 0) selected @endif">{{ $size }}</a>
                                            @endforeach
                                        </div>

                                        <h4>Colors</h4>
                                        <div class="aa-color-tag">
                                            @foreach($product->productAttributes as $attribute)
                                                @if($attribute->color_id && $attribute->attr_image)
                                                    <a href="javascript:void(0)"
                                                       class="aa-color aa-color-{{ strtolower($attribute->color->color) }} selected product_color size_{{ optional($attribute->size)->size }}"
                                                       onclick="change_product_image_color('{{ asset('images/'.$attribute->attr_image) }}', '{{ $attribute->color->color }}'); setActiveColor(this);">
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="aa-prod-quantity">
                                            <form action="">
                                                <select id="qty" name="qty">
                                                    @for($i=1; $i<11; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </form>
                                            <p class="aa-prod-category">
                                                Model: <a href="#">{{ $product->model }}</a>
                                            </p>
                                        </div>
                                        <div class="aa-prod-view-bottom">
                                            <a class="aa-add-to-cart-btn" href="javascript:void(0)" onclick="add_to_cart('{{ $product->id }}', '{{ $product->productAttributes->first()->color_id }}', '{{ $product->productAttributes->first()->size_id }}')">Add To Cart</a>
                                        </div>
                                        <div id="add_to_cart_msg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="aa-product-details-bottom">
                            <ul class="nav nav-tabs" id="myTab2">
                                <li><a href="#description" data-toggle="tab">Description</a></li>
                                <li><a href="#technical_specification" data-toggle="tab">Technical Specification</a></li>
                                <li><a href="#uses" data-toggle="tab">Uses</a></li>
                                <li><a href="#warranty" data-toggle="tab">Warranty</a></li>
                                <li><a href="#review" data-toggle="tab">Reviews</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="description">
                                    {!! $product->description !!}
                                </div>
                                <div class="tab-pane fade" id="technical_specification">
                                    {!! $product->technical_specs !!}
                                </div>
                                <div class="tab-pane fade" id="uses">
                                    {!! $product->uses !!}
                                </div>
                                <div class="tab-pane fade" id="warranty">
                                    {!! $product->warranty !!}
                                </div>
                                <div class="aa-product-review-area">
                                    @if(isset($productReviews[0]))
                                        <h4>
                                            {{ count($productReviews) }} Review(s) for {{ $product->name }}
                                        </h4>
                                        <ul class="aa-review-nav">
                                            @foreach($productReviews as $review)
                                                <li>
                                                    <div class="media">
                                                        <div clcass="media-body">
                                                            <h4 class="media-heading">
                                                                    <strong style="color: #ff6666">{{ $review->customer->name }}</strong> - <span>{{ \Carbon\Carbon::parse($review->added_on)->format('d/m/Y')}}</span>
                                                            </h4>
                                                            <div class="aa-product-rating">
                                                                <span class="rating_txt">Rated: {{ $review->rating }}</span>
                                                            </div>
                                                            <p>Comment: {{ $review->review }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <h2>No reviews found</h2>
                                    @endif


                                    <form id="frmProductReview" class="aa-review-form">
                                        <h4>Add a review (Login is mandatory)</h4>
                                        <div class="aa-your-rating">
                                            <p>Your Rating</p>
                                            <select class="form-control" name="rating" required>
                                                <option value="">Select Rating</option>
                                                <option>Worst</option>
                                                <option>Bad</option>
                                                <option>Good</option>
                                                <option>Very Good</option>
                                                <option>Fantastic</option>
                                            </select>
                                        </div>
                                        <!-- review form -->

                                        <div class="form-group">
                                            <label for="message">Your Review</label>
                                            <textarea class="form-control" rows="3"  name="review" required></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                        @csrf
                                    </form>
                                    <div class="review_msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="aa-product-related-item">
                            <h3>Related Products</h3>
                            <ul class="aa-product-catg aa-related-item-slider">

                                @forelse($relatedProducts as $relatedProduct)
                                    <li>
                                        <figure>
                                            <a class="aa-product-img" href="{{ url('product/'.$relatedProduct->slug) }}">
                                                <img src="{{ asset('images/'.$relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" width="250px" height="300px">
                                            </a>
                                            <a class="aa-add-card-btn" href="{{ url('product/'.$relatedProduct->slug) }}">
                                                <span class="fa fa-shopping-cart"></span>Add To Cart
                                            </a>
                                            <figcaption>
                                                <h4 class="aa-product-title">
                                                    <a href="{{ url('product/'.$relatedProduct->slug) }}">{{ $relatedProduct->name }}</a>
                                                </h4>
                                                <span class="aa-product-price">Rs {{ $relatedProduct->attributes->first()->price }}</span>
                                                <span class="aa-product-price"><del>Rs {{ $relatedProduct->attributes->first()->mrp }}</del></span>
                                            </figcaption>
                                        </figure>
                                    </li>
                                @empty
                                    <li>
                                        <figure>
                                            No data found
                                        </figure>
                                    </li>
                                @endforelse

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <form id="frmAddToCart">
        <input type="hidden" id="size_id" name="size_id"/>
        <input type="hidden" id="color_id" name="color_id"/>
        <input type="hidden" id="pqty" name="pqty"/>
        <input type="hidden" id="product_id" name="product_id"/>
        @csrf
    </form>

@endsection

@section('js')
    <script>
        var defaultSizeData='{{$defaultSize}}';
    </script>
    <script>
        function setActiveColor(element) {
            var colorElements = document.querySelectorAll('.aa-color-tag a');
            colorElements.forEach(function (el) {
                el.classList.remove('active');
            });

            element.classList.add('active');
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var addToCartBtn = document.getElementById('addToCartBtn');

            addToCartBtn.addEventListener('click', function (event) {
                var soldOut = false;

                @foreach($product->productAttributes as $attribute)
                if ('{{$attribute->qty}}' <= 0) {
                    soldOut = true;
                    break;
                }
                @endforeach

                if (soldOut) {
                    event.preventDefault();
                    document.getElementById('soldOutMessage').style.display = 'block';
                }
            });
        });
    </script>
@endsection
