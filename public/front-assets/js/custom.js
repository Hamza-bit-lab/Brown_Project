/**
  * Template Name: Daily Shop
  * Version: 1.0
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS


  1. CARTBOX
  2. TOOLTIP
  3. PRODUCT VIEW SLIDER
  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  9. PRICE SLIDER  (noUiSlider SLIDER)
  10. SCROLL TOP BUTTON
  11. PRELOADER
  12. GRID AND LIST LAYOUT CHANGER
  13. RELATED ITEM SLIDER (SLICK SLIDER)


**/

jQuery(function($){


  /* ----------------------------------------------------------- */
  /*  1. CARTBOX
  /* ----------------------------------------------------------- */

     jQuery(".aa-cartbox").hover(function(){
      jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
    }
      ,function(){
          jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
      }
     );

  /* ----------------------------------------------------------- */
  /*  2. TOOLTIP
  /* ----------------------------------------------------------- */
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

  /* ----------------------------------------------------------- */
  /*  3. PRODUCT VIEW SLIDER
  /* ----------------------------------------------------------- */

    jQuery('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
        loading_image: 'demo/images/loading.gif'
    });

    jQuery('#demo-1 .simpleLens-big-image').simpleLens({
        loading_image: 'demo/images/loading.gif'
    });

  /* ----------------------------------------------------------- */
  /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery('.aa-popular-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });


  /* ----------------------------------------------------------- */
  /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery('.aa-featured-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */
    jQuery('.aa-latest-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery('.aa-testimonial-slider').slick({
      dots: true,
      infinite: true,
      arrows: false,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });

  /* ----------------------------------------------------------- */
  /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery('.aa-client-brand-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  9. PRICE SLIDER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */

    jQuery(function(){
      if($('body').is('.productPage')){
       var skipSlider = document.getElementById('skipstep');
        noUiSlider.create(skipSlider, {
            range: {
                'min': 0,
                '10%': 500,
                '20%': 700,
                '30%': 900,
                '40%': 1100,
                '50%': 1300,
                '60%': 1600,
                '70%': 1900,
                '80%': 3300,
                '90%': 3700,
                'max': 5000
            },
            snap: true,
            connect: true,
            start: [700, 3300]
        });
        // for value print
        var skipValues = [
          document.getElementById('skip-value-lower'),
          document.getElementById('skip-value-upper')
        ];

        skipSlider.noUiSlider.on('update', function( values, handle ) {
          skipValues[handle].innerHTML = values[handle];
        });
      }
    });



  /* ----------------------------------------------------------- */
  /*  10. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

  //Check to see if the window is top if not then display button

    jQuery(window).scroll(function(){
      if ($(this).scrollTop() > 300) {
        $('.scrollToTop').fadeIn();
      } else {
        $('.scrollToTop').fadeOut();
      }
    });

    //Click event to scroll to top

    jQuery('.scrollToTop').click(function(){
      $('html, body').animate({scrollTop : 0},800);
      return false;
    });

  /* ----------------------------------------------------------- */
  /*  11. PRELOADER
  /* ----------------------------------------------------------- */

    jQuery(window).load(function() { // makes sure the whole site is loaded
      jQuery('#wpf-loader-two').delay(200).fadeOut('slow'); // will fade out
    })

  /* ----------------------------------------------------------- */
  /*  12. GRID AND LIST LAYOUT CHANGER
  /* ----------------------------------------------------------- */

  jQuery("#list-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
  });
  jQuery("#grid-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
  });


  /* ----------------------------------------------------------- */
  /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery('.aa-related-item-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });

});



function change_product_image_color(img, color) {
    jQuery('#color_id').val(color);
  jQuery('.simpleLens-big-image-container').html('<a data-lens-image="'+img+'" class="simpleLens-lens-image"><img src="'+img+'" class="simpleLens-big-image"></a>')
}
jQuery(document).ready(function() {
    var defaultSize = defaultSizeData;
   // alert(defaultSize);
    showColor(defaultSize);
});

function showColor(size) {
    jQuery('#size_id').val(size);
    jQuery('.product_color').hide();
    jQuery('.size_'+size).show();
    jQuery('.size_link').css('border',  '0px');
    jQuery('.size_link#size_'+size).css('border',  '1px solid black');
    // jQuery('.aa-color#color_'+color).css('border',  '1px solid black');
}


function add_to_cart(id, size_str_id, color_str_id) {
    jQuery('#add_to_cart_msg').html('');



    var color_id = jQuery('#color_id').val();
    var size_id = jQuery('#size_id').val();

    if (size_str_id == 0) {
        size_id = 'no';
    }
    if (color_str_id == 0) {
        color_id = 'no';
    }

    if (size_id === '' && size_id !== 'no') {
        jQuery('#add_to_cart_msg').html('<div class="alert alert-danger fade in alert-dismissible mt10"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>Please select size</div>');
    } else if (color_id === '' && color_id !== 'no') {
        jQuery('#add_to_cart_msg').html('<div class="alert alert-danger fade in alert-dismissible mt10"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>Please select color</div>');
    } else if (size_id === 'no') {
        jQuery('#add_to_cart_msg').html('<div class="alert alert-danger fade in alert-dismissible mt10"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>Please select size</div>');
    } else {
        jQuery('#product_id').val(id);
        jQuery('#pqty').val(jQuery('#qty').val());
        jQuery.ajax({
            url: '/add_to_cart',
            data: jQuery('#frmAddToCart').serialize(),
            type: 'post',
            success: function (result) {
                var totalPrice = 0;

                if (result.msg === 'added') {
                    jQuery('#add_to_cart_msg').html('<div class="alert alert-success fade in alert-dismissible mt10"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>Product added to cart successfully!</div>');
                    // reset color and size
                    jQuery('#color_id').val('');
                    jQuery('#size_id').val('');

                } else {
                    jQuery('#add_to_cart_msg').html('<div class="alert alert-info fade in alert-dismissible mt10"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>' + result.msg + '</div>');
                }

                if (result.totalItem == 0) {
                    jQuery('.aa-cart-notify').html('0');
                    jQuery('.aa-cartbox-summary').remove();
                } else {
                    jQuery('.aa-cart-notify').html(result.totalItem);
                    var html = '<ul>';
                    jQuery.each(result.data, function (arrKey, arrVal) {
                        totalPrice = parseInt(totalPrice) + (parseInt(arrVal.qty) * parseInt(arrVal.price));
                        html += '<li><a class="aa-cartbox-img" href="#"><img src="' + PRODUCT_IMAGE + '/' + arrVal.image + '" alt="img"></a><div class="aa-cartbox-info"><h4><a href="#">' + arrVal.name + '</a></h4><p> ' + arrVal.qty + ' * Rs  ' + arrVal.price + '</p></div></li>';
                    });
                }

                html += '<li><span class="aa-cartbox-total-title">Total</span><span class="aa-cartbox-total-price">Rs ' + totalPrice + '</span></li>';
                html += '</ul><a class="aa-cartbox-checkout aa-primary-btn" href="cart">Cart</a>';
                console.log(html);
                jQuery('.aa-cartbox-summary').html(html);
            }
        });
    }
}




function updateQty(pid, size, color, attr_id, price, action) {
    // Make an Ajax call to fetch the available quantity
    $.ajax({
        url: '/get_max_quantity',
        method: 'POST',
        data: {
            size_id: size,
            color_id: color,
            pqty: 1, // You can set any default quantity here for the check
            product_id: pid
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            // Update maxQty with the available quantity
            var maxQty = response.qty;

            // Rest of your code remains the same
            var qtyInput = jQuery('#qty' + attr_id);
            var currentQty = parseInt(qtyInput.val());

            if ((action === 'increase' && currentQty < maxQty) || (action === 'decrease' && currentQty > 1)) {
                var newQty = (action === 'increase') ? currentQty + 1 : currentQty - 1;

                jQuery('#total_price_' + attr_id).html('RS ' + newQty * price);

                qtyInput.val(newQty);

                updateCart(pid, size, color, newQty, attr_id, action);
            } else {
                alert('Quantity cannot exceed ' + maxQty);
            }
        },
        error: function(error) {
            console.error('Error fetching max quantity:', error);
        }
    });
}


function updateCart(pid, size, color, qty, attr_id, action) {
    jQuery.ajax({
        url: '/update_cart',
        method: 'POST',
        data: {
            product_id: pid,
            qty: qty,
            product_attr_id: attr_id,
            action: action
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            console.log(response.msg);

            if (response.error) {
                alert(response.msg);
                // Optionally, reset the quantity to the previous value
                var currentQty = parseInt(jQuery('#qty' + attr_id).val());
                var newQty = (action === 'increase') ? currentQty - 1 : currentQty + 1;
                jQuery('#qty' + attr_id).val(newQty);
                jQuery('#total_price_' + attr_id).html('RS ' + newQty * price);
            }
        },
        error: function (error) {
            console.error('Error updating cart:', error);
        }
    });
}






function deleteCartProduct(pid,size,color,attr_id){
    jQuery('#color_id').val(color);
    jQuery('#size_id').val(size);
    jQuery('#qty').val(0)
    add_to_cart(pid,size,color);
    //jQuery('#total_price_'+attr_id).html('Rs '+qty*price);
    jQuery('#cart_box'+attr_id).hide();
}
function sort_by() {
  var sort_by_value = jQuery('#sort_by_value').val();
  jQuery('#sort').val(sort_by_value);
  jQuery('#filter').submit();
}
function price_filter() {

  jQuery('#price_start').val(jQuery('#skip-value-lower').html());
  jQuery('#price_end').val(jQuery('#skip-value-upper').html());
    jQuery('#filter').submit();
}

function funSearch() {
 var search_str = jQuery('#search_str').val();
 if (search_str!='' && search_str.length>3){
  window.location.href='/search/'+search_str;
 }
}

jQuery('#frmLogin').submit(function(e){
    jQuery('#login_msg').html("");
    e.preventDefault();
    jQuery.ajax({
        url:'/login_process',
        data:jQuery('#frmLogin').serialize(),
        type:'post',
        success:function(result){
            if(result.status=="error"){
                jQuery('#login_msg').html(result.msg);
            }

            if(result.status=="success"){
                window.location.href=window.location.href;

            }
        }
    });
});
function forgot_password() {
   jQuery('#popup_forgot').show();
   jQuery('#popup_login').hide();
}
jQuery('#frmForgot').submit(function (e) {
    jQuery('#forgot_msg').html("Please wait...");
    e.preventDefault();
    jQuery.ajax({
        url: '/forgot_process',
        data:jQuery('#frmForgot').serialize(),
        type: 'post',
        success:function (result) {
            jQuery('#forgot_msg').html(result.msg);
        }
    });
});

jQuery('#frmUpdatePassword').submit(function (e) {
    jQuery('#thank_you_msg').html("Please wait...");
    jQuery('#thank_you_msg').html("");
    e.preventDefault();
    jQuery.ajax({
        url: '/forgot_password_change_process',
        data:jQuery('#frmUpdatePassword').serialize(),
        type: 'post',
        success:function (result) {
            jQuery('#thank_you_msg').html(result.msg);
        }
    });
});
function applyCouponCode() {
    // Clear previous messages
    jQuery('#coupon_code_msg').html('');
    jQuery('#order_place_msg').html('');

    var coupon_code = jQuery('#coupon_code').val();

    if (coupon_code.trim() !== '') {
        // Make an AJAX request to the server
        jQuery.ajax({
            type: 'post',
            url: '/coupon_code',
            data: {
                coupon_code: coupon_code,
                _token: jQuery("[name='_token']").val(),
            },
            success: function (result) {
                console.log(result.status);

                if (result.status === 'success') {
                    jQuery('.show_coupon_box').removeClass('hide');
                    jQuery('#coupon_code_str').html(coupon_code);
                    jQuery('#total_price').html('PKR ' + result.totalPrice);

                    if (result.expired) {
                        jQuery('#coupon_code_msg').html('Coupon has expired.');
                        return;
                    }

                    if (result.usageLimitExceeded) {
                        jQuery('#coupon_code_msg').html('Coupon usage limit exceeded.');
                        return;
                    }

                    jQuery('.apply_coupon_code_box').hide();
                } else if (result.status === 'error') {
                    jQuery('#coupon_code_msg').html(result.msg);
                } else {
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed:', error);
            },
        });
    } else {
        jQuery('#coupon_code_msg').html('Please enter a coupon code');
    }
}
function remove_coupon_code(){
    jQuery('#coupon_code_msg').html('');
    var coupon_code=jQuery('#coupon_code').val();
    jQuery('#coupon_code').val('');
    if(coupon_code!=''){
        jQuery.ajax({
            type:'post',
            url:'/remove_coupon_code',
            data:'coupon_code='+coupon_code+'&_token='+jQuery("[name='_token']").val(),
            success:function(result){
                if(result.status=='success'){
                    jQuery('.show_coupon_box').addClass('hide');
                    jQuery('#coupon_code_str').html('');
                    jQuery('#total_price').html('PKR '+result.totalPrice);
                    jQuery('.apply_coupon_code_box').show();
                }else{

                }
                jQuery('#coupon_code_msg').html(result.msg);
            }
        });
    }
}


// jQuery('#frmPlaceOrder').submit(function (e) {
//     e.preventDefault();
//
//     var selectedPaymentMethod = jQuery('input[name="payment_type"]:checked').val();
//
//     if (selectedPaymentMethod === 'Stripe') {
//         window.location.href = '/stripe';
//         return;
//     }
//
//     jQuery.ajax({
//         url: '/place_order',
//         data: jQuery('#frmPlaceOrder').serialize(),
//         type: 'post',
//         success: function (result) {
//             if (result.status === 'success') {
//                 window.location.href = '/order_placed';
//             }
//             jQuery('#placed_msg').html(result.msg);
//         },
//
//     });
// });

jQuery('#frmPlaceOrder').submit(function (e) {
    e.preventDefault();

    var selectedPaymentMethod = jQuery('input[name="payment_type"]:checked').val();

    if (selectedPaymentMethod === 'Stripe') {
        var stripeForm = document.createElement('form');
        stripeForm.action = '/stripe';
        stripeForm.method = 'post';

        jQuery('#frmPlaceOrder :input').each(function () {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = this.name;
            input.value = jQuery(this).val();
            stripeForm.appendChild(input);
        });

        document.body.appendChild(stripeForm);
        stripeForm.submit();
    } else {
        jQuery.ajax({
            url: '/place_order',
            data: jQuery('#frmPlaceOrder').serialize(),
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                jQuery('#placed_msg').html("Please wait...");
            },
            success: function (result) {
                if (result.status === 'success') {
                    window.location.href = '/order_placed';
                } else {
                    jQuery('#placed_msg').html(result.msg);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
            complete: function () {
                // ...
            }
        });
    }
});




jQuery('#frmProductReview').submit(function(e) {
    e.preventDefault();
    jQuery.ajax({
        url: '/product_review_process',
        data: jQuery('#frmProductReview').serialize(),
        type: 'post',
        success: function(result) {
            if (result.status === "success") {
                jQuery('.review_msg').html(result.msg);
                jQuery('#frmProductReview')[0].reset();
                setTimeout(function() {
                    window.location.href = window.location.href;
                }, 3000);
            } else if (result.status === "error") {
                jQuery('.review_msg').html(result.msg);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
});

