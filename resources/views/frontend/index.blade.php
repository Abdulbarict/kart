
<!DOCTYPE html>
<html>
<head>
    <title>kART</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <!-- fancy-box image viwer -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Include SmartCart CSS -->
    <link href="{{ asset('assets/css/smart_cart.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <style>
        /* header css */
        header {
            background-color:'' !important;
        }
        .brand-name {
            color:#fff;
            font-size: 2em;
        }
        #map-canvas {
            width: 100%;
            height:44vh;
        }
    </style>
</head>
<body>

       <!-- start header -->
    <header>
        <div class="container">
            <div class="brand-logo">
                <img src="" class="d-inline-block align-top product_img" alt="">
            </div>
            <div class="brand-name text-center">
                <span class="">{{'Kart'}}</span>
            </div>
        </div>
    </header>

    <!-- end header -->
    <!-- main -->
    <main>
    <section id="about">
            <div class="container text-center">
                <div class="navbar sub">
             
                
                </div>
            </div>
        </section>
        <!-- start search section -->
        <section class="search-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div id="search">
                            <label for="search-input"><i class="fa fa-search" aria-hidden="true"></i><span class="sr-only">Search icons</span></label>
                            <input id="search-input" onkeyup="search()" class="form-control input-lg" placeholder="Search..." autocomplete="off" spellcheck="false" autocorrect="off" tabindex="1">
                                <a id="search-clear" href="#" class="fa fa-times-circle hide" aria-hidden="true"><span class="sr-only">Clear search</span></a>
                        </div>
                    </div>
                </div>
              @if(!is_null($categories))
                <div class="row justify-content-center">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link category-link all-category active" data-category="*">All</a>
                                </li>
                                    @foreach($categories as $category)
                                    <li class="nav-item">
                                    <a class="nav-link category-link" data-category="{{$category->name}}">{{$category->name}}</a>
                                   </li>

                                    @endforeach                          
                            </ul>
                        </div>
               @endif

            </div>

            
            
                    
        </section>
        <!-- end search -->

        <!-- product list -->
        <div class="container">
            <div class="row">
            <p id="noresult" class="w-100 text-center text-muted d-none"></p>
            @foreach($products as $product)
                <div class="col-6 col-md-3 product-details" data-product_name="{{$product->name}}" data-category_name="{{$product->Category}}">
                    <div class="sc-product-item">
                        <div class="card card-poduct d-flex flex-column">
                            <div id="badge-quantity{{$product->id}}" class="quantity-badge bg-success text-white d-none">0</div>
                            <div class="product-img-wrapper mx-auto">
                                <a class="fancybox" href="{{$product->image}}" title="{{$product->name}}">
                                        <img data-name="product_image" src="{{$product->image}}" class="product-img" alt="{{$product->name}}" title="{{$product->name}}">
                                </a>
                            </div>
                            <div class="product-name">
                                <p class="text-center text-uppercase">{{$product->name}}</p>
                                
                            </div>
                            @if($product->use_type )
                            <div class="mt-auto">
                           <div class="variation_wrapper">
                           <div class="form-group">
                           <label>{{$product->type_name}}</label>
                           <select class="form-control variat">
                           @if(!is_null( $product->types))
                           <?php $producttypes = json_decode($product->types,true); ?>
                           @foreach( $producttypes as $type)
                           <option  data-price="{{ number_format( $type['price'] ,3)}}"  data-sale="{{ number_format( $type['disc'] ,3) }}" data-actual=" {{number_format( $type['price'],3) }}" data-variantname="{{$product->name}} - {{ $type['name'] }}" data-product_id="{{$product->id}}">{{ $type['name'] }}</option>
                           
                           @endforeach
                           @endif
                              <select>
                              </div>
                              </div>
                              </div>
                              @endif
                            <div class="mt-auto">
                                <div class="product-price text-center" style="margin-bottom: 5px">
                                
                                    <span >
                                        <del class="actual_price" id="product_actual_price{{$product->id}}">
                                         {{$product->use_type ? number_format( $producttypes[0]['price'],3): number_format($product->price,3)}} 
                                        </del>
                                        <br>
                                        <strong>
                                         <span class="price" id="product_price{{$product->id}}"> {{ $product->use_type ? number_format( $producttypes[0]['disc'],3): number_format($product-> discount_price,$country->decimal_digits)}}<span>
                                        </strong>      
                                    </span>
                      
                                    <div class="cart-add-btn-wrapper text-center">
                                        <button class="btn btn-primary rounded-pill btn-add-cart sc-add-to-cart btn-xs" data-pname="{{$product->name}}"><i class="fa fa-cart-plus" aria-hidden="true"></i> <span> Add to cart</span></button>
                                    </div>
                            </div>
                        </div>
                        </div>
                    </div>
            @endforeach
            </div>
        </div>
    </main>
  <!-- start cart view button -->
    <button class="btn float-btn" data-toggle="modal" data-target="#checkout">
        <div class="flot-icon-wrapper">
            <div class="badge-wrapper">
                <span  class="bg-success d-flex justify-content-center align-items-center sc-cart-count">0</span>
            </div>
            <i class="fa fa-shopping-cart my-float"></i>
        </div>
    </button>
    <!-- end cart view button -->
    
<!-- start  footer section-->
<footer class="footer bg-light text-dark">
    <div class="container">
        <p class="text-center font-weight-light text-muted">Copyright &copy; <strong>kART</strong></p>
    </div>
</footer>
<!-- end  footer section-->
    <!-- Include jQuery -->
    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <!-- fancybox image viwer script -->
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <!-- Include SmartCart -->
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/jquery.smartCart.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- Initialize -->
    <script>


                 
			    	$('.variat').change(function(){
					var option = $(this).find(':selected');
					let variant_price = option.data('price');
                    let sales_price = option.data('sale');
					let actual = option.data('actual').split(" ");
					let actual_price = actual[1] > 0 ? option.data('actual') : '';
					let id = option.data('product_id');

					$('#product_price'+id).html(sales_price);
					$('#product_actual_price'+id).html(actual_price);
					$('#hidden_product_price'+id).val(sales_price);
					let product_name = $('#hidden_product_name'+id).val(option.data('variantname'));
				});
						       
            // Clear search field
        $('#search-clear').click(function(){
            $('#search-input').val('');
            search();
        });
            
        $('.category-link').click(function(){
    // $('#about').hide();
    $('.category-link').removeClass('active');
    $(this).addClass('active');
    var input = $(this).data('category');
    var products = $('.product-details');
    var count = products.length;
    products.hide();
    products.each(function(i, obj) {
        var value = $(this).data('category_name');
        if(value == input) {
            $(this).fadeIn();
        }else{
            count--
            $(this).fadeOut();
        }
    });
    if(input == '*'){
        // $('#about').show();
        products.fadeIn();
    }
});


    </script>
</body>
</html>