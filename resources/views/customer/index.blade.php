@extends('customer/layout')

@section('title','Daily Shop | Home')

@section('content')
<!-- Start slider -->
<section id="aa-slider">
  <div class="aa-slider-area">
    <div id="sequence" class="seq">
      <div class="seq-screen">
        <ul class="seq-canvas">
          <!-- single slide item -->
          @foreach($banner as $Banner)
          <li>
            <div class="seq-model">
              <img data-seq src="{{asset('storage/admin_assets/banner_images/'.$Banner->banner_image)}}" alt="Men slide img" />
            </div>
            <div class="seq-title">
              <span data-seq>Save Up to 75% Off</span>
       
              <h2 data-seq>{{$Banner->banner_name}} Collection</h2>
           
              <a data-seq href="/category/{{$Banner->banner_name}}" class="aa-shop-now-btn aa-secondary-btn">{{$Banner->btn_text}}</a>
            </div>
          </li>
          @endforeach
          <!-- single slide item -->
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
<!-- / slider -->
<!-- Start Promo section -->
<section id="aa-promo">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-promo-area">
          <div class="row">
            <!-- promo left --> 
           <!-- promo right -->
            <div class="col-md-12 no-padding">
              <div class="aa-promo-right">
                @foreach($result as $cate)
                <div class="aa-single-promo-right">
                  <div class="aa-promo-banner">
                    <img src="{{asset('storage/admin_assets/category_images/'.$cate->category_image)}}" alt="img">
                    <div class="aa-prom-content">
                      <h4><a href="#">For {{$cate->category_name}}</a></h4>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Promo section -->
<!-- Products section -->
<section id="aa-product">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="aa-product-area">
            <div class="aa-product-inner">
              <!-- start prduct navigation -->
              <ul class="nav nav-tabs aa-products-tab">
                @foreach($result as  $categoriesList)
                @if($categoriesList->id == 1)
                  <li class="active"><a href="#{{$categoriesList->id}}" data-toggle="tab">{{$categoriesList->category_name}}</a></li> 
                @else
                  <li><a href="#{{$categoriesList->id}}" data-toggle="tab">{{$categoriesList->category_name}}</a></li>
                
                @endif
 
                @endforeach
              </ul>
              <!-- Tab panes -->
            
              <div class="tab-content">
                <!-- Start men product category -->
                 @foreach($result as $categoryID)
                
                      @php 
                      $cat = '';
                      if($categoryID->id == 1){
                        $cat = 'fade in active';
                         $id = $categoryID->id;
                      }
                      else{
                        $id = $categoryID->id;
                      }
                        
                       
                         
                      @endphp
                  <div class="tab-pane {{$cat}}" id="{{$id}}">
                    <ul class="aa-product-catg">   
                  @foreach($data[$categoryID->id] as $productInfo)
                    <!-- start single product item -->
                    <li>
                          <figure>
                            <a class="aa-product-img" href="{{route('productDetails',['slug'=> $productInfo->product_slug])}}"><img src="{{asset('storage/admin_assets/product_images/'.$productInfo->product_image)}}" alt="polo shirt img"></a>
                            <a class="aa-add-card-btn btn" id="add_cart" onclick="add_cart('{{$productInfo->id}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                            
                            <figcaption>
                              <h4 class="aa-product-title"><a href="#">{{$productInfo->product_name}}</a></h4>
                              <span class="aa-product-price"><i class="fa fa-rupee"></i>&nbsp;{{$productInfo->price}}</span>
                              <span class="aa-product-price"><del><i class="fa fa-rupee"></i>&nbsp;{{$productInfo->mrp}}</del></span>
                            </figcaption>
                          </figure>                         
                          <!-- product badge -->
                          <span class="aa-badge aa-sale" href="#">SALE!</span>
                    </li>
                  
                       @endforeach
                  </ul>
                  
                </div>
                @endforeach
              
                <!-- / men product category -->
              </div>

            </div>
      
           <a class="aa-browse-btn mb-5" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
  
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- / Products section -->
<!-- banner section -->
<section id="aa-banner">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="aa-banner-area">
            <a href="#"><img src="{{asset('customer_assets/img/fashion-banner.jpg')}}" alt="fashion banner img"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Support section -->
<section id="aa-support" class="mb-4">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-support-area">
          <!-- single support -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="aa-support-single">
              <span class="fa fa-truck"></span>
              <h4>FREE SHIPPING</h4>
              <P>We Provide Free Shipping to Our Prime Members.</P>
            </div>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="aa-support-single">
              <span class="fa fa-phone"></span>
              <h4>SUPPORT 24/7</h4>
              <P>Daily Shopping Customer Service Information is Designed to Make Your Purchasing Experience easy and efficient.</P>
            </div>
          </div>

          <!-- single support -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="aa-support-single">
              <span class="fa fa-clock-o"></span>
              <h4>30 DAYS MONEY BACK</h4>
              <P>Our Policy Offers a full Refund within 30 days of your date of Purchase.</P>
            </div>
          </div>
          <!-- single support -->
        </div>
      </div>
    </div>
  </div>
</section>
<hr>
<!-- / Support section -->


<!-- Latest Blog -->

<!-- / Latest Blog -->

<!-- send Data through Ajax for Add To Cart -->
<form id="addToCartForm">
    @csrf
  <input type="hidden" name="product_id" id="product_id">
  <input type="hidden" name="pqty" id="pqty" value="1" >
  </form>

  <script>
     function add_cart(id){

       $("#product_id").val(id);
       $.ajax({

         url:"{{route('addToCart')}}",
         type:'POST',
         data:$("#addToCartForm").serialize(),
         success: function(result){
           if(result.status == false){
             $("#login-modal").modal("show");
           }
           else{
           alert(result.cartmsg);
           $("#cart_value").html(result.countCartProduct);
          }
         }
       });
     }
  </script>
@endsection