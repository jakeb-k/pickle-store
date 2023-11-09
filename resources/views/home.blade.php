@extends('layouts.master')
@section('content')

    <div id="splashCont">
        <div class="cta">
            <h1>Don't miss out - grab your gear NOW!</h1>
            <p>Ready to elevate your pickleball game? Explore OzPickle's premium selection of paddles, court essentials, and accessories now! Don't miss out on the winning advantage – gear up and dominate the court. Shop at OzPickle and experience pickleball excellence today! 🏓💪 #PlayToWin #OzPicklePower</p>
            <button class="sBtn">GO! →</button>
        </div>

    </div>
    <div class="prodSec">
        <h1>Kits</h1>
        <div class="psBox">
            <img src="{{url('images/pickleLogo.png')}}" alt="starter kit 1" /> 
            <h3>Starter Kit</h3>
        </div>
        <div class="psBox">
            <img src="{{url('images/pickleLogo.png')}}" alt="intermediate kit 1" /> 
            <h3>Intermediate Kit</h3>
        </div>
        <div class="psBox">
            <img src="{{url('images/pickleLogo.png')}}" alt="expert kit 1" /> 
            <h3>Expert Kit</h3>
        </div>
    </div>
@endsection