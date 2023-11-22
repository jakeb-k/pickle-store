@extends('layouts.master')
@section('title')
{{ucwords($product->name)}}
@endsection
@section('content')

<div id="showContainer">
    <div id="itemContainer">

        <div id="showImg">
             @if($product->image)
             <?php $images = explode(",",$product->image); ?>
                    <div class="detailSlides" style="max-width:1200px">
                        <img class="dSlides" src="{{url('storage/images/'.$images[2])}}" style="width:100%;"/>
                        <img class="dSlides" src="{{url('storage/images/'.$images[1])}}" style="width:100%;display:none;"/>
                        <img class="dSlides" src="{{url('storage/images/'.$images[0])}}" style="width:100%;display:none;"/>
                            <div id="slideOps" class="w3-row-padding w3-section">
                                <div class="w3-col s4">
                                    <img class="demo w3-opacity w3-hover-opacity-off" src="{{url('storage/images/'.$images[2])}}" style="width:100%;cursor:pointer" onclick="currentDiv(1)">
                                </div>
                                <div class="w3-col s4">
                                    <img class="demo w3-opacity w3-hover-opacity-off" src="{{url('storage/images/'.$images[1])}}" style="width:100%;cursor:pointer" onclick="currentDiv(2)">
                                </div>
                                <div class="w3-col s4">
                                    <img class="demo w3-opacity w3-hover-opacity-off" src="{{url('storage/images/'.$images[0])}}" style="width:100%;cursor:pointer" onclick="currentDiv(3)">
                                </div>
                            </div>
                        </div>
                       
                @else
                     <img src="{{url('images/noImg.jpg')}}" /> 
                @endif 
        </div>

        <div id="showDetails">
            
            <h1>{{$product->name}}</h1>
            
            <div class="priceRatings">
                <div class="ratingsAvg">
                    {{number_format($product->rating, 2)}} ★ ({{count($reviews)}})
                </div>

                <div id="subtitles"> 
                    @if($product->discount > 0)
                    <div class="discount"> ${{number_format($product->price, 2)}} </div>
                    <div class="emphasis"> ${{number_format($product->price-($product->price*$product->discount), 2)}} </div>
                    @else
                    <div class="emphasis"> ${{number_format($product->price, 2)}} </div>
                    @endif
                </div>
            </div>
           

            <!-- Options Section -->
            <form action='{{url("add-to-cart/$product->id")}}' method="POST">
             {{csrf_field()}}
            @if($clothing)
            <div class="line"></div>
            <label for="option">Choose a size:</label>
            
               
                <select name="size" id="size" style="width:100%;">
                    @foreach($sizes as $s)
                    <option value="{{$s}}">{{$s}}</option>
                    @endforeach
                </select>

                <div class="oSec">
                    @foreach($colors as $c)
                            <input type="radio" id="{{$c}}" name="color" value="{{$c}}" style="display: none;" />
                            <label for="{{$c}}" class="color-label" style="background-color: {{$c}}; border-radius: 50%;"></label>
                            <p style="margin-top:25px; ">{{ucfirst($c)}}</p>
                    @endforeach
                </div>

            @else
            <div class="line"></div>
                @if($colors != [])
                <div class="oSec"> 
                    @foreach($colors as $c)
                            <input type="radio" id="{{$c}}" name="color" value="{{$c}}" style="display: none;" />
                            <label for="{{$c}}" class="color-label" style="background-color: {{$c}}; border-radius: 50%;"></label>
                            <p style="margin-top:25px; ">{{ucfirst($c)}}</p>
                    @endforeach
                </div>
                @endif
                <div class="optSec">
                @foreach($options as $o)
                    <label for="option">{{ucfirst($o->type)}} Options:</label>
                    <input type="hidden" value="{{$o->type}}" /> 
                    <select name="option" id="option" style="width:100%;">
                    @foreach(explode(".",$o->values) as $s)
                    <option value="{{$s}}">{{$s}}</option>
                    @endforeach
                    </select>
                @endforeach
                </div>
            @endif
            @if($colors ?? "")
                <p class="alert" style="color:black;">*No selection means one will be randomly selected!</p>
            @endif
                <div class="line"></div>

                <div id="desc">
                    <p> {{$product->description}} </p>
                </div>

                <div class="line"></div>
                <?php 
                    $del1 = new DateTime();
                    $del2 = new DateTime();

                    $del1 = $del1->modify('+'.$product->delivery.' days'); 

                    $l = $product->delivery + 13; 
                    $del2 = $del2->modify('+'.$l.' days');
                ?>
                <div class="delivery">
                    <p> <b>Estimated Delivery Time:</b>
                    <br>
                    <em>{{$del1->format('D d M.')}} and {{$del2->format('D d M.')}} </em> </p>
                </div>
                @error('color')
                    <div class="alert">{{ $message }}</div>
                @enderror
                @error('size')
                    <div class="alert">{{ $message }}</div>
                @enderror
                @auth
                @if(Auth::user()->role == 0)
                </form>
                        <div id="addCartButton">
                            <a href='{{url("product/$product->id/edit")}}'> 
                                <button>
                                    Edit  
                                </button>
                            </a>  
                        </div>
                @elseif(Auth::user()->role == 1)
                    @if($product->available)
                    <div id="addCartButton">
                        <a>
                            <button type="submit">Add To Cart! </button>
                        </a>
                    </div>
                    @else
                    <div id="addCartButton">
                        <a href='{{url("#")}}'>
                            <button disabled>Item out of Stock</button>
                        </a>
                    </div>
                    @endif
                @endif

                @else
                <div id="addCartButton">
                    <a href='{{url("login")}}'>
                        <button>Login to Start Shopping! </button>
                    </a>
                </div>
                @endauth
            </form>

        </div>

    </div>

    <div id="reviewContainer">
        <h1 class="emphasis">Reviews </h1>
        <div class="reviewBox">
            
            @if($reviews != [])
            @foreach($reviews as $r)
            <div class="reviews">
                <h3>{{$r[0]}} - {{$r[1]}} ★</h3>
                <p>{{$r[2]}}</p>
            </div>
            @endforeach
            @else
            <h3>Be the first to leave a review!</h3>
            @endif
        </div>
        @auth
        <div id="reviewInput">
            <p>Leave a Review</p>
            <form method="POST" action='{{url("addReview/$product->id")}}'>
                {{csrf_field()}}
                
                <!--RATING INPUT -->
                <div>
                    <fieldset class="rating">
                        <label>
                            <input type="radio" name="rating" value="1" />
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="rating" value="2" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="rating" value="3" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>   
                        </label>
                        <label>
                            <input type="radio" name="rating" value="4" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="rating" value="5" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                    </fieldset>
                </div>
                <div>
                    <input type="text" name="content" placeholder="Enter your thoughts on the product" />
                    @error('content')
                        <div class="alert">{{ $message }}</div>
                    @enderror
                    @error('rating')
                        <div class="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="createSubmit3">
                    <button type="submit">
                        Submit Review 
                    </button>
                </div>
            </form>
        </div>
        @else
        <p><a href='{{url("login")}}'>Sign in</a> to leave reviews </p>
        @endauth
         
    </div>


</div>
@endsection
<script>
    
function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("dSlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
}
</script>