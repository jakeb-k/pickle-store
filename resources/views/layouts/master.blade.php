<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title> Oz Pickle @yield('titleDetail')</title>
        @yield('meta') 
        <link rel="icon" type="image/x-icon" href="{{url('images/favicon.ico')}}">

        <link rel="stylesheet" href="{{asset('css/app.scss')}}" type="text/css">

          
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

       
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
       
        <script src="https://kit.fontawesome.com/0abaa836ef.js" crossorigin="anonymous"></script>
    </head>
    <script>
         $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) { // Adjust the scroll position as needed
                    $('#nav').addClass('shrunken');
                } else {
                    $('#nav').removeClass('shrunken');
                }
                });
            });  
    </script>
    <body>
        
        <div id="nav">
            <!-- SHOP LINK SECTION --> 
            <div class="sImg">
                <a href="{{url('/')}}">
                    <img src="{{url('images/pickleLogo.png')}}" alt="oz pickle logo"/>
                </a>
            </div>
            <div class="sSec">
                

                <div class="cont">
                    <a href="{{url('items/accessories')}}">
                        <h3 class="d-2">Accessories</h3>
                    </a> 
                </div>
                <div class="cont">
                    <a href="{{url('items/paddles')}}">
                        <h3 class="d-2">Paddles</h3>
                    </a> 
                </div><div class="cont">
                    <a href="{{url('items/court')}}">
                        <h3 class="d-2">Court</h3>
                    </a> 
                </div><div class="cont">
                    <a href="{{url('items/kits')}}">
                        <h3 class="d-2">Kits</h3>
                    </a> 
                </div><div class="cont">
                    <a href="{{url('items/clothing')}}">
                        <h3 class="d-2">Clothing</h3>
                    </a> 
                </div>
            </div>
           
                <!-- USER LINK SECTION - ARE BUTTONS NOT <a> --> 
            <div class="uSec">
                @guest
                <div class="uLink">
                    <a href="{{url('/register')}}">
                        <button class="pBtn">Register</button>
                    </a>
                </div>
                @endguest
    
                @auth
                @if(Auth::user()->role != 0)
                <div class="uLink">
                    <a href="{{url('favs/'.Auth::user()->id)}}">
                        <button class="pBtn"><i class="fa-solid fa-heart" ></i></button>
                    </a>
                </div>
                <div class="uLink">
                    <a data-toggle="modal" data-target="#exampleModal2">
                        <button class="pBtn"><i class="fa-solid fa-user" ></i></button>
                    </a>
                </div>
                <div class="uLink">
                    <a data-toggle="modal" data-target="#exampleModal">
                        <button class="pBtn"><i class="fa-solid fa-cart-shopping"></i></button>
                    </a>
                </div>
                @else 
                <div class="uLink">
                    <a  href="{{url('admin')}}">
                        <button class="pBtn">Admin</button>
                    </a>
                </div>
                <div class="uLink">
                    <a  href="{{url('orders')}}">
                        <button class="pBtn">Orders</button>
                    </a>
                </div>
                @endif
                @endauth
                <div class="uLink">
                    @guest
                    <a id="login" href="{{ route('login') }}">
                        <button class="pBtn"><i class="fa-regular fa-user"></i></button>
                    </a>
                    @else
                    <form id="logout" method="POST"action ="{{url('/logout')}}">
                        {{csrf_field()}}
                        <button type="submit" class="pBtn"><i class="fa-solid fa-right-to-bracket"></i></button>
                    </form>
                    @endguest
                </div>
            </div>
        </div>
        @yield('content') 
    </body>
    {{-- CART MODAL START HERE --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <?php $total = 0  ?>
            @if(session('cart') != '[]' and session('cart') != null)
            @auth
                <div id="cartTitle">
                    <em> Order For: </em> <b> {{Auth::user()->name}} </b>
                </div>
            <p class="addy"> {{Auth::user()->address}} · {{date('D jS M y g:i A')}} </p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
          
                {{ csrf_field() }}
            <div class="modal-body">
                  @foreach(session('cart') as $id => $details)
            <?php $total += $details['price'] * $details['quantity'] ?>
            <?php $images = explode(",",$details['image']); ?>
            <div class="cartItem">
                <div id="cartImg">
                    
                     @if($mat->image ?? "")
                    <img src="{{ Storage::disk('public')->url('images/'.$images[0]) }}" /> 
                    
                    @else
                     <img src="{{url('images/noImg.jpg')}}" /> 
                     @endif

                </div>
                <div class="cartInfo"> 
                    <div class="cartDetails">
                        <div class="quantityInput"> 
                               <div> {{$details['quantity']}} </div>
                               <div class="addBtn">
                                 <a href='{{url("add-to-cart/$id")}}'>
                                    <button> + </button>
                                </a></div> 
                                <div>{{$details['name']}}</div>
                        </div>

                            <div id ="clearCart"> 
                                <form method="POST" action='{{url("remove-from-cart")}}'>
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <input type="hidden" name="id" value="{{$id}}" /> 
                                    <button type="submit"> X </button>
                                </form>
                            </div>
                    </div>
                    <div class="cartDetails">
                        <div> 
                            <b> Price </b> 
                        </div>
                        <div>
                            ${{number_format($details['quantity'] * $details['price'], 2)}}
                        </div> 
                    </div>

                </div>
            </div>
            <div class="line">
            </div>
            @endforeach
        @endif
        @if($total != 0)
        <div id="totals">
            <div class="rInfo">
                <div> 
                    Subtotal
                </div>
                <div>
                    ${{number_format($total,2)}}
                </div>
            </div>
            <div class="rInfo">
                <div> 
                    GST
                </div>
                <div>
                    ${{number_format($total*0.1,2)}}
                </div>
            </div>
            <div class="line"> </div>
            <div class="rInfo">
                <div> 
                    <b> Total </b>
                </div>
                <div>
                   <b> ${{number_format(($total + $total*0.1),2)}} </b> 
                </div>
            </div>
        </div>
        <div class="line"> </div>
        <!-- 
        <div id="cartOptions">
            <div id="deleteCart">
                <form method="POST" action='{{url("clear-cart")}}'>
                    {{csrf_field()}}
                    {{method_field('DELETE')}} 
                    <button type="submit"> Clear Cart </button>
                </form>
            </div>
            <div id="purchaseCart">
                <form action='{{url("checkout")}}' method="POST">
                    {{csrf_field()}}
                    <input type="hidden" value="{{number_format(($total + $total*0.1),2)}}" name="price" /> 
                    <button type="submit"> Purchase </button> 
                </form>
            </div>
        </div> --> 

        

        @endauth 
        @else
        <div id="empty">
            <p> Your Cart is Empty! </p> 
        </div>
        @endif
            </div>
        </div>
        </div>
    </div>
    {{-- CART MODAL END HERE --}}

     {{-- acc modal start here  --}}

    @auth
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3> {{Auth::user()->name}}'s Info</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
          
               
            <div class="modal-body">
                    <form id="createForm" method="POST" action='{{url("user/".Auth::user()->id)}}'enctype="multipart/form-data">
                        {{csrf_field()}}
                        
                        <div class="createInput">
                            <label class="form-label"> Name: </label>
                            <input type="text" name="name" placeholder="Enter new Name" value="{{Auth::user()->name}}">
                            @error('name')
                                <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="line"> </div> 
                        
                        <div class="createInput">
                            <label class="form-label"> Email: </label>
                            <input type="text" name="email" placeholder="Enter new Email" value="{{Auth::user()->email}}"> 
                            @error('email')
                                <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="line">
                        </div>

                        <div class="createInput">
                            <label class="form-label"> Address: </label>
                            <input type="text" name="address" placeholder="Enter new Address" value="{{Auth::user()->address}}"> 
                            @error('address')
                                <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="line">
                        </div>
                        
                        <input type="hidden" name="restaurant" value="{{Auth::user()->name}}" readonly>

                        <div class="createSubmit2">
                            <button type="submit"> <p>Update</p> </button>
                        </div> 
                    </form>
                </div> 
        </div>
        </div>
    </div>
    @endauth
    {{--acc modal end here  --}}
</html> 
