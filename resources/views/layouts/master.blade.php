<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title> Oz Pickle @yield('titleDetail')</title>
        @yield('meta') 

        <link rel="stylesheet" href="{{asset('css/app.scss')}}" type="text/css">

          
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

       
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
       

    </head>
    <body>
        <div id="nav">
            <!-- SHOP LINK SECTION --> 
        <div class="sSec">
            <div class="sLink">
                <img src="{{url('images/pickleLogo.png')}}" alt="oz pickle logo"/>
            </div>
            <div class="sLink">
                <a href="">Accessories</a>
            </div>
            <div class="sLink">
                <a href="">Paddles</a>
            </div>
            <div class="sLink">
                <a href="">Court</a>
            </div>
            <div class="sLink">
                <a href="">Kits</a>
            </div>
            <div class="sLink">
                <a href="">Clothing</a>
            </div>
        </div>
            <!-- USER LINK SECTION - ARE BUTTONS NOT <a> --> 
        <div class="uSec">
            <div class="uLink">
                <a href="">
                    <button class="pBtn">Register</button>
                </a>
            </div>
            <div class="uLink">
                <a href="">
                    <button class="pBtn">Login/Out</button>
                </a>
            </div>
            <div class="uLink">
                <a href="">
                    <button class="pBtn">Wishlist</button>
                </a>
            </div>
            <div class="uLink">
                <a href="">
                    <button class="pBtn">User</button>
                </a>
            </div>
            <div class="uLink">
                <a href="">
                    <button class="pBtn">Admin</button>
                </a>
            </div>
        </div>
        </div>
        @yield('content') 
    </body>
</html> 
