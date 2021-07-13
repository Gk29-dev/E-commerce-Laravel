@extends('customer/layout')

@section('title','Product Details Page')
@section('content')
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
                        <div class="simpleLens-big-image-container"><a data-lens-image="{{asset('storage/admin_assets/product_images/'.$productData[0]->product_image)}}" class="simpleLens-lens-image"><img src="{{asset('storage/admin_assets/product_images/'.$productData[0]->product_image)}}" class="simpleLens-big-image"></a></div>
                      </div>
                      
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3>{{$productData[0]->product_name}}</h3>
                    <div class="aa-price-block">
                      <span class="aa-product-view-price"><i class="fa fa-rupee"></i>{{$productData[0]->price}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                      <del><span class="aa-product-view-price"><i class="fa fa-rupee"></i>{{$productData[0]->mrp}}</span></del><br>
                      <p class="">Avilability: <span>In stock</span></p>
                      <p class="text-danger font-weight-bold">Delivered In: <span>{{$productData[0]->Deliver_in}}</span></p>
                    </div>
                    <p>{{$productData[0]->short_desc}}</p>
                 
                    <div class="aa-prod-quantity">
                        <select id="qty" name="qty">
                          @php
                            $maxqty =  $productData[0]->qty;
                            @endphp
                            @for($i=1;  $i<= $maxqty; $i++)
                             <option value="{{$i}}" id="qtyvalue">{{$i}}</option>
                            @endfor
                        </select>
                      <p class="aa-prod-category">
                        Brand:  {{$productData[0]->brand}}
                      </p>
                    </div>
                    <div class="aa-prod-view-bottom">
                      @if($maxqty ==0)
                      <a class="aa-add-to-cart-btn btn disabled" id ="add_to_cart">Add To Cart</a>
                      <span class="alert alert-success mx-4" id="cart-msg">Product Coming Soon...
                      @else
                      <a class="aa-add-to-cart-btn btn" id ="add_to_cart">Add To Cart</a>
                      <span class="alert alert-success mx-4" id="cart-msg" style="display: none;">
                      @endif
                           
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2" style="text-align: center !important;">
                <li><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#technical_specification" data-toggle="tab">Technical Specification</a></li>               
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  
                  <ul>
                    <li>{{$productData[0]->desc}}</li>
                  </ul>
                </div>

                <div class="tab-pane fade in" id="technical_specification">
                  <ul>
                      <li>{{$productData[0]->technical_specf}}</li>
                  </ul>
                </div>

                         
              </div>
            </div>
            <!-- Related product -->
            <div class="aa-product-related-item">
              <h3>Related Products</h3>
              <ul class="aa-product-catg aa-related-item-slider">
                <!-- start single product item -->
                @foreach($relProduct as $relproduct)
                  @if($relproduct->id != $productData[0]->id)
                <li>
                  <figure>
                    <a class="aa-product-img" href="{{route('productDetails',['slug'=> $relproduct->product_slug])}}"><img src="{{asset('storage/admin_assets/product_images/'.$relproduct->product_image)}}" alt="Product Image"></a>
                    <a class="aa-add-card-btn"><span class="fa fa-shopping-cart" ></span>Add To Cart</a>
                     <figcaption>
                      <h4 class="aa-product-title"><a href="#">{{$relproduct->product_name}}</a></h4>
                      <span class="aa-product-price"><i class="fa fa-rupee"></i>{{$relproduct->price}}</span>&nbsp;&nbsp;&nbsp;
                      <span class="aa-product-price"><i class="fa fa-rupee"></i><del>{{$relproduct->mrp}}</del></span>
                    </figcaption>
                  </figure>                     
                  <!-- product badge -->
                  <span class="aa-badge aa-sale" href="#">SALE!</span>
                </li>
                @endif
                @endforeach
                 <!-- start single product item -->
                                                                                                
              </ul>
              <!-- quick view modal -->                  
              
              <!-- / quick view modal -->   
            </div>  
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Send Add To Cart Data through Ajax -->
  <form id="addToCartForm">
    @csrf
  <input type="hidden" name="product_id" id="product_id" value="{{$productData[0]->id}}">
  <input type="hidden" name="pqty" id="pqty" >
  </form>
 
    <script>
      $(document).ready(function(){
          $("#add_to_cart").click(function(){

            var product_id = $("#product_id").val();
            var qty = $("#pqty").val($("#qty").val());

            $.ajax({
              url:"{{route('addToCart')}}",
              type:'POST',
              data: $("#addToCartForm").serialize(),
              success:function(result){
                if(result.status == false){
                  $("#login-modal").modal("show");
               }
               else{
                  $("#cart-msg").fadeIn('slow').text(result.cartmsg).fadeOut(3000);
                  $("#cart_value").html(result.countCartProduct);
              }
              }
            });
          });
      });
    </script>
@endsection