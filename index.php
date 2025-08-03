<?php
session_start();
include 'navbar.php';
include 'login1.php';
include 'bot.php';
include 'dbdetails.php';
$delses=$_GET['delses'] ?? 'no';
if($delses==='yes'){
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_SESSION['cartitems'])) {
        foreach ($_SESSION['cartitems'] as $item) {
            $prodsn=$item['sno'];
            $cartCount2 += $item['quant'];
            $sql ="INSERT INTO orderdetails (`prodsno`,`quantity`) values('$prodsn','$cartCount2');";
            $conn->query($sql);
        }
    }
     
    unset($_SESSION['cartitems']);
}
$timeout_duration = 300;
if (isset($_SESSION['LAST_ACTIVITY']) && 
    (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    // Last request was more than 10 minutes ago
    session_unset();     // Unset $_SESSION variable
    session_destroy();
    $_SESSION['LAST_ACTIVITY'] = time();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    // <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <style>
        .swiper-pagination {
            position: absolute;
            bottom: 10px;
        }

        .swiper-pagination-bullet {
            background: white;
        }

        :root {
            --swiper-navigation-color: #ffffff;
            --swiper-pagination-color: #ffffff;
        }

        .swiper-button-next svg,
        .swiper-button-prev svg {
            color: white !important;
        }
    </style>
</head>

<body class="bg-gray-50">
    
<div id="overlay" class="fixed inset-0 bg-black/60 bg-opacity-50 z-[60] hidden"></div>
    <main class="relative m-0 p-0 w-full">
        <!-- Banner Section -->
        <div class="relative w-full flex items-center justify-between px-10 py-10">
            <!-- Left Side Content -->
            <div class="w-[40%] space-y-5 mt-20">
                <h1 class="text-4xl font-bold text-gray-800 ">Begin Your Selling Journey on Nexamart</h1>
                <p class=" text-lg text-gray-600 ">Join us today and start selling your products to a wider audience.</p>
                <div class="flex space-x-4">
                    <a href="seller.php" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">Start
                        Selling</a>
                    <a href="sell.php" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg shadow-md hover:bg-gray-300">Know
                        More</a>
                </div>
            </div>
            <div class="absolute right-0 top-10 w-[60%] border rounded-tl-full rounded-bl-full overflow-hidden">
                <div class="swiper mySwiper w-full ">
                    <div class="swiper-wrapper w-full h-[400px] ">
                        <?php
                        if(!$conn){
                            die("connection to database failed");
                        }
                        else{
                            
                            $quer="SELECT * FROM `promotion`";
                            $result=$conn->query($quer);
                            if($result->num_rows>0){
                                while($row=$result->fetch_assoc()){
                                    $prodname=$row['prodname'];
                                    $link=$row['prodimagelink'];
                                    echo"<div class='swiper-slide w-full h-[400px]'>
                                        <img src='{$link}' class='w-full h-[400px] object-cover rounded-tl-full rounded-bl-full'
                                            alt='Banner '>
                                        </div>";
                                }
                            }
                            else{
                                echo"<div class='swiper-slide'>
                                        <img src='images/banner3.png' class='w-full h-[400px] object-cover rounded-tl-full rounded-bl-full'
                                            alt='Banner '>
                                    </div>
                                    <div class='swiper-slide'>
                                        <img src='images/banner4.png' class='w-full h-[400px] object-cover rounded-tl-full rounded-bl-full'
                                            alt='Banner '>
                                    </div>";
                            }
                        }
                        ?>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>

        <!-- Spacer to push content below the banner -->
        <div class="h-[400px]"></div>

        <!-- Main Content -->
        <div class="grid grid-rows-[auto_auto_auto] gap-6 py-2 -mt-75">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 px-2 min-h-60">
                <a href="products.php?category=Mobile Phones">
                <div
                    class="bg-white min-h-full p-2 shadow-md flex flex-col justify-between hover:scale-105 duration-170 transition-transform">
                    <h1 class="font-semibold px-3">iPhone 16 Pro &<br>
                        iPhone 16 Pro Max</h1>
                    <img src="./images/iphone.jpeg" class="">
                    <h2 class="text-center text-gray-600">Starting from ₹9825.00/mo.</h2>
                </div></a>
                <a href="products.php?category=Smart Watches">
                <div
                    class="bg-white min-h-full p-2 shadow-md flex flex-col justify-between hover:scale-105 duration-170 transition-transform">
                    <h1 class="px-2 font-semibold">Noise ColorFit Pro 6 Max</h1>
                    <img src="./images/watch3.webp" class="h-[80%] w-[80%] mx-auto">
                    <h2 class="text-center text-gray-600">1.96" AMOLED Display,AI Companion </h2>
                </div></a>
                <a href="products.php?category=Earbuds">
                <div
                    class="bg-white min-h-full p-2 shadow-md flex flex-col justify-between hover:scale-105 duration-170 transition-transform">
                    <h1 class="px-2 font-semibold">OnePlus Buds Pro 3</h1>
                    <img src="./images/earbuds'.webp" class="h-[80%] w-[80%] mx-auto">
                    <h2 class="text-center text-gray-600">Real-time-adaptive noise canceling up to 50 dB</h2>
                </div></a>
                <a href="products.php?category=Laptops">
                <div
                    class="bg-white min-h-full p-2 shadow-md flex flex-col justify-between hover:scale-105 duration-170 transition-transform">
                    <h1 class="px-2 font-semibold">Galaxy Book5 360</h1>
                    <img src="./images/laptop.png" class="h-[60%] w-[90%] mx-auto">
                    <h2 class="text-center text-gray-600">2-in-1 Laptop | AMOLED | Touchscreen | S Pen Included</h2>
                </div></a>
            </div>
            <div class="grid grid-cols-2 gap-5 px-2 min-h-60 max-w-[100%]">
                <a href="products.php?category=Footwear">   
                <div class="bg-white min-h-full rounded  shadow-md hover:scale-[1.02] duration-170 transition-transform">
                    <img src="./images/adidas.jpg" class="h-80 w-full">
                </div></a>
                <a href="products.php?category=Clothing">
                <div class="bg-white min-h-full rounded  shadow-md hover:scale-[1.02] duration-170 transition-transform">
                    <div class="flex flex-row overflow-hidden">
                        <img src="./images/hoodie1.avif" class="h-80 w-full">
                        <img src="./images/hooide2.avif" class="max-h-80 w-full">
                    </div>
                </div></a>
            
            </div>
            <a href="products.php?category=Miscellaneous">
            <div class="grid grid-cols-1 px-2 min-h-60">
                <div class="bg-white min-h-full rounded p-4 shadow-lg">
                    <h1 class="font-semibold text-2xl mb-4 text-gray-800">Top Deals from Small Businesses</h1>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        <div class="bg-gray-100 p-3 rounded-lg hover:scale-105 transition-transform duration-200 shadow-sm">
                            <img src="images/waterbottle.webp" class="h-40 w-full object-contain mb-2 rounded-md" alt="Water Bottle">
                            <h2 class="images/text-sm text-gray-700 text-center">Eco Stainless Water Bottle</h2>
                        </div>
                        <div class="bg-gray-100 p-3 rounded-lg hover:scale-105 transition-transform duration-200 shadow-sm">
                            <img src="images/trekbag.webp" class="h-40 w-full object-contain mb-2 rounded-md" alt="Trekking Bag">
                            <h2 class="text-sm text-gray-700 text-center">Mountain Trekking Backpack</h2>
                        </div>
                        <div class="bg-gray-100 p-3 rounded-lg hover:scale-105 transition-transform duration-200 shadow-sm">
                            <img src="images/sunglass.webp" class="h-40 w-full object-contain mb-2 rounded-md" alt="Sunglasses">
                            <h2 class="text-sm text-gray-700 text-center">UV Protection Sunglasses</h2>
                        </div>
                        <div class="bg-gray-100 p-3 rounded-lg hover:scale-105 transition-transform duration-200 shadow-sm">
                            <img src="images/handmade-bag.webp" class="h-40 w-full object-contain mb-2 rounded-md" alt="Handmade Bag">
                            <h2 class="text-sm text-gray-700 text-center">Handmade Jute Bag</h2>
                        </div>
                        <div class="bg-gray-100 p-3 rounded-lg hover:scale-105 transition-transform duration-200 shadow-sm">
                            <img src="images/organic-soap.webp" class="h-40 w-full object-contain mb-2 rounded-md" alt="Organic Soap">
                            <h2 class="text-sm text-gray-700 text-center">Organic Herbal Soaps</h2>
                        </div>
                        <div class="bg-gray-100 p-3 rounded-lg hover:scale-105 transition-transform duration-200 shadow-sm">
                            <img src="images/bamboo-brush.webp" class="h-40 w-full object-contain mb-2 rounded-md" alt="Bamboo Brush">
                            <h2 class="text-sm text-gray-700 text-center">Eco Bamboo Toothbrush</h2>
                        </div>
                    </div>
                </div>
            </div>            
        </a>
        </div>
    </main>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
    <script>
         const searchInput = document.getElementById('search');
        const overlay = document.getElementById('overlay');
        searchInput.addEventListener('focus', () => {
            overlay.classList.remove('hidden');
        });
        searchInput.addEventListener('blur', () => {
            // Give a slight delay to prevent immediate hide when clicking button
            setTimeout(() => {
                overlay.classList.add('hidden');
            }, 200);
        });
    </script>

    <!-- Welcome Section -->


    <!-- Features Section -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 px-10 py-10">
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-xl font-semibold">Quality Products</h3>
            <p class="text-gray-600">We offer the best quality products at unbeatable prices.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-xl font-semibold">Fast Delivery</h3>
            <p class="text-gray-600">Get your products delivered quickly and safely.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-xl font-semibold">24/7 Support</h3>
            <p class="text-gray-600">Our team is always ready to assist you.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#0a192f] text-white pt-12 pb-6 px-4 md:px-10">
    <div class="container mx-auto">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- Company Info -->
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <h2 class="text-2xl font-bold">Nexamart</h2>
                    <img src="images/cart3.png" alt="Cart" class="w-8 h-8">
                </div>
                <p class="text-gray-300">Your one-stop destination for quality products and exceptional service.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">Quick Links</h3>
                <ul class="space-y-2 text-gray-300">
                    <li><a href="index.php" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="products.php?category=Miscellaneous" class="hover:text-white transition-colors">Products</a></li>
                    <li><a href="products.php?category=Miscellaneous" class="hover:text-white transition-colors">New Arrivals</a></li>
                    <li><a href="products.php?category=Miscellaneous" class="hover:text-white transition-colors">Best Sellers</a></li>
                    <li><a href="products.php?category=Miscellaneous" class="hover:text-white transition-colors">Special Offers</a></li>
                    <li><a href="seller.php" class="hover:text-white transition-colors">Seller Dashboard</a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">Customer Service</h3>
                <ul class="space-y-2 text-gray-300">
                    <li><a href="aboutus.php" class="hover:text-white transition-colors">Contact Us</a></li>
                    <li><a href="aboutus.php" class="hover:text-white transition-colors">FAQs</a></li>
                    <!-- <li><a href="#" class="hover:text-white transition-colors">Shipping Policy</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Returns & Refunds</a></li> -->
                    <li><a href="#" class="hover:text-white transition-colors">Track Order</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">Subscribe to Newsletter</h3>
                <p class="text-gray-300">Get updates on special offers and promotions.</p>
                <!-- <form class="flex flex-col space-y-3">
                    <input type="email" placeholder="Your email address" class="px-4 py-2 rounded text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition-colors">Subscribe</button>
                </form> -->
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-gray-700 my-6"></div>

        <!-- Bottom Footer -->
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="text-gray-400 text-sm mb-4 md:mb-0">
                &copy; 2025 Nexamart. All rights reserved.
            </div>
            <div class="flex space-x-4">
                <a href="aboutus.php" class="text-gray-400 hover:text-white text-sm transition-colors">Terms of Service</a>
                <a href="aboutus.php" class="text-gray-400 hover:text-white text-sm transition-colors">Privacy Policy</a>
                <a href="aboutus.php" class="text-gray-400 hover:text-white text-sm transition-colors">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>
</body>

</html>