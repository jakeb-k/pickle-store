@extends('layouts.master')
@section('titleDetail')
    - {{ucwords($product->name)}}
@endsection
@section('content')
    <div id="detailCont">
        <div class="detailBox">
            <div class="dSec">
                <img src="{{url('images/pickleLogo.png')}}" /> 
            </div> 
            <div class="dSec">
                <h3> {{$product->name}} </h3> 
                <p> {{$product->rating}} ★ (0) </p> 
                <p> 
                    <span class="iPrice"> ${{$product->price*0.15}} </span>
                    <span class="price">${{$product->price}} </span>
                </p>
                <p class="desc">{{$product->description}} </p>
                <button class="purBtn">Add To Cart</button> 
            </div> 

        </div>
        <div class="reviewBox"></div>
    </div>
@endsection