@extends('layouts.master')
@section('titleDetail')
    - {{$type}}
@endsection
@section('content')
    <div id="prodCont">
        @foreach($products->chunk(3) as $chunk)
            <div class="row">
            @foreach($chunk as $product)
            <div class="prodBox">
                <img src="{{url('images/pickleLogo.png')}}" /> 
                <p>{{$product->name}} </p> 
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
