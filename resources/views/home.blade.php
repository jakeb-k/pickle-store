@extends('layouts.master')
@section('content')

    <div id="splashCont">
        <div class="ctaTitle">
            <h1>Don't Miss Out - Grab Your Gear NOW ↓</h1>
            <p>Free Shipping STOREWIDE! </p> 
        </div>
        
        <div id="court">
            <div class="cSec">
                <div class="qcSec">
                    <img src="{{url('images/a1.jpg')}}" /> 
                </div>
                <div class="qcSec">
                    <img src="{{url('images/c2.webp')}}" /> 
                </div>
            </div>
            <div class="cSec" style="flex-direction:row; background:rgba(110,110,110,0.65)">
                <div class="net"></div>
            </div>
            <div class="cSec">
                <div class="qcSec">
                    <img src="{{url('images/a1.jpg')}}" /> 
                </div>
                <div class="qcSec">
                    <img src="{{url('images/p1.webp')}}" /> 
                </div> 
            </div>
        </div>

    </div>
    <h1 class="prodTitle">Kits <a href="">View All Kits</a></h1>
    <div class="prodSec">
        <div class="psBox">
            <img src="{{url('images/pickleLogo.png')}}" alt="starter kit 1" /> 
            <h3>Starter Kit</h3>
            <p>Introducing our exclusive Beginner's Pickleball Starter Kit, designed to 
                kickstart your pickleball journey with everything you need! This 
                comprehensive set includes a specially crafted beginner's net for easy 
                setup, quality paddles tailored for novice players, gloves offering 
                comfort and grip, a pack of durable balls for countless rallies, and a 
                stylish shirt to add a touch of flair to your game. </p> 
        </div>

        <div class="psBox">
            <img src="{{url('images/pickleLogo.png')}}" alt="intermediate kit 1" /> 
            <h3>Intermediate Kit</h3>
            <p>Unleash your potential on the pickleball court with our Intermediate 
                Player's Kit. Elevate your game with advanced features, including a sturdy 
                net designed for skilled play, precision-engineered paddles for enhanced 
                control, specialized gloves for a competitive edge, a pro-grade pack of 
                balls for consistent performance, and a sleek shirt to showcase your 
                commitment to the game.</p>
        </div>

        <div class="psBox">
            <img src="{{url('images/pickleLogo.png')}}" alt="expert kit 1" /> 
            <h3>Expert Kit</h3>
            <p>Introducing the Expert Pickleball Player's Kit - a collection tailored for 
                those who demand the best on the court. Unleash your mastery with a 
                professional-grade net, elite paddles engineered for precision and power, 
                expert-level gloves for unparalleled grip, a tournament-quality pack of 
                balls for optimal performance, and a high-performance shirt designed for 
                top-tier play.</p>
        </div>
    </div>
@endsection