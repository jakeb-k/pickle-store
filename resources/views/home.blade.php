@extends('layouts.master')
    @section('content')
    <div id="splashCont">
        <div class="ctaTitle">
            <h1>Welcome to AussiePicklePro </h1>
            <h2>Straya Meets Pickleball!</h2>
            
            <p>Free Shipping STOREWIDE! </p>
        </div>

        <div id="court">
            <div class="cSec">
                <div class="qcSec">
                    <a href="{{url('items/accessories')}}">
                        <img src="{{url('images/a1.webp')}}" alt="Pickleball balls" />
                        <div class="overlayL">
                            <div class="text">Gear</div>
                        </div>
                    </a>
                </div>
                <div class="qcSec">
                    <a href="{{url('items/clothing')}}">
                        <img src="{{url('images/c2.webp')}}" alt="Pickleball shirt" />
                        <div class="overlayL">
                            <div class="text">Apparel</div>
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
        <div class="psBox" >
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

        <div class="psBox">
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

        <div class="psBox">
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
  function applyFadeInEffect(entries) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const smallDivs = $(entry.target).find('.psBox');
        smallDivs.css('opacity', 0); // Set initial opacity to 0
        smallDivs.each(function(index, div) {
          setTimeout(() => {
            $(div).animate({opacity: 1}, 'slow'); // Animate opacity change to 1
          }, index * 400); // Delay the animation for each .psBox
        });

        observer.unobserve(entry.target); // Stop observing the .prodSec after the effect
      }
    });
  }

  const observer = new IntersectionObserver(applyFadeInEffect, { threshold: 0.3 });

  const largeDiv = document.querySelector('.prodSec');
  if (largeDiv) {
    observer.observe(largeDiv);
  } 
});

    </script>
@endsection