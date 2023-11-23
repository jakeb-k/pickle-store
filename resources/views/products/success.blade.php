@extends('layouts.master')
@section('titleDetail')
 - Success
@endsection
@section('content')
    <div id="succCont">
        <a href="{{url('/')}}">Home</a>
        <h1> Order for {{$customer->name}} Successfully Purchased! </h1>
        <p> Check your emails for a confirmation letter within the next 48 hours! </p>
    </div>
@endsection