@extends('layouts.master')
@section('content')

    <div id="splashCont">
        <div class="cta">
            <h1>Don't miss out - grab your gear NOW!</h1>
            <p>Ready to elevate your pickleball game? Explore OzPickle's premium selection 
                of paddles, court essentials, and accessories now! Don't miss out on the 
                winning advantage – gear up and dominate the court. Shop at OzPickle and 
                experience pickleball excellence today! <br>#PlayToWin #OzPicklePower</p>
            <button class="sBtn">GO! →</button>
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