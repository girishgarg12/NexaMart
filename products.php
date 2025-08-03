<?php
session_start();
$showLogin = false;
if (isset($_SESSION['SHOW_LOGIN_POPUP']) && $_SESSION['SHOW_LOGIN_POPUP'] === true) {
    $showLogin = true;
    unset($_SESSION['SHOW_LOGIN_POPUP']);
}

include 'login1.php';
include 'navbar.php';
include 'dbdetails.php';
include 'bot.php';
$category=$_GET['category'] ?? 'Miscellaneous'; // Default to 'all' if not set
$timeout_duration=300;
if (isset($_SESSION['LAST_ACTIVITY']) && 
    (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    // Last request was more than 10 minutes ago
    session_unset();     // Unset $_SESSION variable
    session_destroy();
    $_SESSION['LAST_ACTIVITY'] = time();
}
$_SESSION['LAST_ACTIVITY'] = time();
$timeout_duration_cart = 10;
if (isset($_SESSION['LAST_ACTIVITY_CART']) && 
    (time() - $_SESSION['LAST_ACTIVITY_CART']) > $timeout_duration_cart) {
    unset($_SESSION['cartitems']);
    $_SESSION['LAST_ACTIVITY_CART'] = time();
}
if($_SERVER['REQUEST_METHOD'] == 'POST'&&isset($_POST['sno'])&&$_POST['sno']!=0) {           
    if (!isset($_SESSION['username'])) {
        echo" <script>toggleLoginModal();</script>";
        // $_SESSION['SHOW_LOGIN_POPUP'] = true;
        // header("Location: ".$_SERVER['REQUEST_URI']);
        // exit();
    }
    
    else{
        $_item=['sno'=>$_POST['sno'],
                'quant'=>1];
        if(!isset($_SESSION['cartitems'])){
            $_SESSION['cartitems']=[];
        }
        $found=false;
        foreach($_SESSION['cartitems'] as &$row){
            if($row['sno']==$_item['sno']){
                $row['quant']++;
                $found=true;
                break;
            }
        }
        unset($row);
        if($found==false){
            $_SESSION['cartitems'][]=$_item;
        }
        
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexamart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="loginscript.js"></script>
    <script>
    
</script>

</head>
<body class="">
<div id="overlay" class="fixed inset-0 bg-black/60 bg-opacity-50 z-[60] hidden"></div>

<div class="grid grid-cols-[1fr_4fr]  gap-4 p-2 mt-18 pt-20">
    <div>
        <div class=" h-[100%]  p-3 flex flex-col gap-2 bg-white border-r border-r-gray-300 ">
            <h3 class="font-bold text-center text-2xl">Products Category</h3>
            <span class="text-md bg-gray-200  py-0.5 rounded w-full text-center"><?php echo"$category" ?></span>
            <div>
                <h3 class="font-bold mb-2">Categories</h3>
                <ul class="space-y-1">
                <li>Clothing</li>
                <li>Electronics</li>
                <li>Footwear</li>
                <li>Home Decor</li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold mb-2">Top Picks</h3>
                <ul class="space-y-1">
                <li>Best Budget Phones</li>
                <li>Summer Apparels</li>
                <li>New Arrivals - Shoes</li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold mb-2">Why Us</h3>
                <ul class="space-y-1 list-disc pl-5">
                <li>Quality Products</li>
                <li>Fast Delivery</li>
                <li>Secure Checkout</li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold mb-2">Need Help?</h3>
                <p>📞 9729024316</p>
                <div>🖂 support@nexamart.com</div>
            </div>
        </div>
    </div>
    <div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-3  w-full ">
    <!-- Product Card -->
     <?php
     if($conn->connect_error){
         die("Connection failed: ".$conn->connect_error);
     }
     else{
        // echo"connected";
        $quer="select * from productdetails where `prodcategory`='$category'";
        $result=$conn->query($quer);
        if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            $prodprice= $row['prodprice'];
            $discount = rand(10, 90);
            $incprice=floor(($prodprice*100/(100-$discount))*100)/100; // random discount percent
            $rating = number_format(rand(30, 50) / 10, 1); // e.g. 3.0 to 5.0
            $ratingCount = rand(50, 999); // e.g. 234 ratings
            $randdays=rand(1,7);
            $deliverydate=date('l d M', strtotime("+$randdays days"));
            $dealends=floor(rand(1,4));

            echo "<div class='relative border rounded-xl shadow-md p-3 flex flex-col gap-2 bg-white transform transition-transform duration-300 hover:scale-105'>
                            <div class='absolute top-2 right-2 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded'>
                                {$discount}% off
                            </div>
                            <div class='flex items-center justify-center'>
                                <img src='{$row['prodimagelink']}' alt='Product Image' class='rounded-md w-40 h-44'>
                            </div>
                            <h3 class='font-semibold text-sm'>{$row['prodname']}</h3>
                            <span class='text-xs bg-gray-200 px-2 py-0.5 rounded w-fit'>{$row['prodcategory']}</span>
                            <div class='flex items-center text-sm gap-1'>
                                {$rating}⭐ ({$ratingCount})
                            </div>
                            <span class='text-red-600 text-sm font-bold'>Deal ends in {$dealends} days</span>
                            <div class='flex items-baseline gap-2'>                    
                                <span class='text-lg font-bold text-green-700'>₹{$prodprice}</span>
                                <span class='line-through text-gray-500 text-sm'>₹{$incprice}</span>
                            </div>
                            <p class='text-xs text-gray-500'>FREE delivery by {$deliverydate}</p>
                            <form method='POST'>
                                <input type='number' class='hidden' name='sno' value='{$row['sno']}'>
                                <button type='submit' class='mt-1 bg-yellow-400 text-black px-3 py-1 text-sm rounded hover:bg-yellow-500'>Add to cart</button>
                            </form>
                            </div>";
                
                }
            }
        }
        // print_r($_SESSION['cartitems']);
        // print_r($_SESSION['username']);
        // print_r($_SESSION['role']);

     ?>

</div>
    </div>
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
</body>
</html>