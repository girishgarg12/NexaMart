<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sell on NexaMart</title>
  <link href="./output.css" rel="stylesheet">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

  <!-- Vanta.js and Three.js
  <script src="three.r134.min.js"></script>
  <script src="vanta.net.min.js"></script> -->

  <style>
    @keyframes typing {
      from { width: 0; }
      to { width: 100%; }
    }
    @keyframes blink {
      50% { border-color: transparent; }
      100% { border-color: white; }
    }
    .typing-text {
      overflow: hidden;
      white-space: nowrap;
      /* border-right: 3px solid white; */
      animation: typing 3s steps(30, end), blink 0.75s step-end ;
    }
  </style>
</head>
<?php
include 'navbar.php';
?>
<body class="bg-gray-100 min-h-screen flex flex-col justify-between">

  <main class="flex-grow">
    <!-- Hero Section -->
    <section id="sellbg" class="relative h-[90vh] flex items-center justify-center bg-cover bg-center" style="background-image: url(./images/sr6.png);">
      <div  class=" absolute w-full h-full top-0 left-0">

      </div> 
      
      <div class="relative z-10 text-center text-white p-6">
        <h1 class="text-5xl md:text-6xl font-extrabold typing-text">Grow Your Business with NexaMart...</h1>
        <p class="text-xl mt-4">Amplifying Growth, Simplifying Sales</p>
        <div class="mt-8 hover:">
          <a href="sellerreg.php" class="inline-flex items-center gap-3 bg-gradient-to-br from-pink-300 to-yellow-100  text-black/90 font-bold py-3 px-6 font-bold py-3 px-6 rounded-full text-lg 
          shadow-lg
          transform hover:scale-105 transition-transform duration-300">
            Register Now
            <span class="text-xs bg-white text-black/80 px-2 py-1 rounded-full">Get Benefits worth <span class="underline">₹34,000/-</span></span>
          </a>
        </div>
      </div>
    </section>

    <!-- Benefits Section -->
    <section class="max-w-7xl mx-auto p-6 grid gap-6 grid-cols-1 md:grid-cols-3 mt-10">
      <div class="bg-white p-6 rounded-xl shadow-xl hover:scale-105 transition-transform">
        <img src="images/customer_growth.png" class="h-16 mx-auto">
        <h2 class="text-center text-xl font-bold mt-4">Ad Spend Benefits – up to ₹26,000</h2>
        <hr class="border-t-2 border-blue-900 my-2">
        <p class="text-center">Sign-up credits, promotional bonuses, and free ad management support await you!</p>
      </div>

      <div class="bg-white p-6 rounded-xl shadow-xl hover:scale-105 transition-transform">
        <img src="images/join.png" class="h-16 mx-auto">
        <h2 class="text-center text-xl font-bold mt-4">Become a Seller on NexaMart</h2>
        <hr class="border-t-2 border-blue-900 my-2">
        <p class="text-center">Reach millions of customers and businesses 24x7 with ease.</p>
      </div>

      <div class="bg-white p-6 rounded-xl shadow-xl hover:scale-105 transition-transform">
        <img src="images/ads.svg" class="h-16 mx-auto">
        <h2 class="text-center text-xl font-bold mt-4">Fulfilment by NexaMart</h2>
        <hr class="border-t-2 border-blue-900 my-2">
        <p class="text-center">Focus on your business while we handle storage, packing, shipping, and delivery.</p>
      </div>
    </section>

    <!-- Steps Section -->
    <div class="grid grid-rows-[auto_auto]">
            <div class="p-4 text-xl md:text-2xl lg:text-4xl ">Steps to follow</div>
            <div class="flex  p-2 gap-3 justify-center ">
                
                <div class="flex flex-col rounded-md  shadow-xl  w-full bg-white">
                    <img src="./images/sellstep1.svg"  alt="">
                    <div class="p-3">
                        <p class="font-bold text-gray-700 text-xl flex items-center justify-center ">
                            Register
                        </p>
                        <p class="text-center">
                            Register in just 10 mins with valid GST, address, & bank details
                        </p>                         
                    </div>            
                </div>
                <div class="flex flex-col rounded-md  shadow-xl  w-full bg-white">
                        <img src="./images/sellstep2.svg"  alt="">
                        <div class="p-3">
                            <p class=" font-bold text-gray-700 text-xl flex items-center justify-center ">
                                List
                            </p>
                            <p class="text-center">
                                List your products (min 1 no.) that you want to sell on NexaMart.
                            </p> 
                        </div>
                </div>
                <div class="flex flex-col rounded-md   shadow-xl  w-full bg-white">
                    <img src="./images/sellstep3.svg"  alt="">
                    <div class="p-3">
                        <p class="flex items-center justify-center  ">
                            <p class=" font-bold text-gray-700 text-xl flex items-center justify-center ">
                                Order
                            </p>
                            <p class="text-center">
                                Receive orders from over 45 crore+ NexaMart  customers.
                            </p>                            
                        </p>
                    </div>
                </div>
                <div class="flex flex-col rounded-md  shadow-xl  w-full bg-white">
                    <img src="./images/sellstep4.svg"  alt="">
                    <div class="p-3">
                        <p class="font-bold text-xl text-gray-700 text-center ">
                            Ship
                        </p>
                        <p class="text-center">
                            Nexamart ensures stress free delivery of your products
                        </p> 
                    </div>
                </div>
                <div class="flex flex-col rounded-md shadow-xl  w-full bg-white">
                    <img src="./images/sellstep5.svg"  alt="">
                    <div class="p-3">                        
                        <p class="font-bold  text-gray-700 text-xl flex items-center justify-center ">
                            Payment
                        </p>
                        <p class="text-center">
                            Receive payment 7 days* from the date of dispatch of your order
                        </p> 
                    </div>
                </div>

            </div>
        </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white text-center py-6">
    &copy; 2025 NexaMart. All rights reserved.
  </footer>

  <!-- Vanta Background Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      VANTA.NET({
        el: "#sellbg",
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 200.00,
        minWidth: 200.00,
        scale: 1.00,
        scaleMobile: 1.00,
        color: 0x3d1fd6,           // line color
        backgroundColor: 0x000000, // black background
        points: 12.00,
        maxDistance: 20.00
      });
    });
  </script>

</body>
</html>
