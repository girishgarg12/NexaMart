<?php
session_start();
if(isset($_GET['logout'])&&($_GET['logout']==true)){
    session_unset();
    session_destroy();
    header("Location: ".strtok($_SERVER['REQUEST_URI'],'?'));
    exit();
}
?>
<header class="fixed top-0 left-0 w-full bg-[#0a192f] text-white p-3 flex justify-start gap-2 flex-wrap items-center z-[100] shadow-md">
    <div class="flex items-center space-x-2">
            <h1 class="text-2xl font-bold">Nexamart</h1>
            <img src="./images/cart3.png" alt="Cart" class="w-8 h-8">
        </div>
        <div
            class="flex justify-between items-center w-1/3 p-2 px-4 ml-10 border rounded-xl bg-white text-black shadow-md focus-within:ring-2 focus-within:ring-yellow-500  transition-all duration-300">
            <input type="text" id="search" placeholder="Search Nexamart"
                class="outline-none w-full bg-transparent text-black placeholder-gray-500">
            <a href="products.php?category=Miscellaneous" id="srch">
                <img src="./images/search.png" class="size-6 ml-2 hover:scale-110 transition-transform duration-200">
            </a>
        </div>

        <nav class=" md:ml-auto lg:ml-auto ">
            <ul class="flex space-x-4 items-center justify-center">
                <li><a href="index.php" class="hover:underline">Home</a></li>
                <li><a href="products.php?category=Miscellaneous" class="hover:underline">Products</a></li>
                <li><a href="aboutus.php" class="hover:underline">About us</a></li>
                <li class="relative">
                    <a href="checkout.php" class="hover:underline">
                      <img class="size-10" src="images/cartnew.png" alt="Cart">
                      <!-- Cart count badge -->
                       <?php
                        $cartCount = 0;
                        if (isset($_SESSION['cartitems'])) {
                            foreach ($_SESSION['cartitems'] as $item) {
                                $cartCount += $item['quant'];
                            }
                            echo "<span id='cart-count' class='absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full'>{$cartCount}</span>";
                        }
                        
                        ?>
                      
                    </a>
                </li>
                    <div class="relative">
                    <button class="flex items-center gap-2 ">
                        <!-- <img id="toremove" class="login-btn size-8 rounded-full bg-white" src="images/user3.png" alt="Seller"> -->
                        <span class="inline-flex items-center justify-center gap-2">
                            <?php
                            if (isset($_SESSION['username'])) {
                                $name = $_SESSION['username'];
                                $initial = strtoupper(substr($name, 0, 1));
                                echo'<script> document.getElementById("#toremove").classList.add("hidden");</script>';
                                echo '<span class="bg-white login-btn user-initial w-8 h-8 rounded-full border border-white text-blue-950 flex items-center justify-center 
                                      text-lg font-bold transition-transform duration-300 hover:rotate-12 hover:scale-110">'
                                      . $initial . '</span>';
                                
                            } else {
                                echo '<img id="toremove" class="login-btn size-8 rounded-full bg-white" src="images/user3.png" alt="Seller">';
         
                                echo '<a href="#" onclick="toggleLoginModal()" class="hover:underline text-white">Sign In</a>';
                            }
                            ?>
                        </span>
                    </button>
                    <div class="logout-btn absolute hidden right-0 mt-2 w-48 bg-white text-black rounded-md shadow-lg">
                        <a href="?logout=true" class="block px-4 py-2 hover:bg-gray-200 text-red-600">Logout</a>
                    </div>
                </div>
                
            </ul>
        </nav>
    </header>
    <script>
       
        const loginBtn = document.querySelector('.login-btn');
        const logoutBtn = document.querySelector('.logout-btn')   
        loginBtn.addEventListener('click', () => {
            logoutBtn.classList.toggle('hidden');
        });
    </script>