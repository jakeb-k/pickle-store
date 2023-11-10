@extends('layouts.master')
@section('titleDetail')
    - {{ucfirst($type)}}
@endsection
@section('content')
    <div id="prodCont">
        @foreach($products->chunk(3) as $chunk)
            <div class="row">
            @foreach($chunk as $product)
    
                <div class="prodBox">
                    <img src="{{url('images/pickleLogo.png')}}" /> 
                    <a href="{{url('/product/'.$product->id)}}">{{$product->name}} </a> 
                    <div class="pInfo">
                        <p class="price">${{$product->price}}<p>
                        <p>{{$product->rating}} ★</p>
                    </div>
                </div>
            
            @endforeach
            </div>
        @endforeach
        <div class="links">
            {{$products->links()}}
        </div>
    </div>
@endsection
