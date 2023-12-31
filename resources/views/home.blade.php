@extends('layouts.master')
@section('titleDetail')
    - Home 
@endsection
@section('content')

<div id="splashCont">
    <div class="ctaTitle">
        <h1>Welcome to AussiePicklePro - The Pro Aussie Pickleball Outlet! </h1>
        <h3>Don't Miss Out - Grab Your Gear NOW ↓</h3>
        <p>Free Shipping STOREWIDE! </p>
    </div>

    <div id="court">
        <div class="cSec">
            <div class="qcSec">
                <a href="{{url('items/accessories')}}">
                    <img src="{{url('images/a1.jpg')}}" alt="Pickleball balls" />
                    <div class="overlayL">
                        <div class="text">Accessories</div>
                    </div>
                </a>
            </div>
            <div class="qcSec">
                <a href="{{url('items/clothing')}}">
                    <img src="{{url('images/c2.webp')}}" alt="Pickleball shirt" />
                    <div class="overlayL">
                        <div class="text">Clothing</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="cSec" style="flex-direction:row; background:rgba(60,60,60,1)">
            <div class="net"></div>
        </div>
        <div class="cSec">
            <div class="qcSec">
                <a href="{{url('items/court')}}">
                    <img src="{{url('images/x1.webp')}}" alt="Pickleball court" />
                    <div class="overlayR">
                        <div class="text">Court</div>
                    </div>
                </a>
            </div>
            <div class="qcSec">
                <a href="{{url('items/paddles')}}">
                    <img src="{{url('images/p1.webp')}}" alt="Pickleball paddle"/>
                    <div class="overlayR">
                        <div class="text">Paddles</div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>
<h1 class="prodTitle">Kits <a href="{{url('items/kits')}}">View All Kits</a></h1>
<div class="prodSec">
    <div class="psBox"  style="display: none;">
        <img src="{{url('images/pickleLogo.png')}}" alt="starter kit 1" />
        <h3>Starter Kit</h3>
        <p>Introducing our exclusive Beginner's Pickleball Starter Kit, designed to
            kickstart your pickleball journey with everything you need! This
            comprehensive set includes a specially crafted beginner's net for easy
            setup, quality paddles tailored for novice players, gloves offering
            comfort and grip, a pack of balls for countless rallies, and a
            stylish shirt to add a touch of flair to your game. </p>
        <a class="backBtn" href="{{url('product/27')}}" ><i class="fa-regular fa-circle-right fa-2xl" style="font-size: 64px; margin-top:-150px; "></i></a>
    </div>

    <div class="psBox" style="display: none;">
        <img src="{{url('images/pickleLogo.png')}}" alt="intermediate kit 1" />
        <h3>Intermediate Kit</h3>
        <p>Unleash your potential on the pickleball court with our Intermediate
            Player's Kit. Elevate your game with advanced features, including a sturdy
            net designed for skilled play, precision-engineered paddles for enhanced
            control, specialized gloves for a competitive edge, a pro-grade pack of
            balls for consistent performance, and a sleek shirt to showcase your
            commitment to the game.</p>
        <a class="backBtn" href="{{url('product/28')}}"><i class="fa-regular fa-circle-right fa-2xl" style="font-size: 64px;"></i></a>
    </div>

    <div class="psBox" style="display: none;">
        <img src="{{url('images/pickleLogo.png')}}" alt="expert kit 1" />
        <h3>Expert Kit</h3>
        <p>Introducing the Expert Pickleball Player's Kit - a collection tailored for
            those who demand the best on the court. Unleash your mastery with a
            professional-grade net, elite paddles engineered for precision and power,
            expert-level gloves for unparalleled grip, a tournament-quality pack of
            balls for optimal performance, and a high-performance shirt designed for
            top-tier play.</p>
        <a class="backBtn" href="{{url('product/29')}}"><i class="fa-regular fa-circle-right fa-2xl"  style="font-size: 64px;"></i></a>

    </div>
</div>
<script>
    $(document).ready(function() {
    function setPsBoxWidth() {
        const prodSecWidth = $('.prodSec').width();
        const psBoxWidth = prodSecWidth / 3; // Calculate one-third of the container width

        $('.psBox').width(psBoxWidth); // Set the width of .psBox elements
    }

    // Initially set the width of .psBox elements
    setPsBoxWidth();

        function applyPoofEffect(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const smallDivs = $(entry.target).find('.psBox');
                smallDivs.each(function(index, div) {
                    setTimeout(() => {
                        $(div).fadeIn('slow'); // Fades in each .psBox
                    }, index * 500); // Adjust the timing between each .psBox appearance
                });

                observer.unobserve(entry.target); // Stops observing the .prodSec after the effect
            }
        });
    }

        const observer = new IntersectionObserver(applyPoofEffect, { threshold:1 });

        const largeDiv = document.querySelector('.prodSec');
        if (largeDiv) {
            observer.observe(largeDiv);
        }
      

        // Slide in vertically
        $('#court').css('top', '100%');
        $('#court').animate({
            top: '0'
        }, 1000);

      
    });
</script>
@endsection