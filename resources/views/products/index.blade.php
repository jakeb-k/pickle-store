@extends('layouts.master')
@section('titleDetail')
    - {{ucfirst($type)}}
@endsection
@section('content')

    <div id="prodCont">
        @foreach($products->chunk(3) as $chunk)
            <div class="row">
            @foreach($chunk as $product)
                
            @auth
                    @if(Auth::user()->role == 1)
                    <?php $check = explode(",",Auth::user()->favs); ?>
                    
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
                    <img src="{{url('images/pickleLogo.png')}}" /> 
                    <a href="{{url('/product/'.$product->id)}}">{{$product->name}} </a> 
                    <div class="pInfo">
                        <div class="prices">
                            @if($product->discount > 0)
                            <p class="dPrice">${{number_format($product->price, 2)}}<p>
                            <p class="price"> ${{number_format($product->price-($product->price*$product->discount), 2)}} </p>
                            @else
                            <p class="price">${{number_format($product->price, 2)}}<p>
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
