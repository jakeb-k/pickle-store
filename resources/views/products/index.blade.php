@extends('layouts.master')
@section('titleDetail')
- {{ucfirst($type)}}
@endsection
@section('meta')
Discover top-tier pickleball {{$type}} at AussiePicklePro. 
Shop where the pros shop so you can play like they do. Explore our diverse {{$type}} collection and 
elevate your pickleball experience today!
@endsection
@section('content')

<div id="prodCont">
    <div class="filter">
        <a class="backBtn" href="{{url('/')}}"><i class="fa-regular fa-circle-left"></i></a>
        @if($type != "Wishlist")
        <h1> Filter </h1>
        <div class="dropdown2">
            <button class="dropbtn2"><i class="fa-solid fa-filter" style="color:#ffd100;"> </i></button>
            <div class="dropdown-content2">
                <h3>Filter Options </h3>
                <form method="POST" action='{{url("items/$type/filter")}}'>
                    {{csrf_field()}}
                    <input type="hidden" value="pop" name="filter" />
                    <button type="submit"> Highest Rated </button>
                </form>
                <form method="POST" action='{{url("items/$type/filter")}}'>
                    {{csrf_field()}}
                    <input type="hidden" value="ex" name="filter" />
                    <button type="submit"> Lowest Priced </button>
                </form>
                <form method="POST" action='{{url("items/$type/filter")}}'>
                    {{csrf_field()}}
                    <input type="hidden" value="ch" name="filter" />
                    <button type="submit"> Highest Priced</button>
                </form>
            </div>
        </div>
        @else
        <h1> Wishlist </h1>
        @endif
    </div>

    @foreach($products->chunk(3) as $chunk)
    <div class="row">
        @foreach($chunk as $product)
        <?php 
            $reviews = $product->review; 
            
            $x = 0; 
            foreach($reviews as $r) {
                $x += $r->rating; 
            }
            $product->rating = $x/$product->review()->count(); 
            $product->save(); 
        ?>
        @auth
        @if(Auth::user()->role == 1)
        <?php $check = explode(",", Auth::user()->favs); ?>

        @if(in_array(strval($product->id), $check, true))
        <form class="favForm2" method="POST" action="{{url('user/'.Auth::user()->id.'/new-fav')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('POST')}}
            <input name="product_id" type="hidden" value="{{$product->id}}" />
            <button class="opsBtn" type="submit">
                <i class="fa-solid fa-heart"></i>
            </button>
        </form>
        @else
        <form class="favForm" method="POST" action="{{url('user/'.Auth::user()->id.'/new-fav')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('POST')}}
            <input name="product_id" type="hidden" value="{{$product->id}}" />
            <button class="opsBtn" type="submit">
                <i class="fa-regular fa-heart"></i>
            </button>
        </form>
        @endif


        @elseif(Auth::user()->role == 0)
        <form class="favForm" method="POST" action='{{url("product/$product->id")}}' enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <input name="product_id" type="hidden" value="{{$product->id}}" />
            <button type="submit">
                <i class="fa-regular fa-x"></i>
            </button>
        </form>
        @endif
        @endauth




        <div class="prodBox">
            @if($product->image)
            <?php $images = explode(",", $product->image); ?>
            <img src="{{ Storage::disk('public')->url('images/'.$images[0]) }}" alt="pickleball product photo"/> 
            @else
            <img src="{{url('images/pickleLogo.png')}}" alt="no matching photo found"/>
            @endif
            <a href="{{url('/product/'.$product->id)}}">{{$product->name}} </a>
            <div class="pInfo">
                <div class="prices">
                    @if($product->discount > 0)
                    <p class="dPrice">${{number_format($product->price, 2)}}
                    <p>
                    <p class="price"> ${{number_format($product->price-($product->price*$product->discount), 2)}} </p>
                    @else
                    <p class="price">${{number_format($product->price, 2)}}
                    <p>
                        @endif
                </div>
                <p>{{number_format($product->rating, 2)}} ★</p>
            </div>

        </div>

        @endforeach
    </div>
    @endforeach
    @if($paginated ?? true)
    <div class="links">
        {{$products->links()}}
    </div>
    @endif
</div>
@endsection