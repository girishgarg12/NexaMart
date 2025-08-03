<?php 
ob_start();
session_start();
include 'bot.php';
include 'login1.php';
include 'navbar.php';
include 'dbdetails.php';

$logout = false;
$timeout_duration = 300;

// Initialize cart if not set
if (!isset($_SESSION['cartitems'])) {
    $_SESSION['cartitems'] = [];
}

// Handle session timeout
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: checkout.php");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time();

if (!isset($_SESSION['username'])) {
    echo "<script>toggleLoginModal();</script>";
}

$reindexedCart = [];
$totalsum = 0.0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absolute - Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        var cartItems = {};
    </script>
</head>
<body class="bg-gray-100">
    <!-- Checkout Modal -->
    <div id="checkoutModal" class="fixed w-full bg-black/70 h-[100vh] z-50 hidden overflow-y-auto p-10">
        <div class="w-full absolute flex justify-center z-50 mt-16">
            <div class="flex flex-col overflow-y-auto h-[500px] bg-white rounded-2xl shadow-lg p-6 w-auto md:w-auto max-w-4xl relative animate-slide-down">
                <button onclick="toggleCheckoutModal()" class="absolute top-3 right-3 text-2xl font-bold text-gray-500">&times;</button>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 min:w-60">
                    <!-- Left (Shipping Details) -->
                    <div class="flex flex-col gap-4">
                        <div class="text-blue-950 font-extrabold text-2xl">Shipping Details</div>
                        <form id="checkoutForm" class="flex flex-col gap-3">
                            <div>
                                <label class="block text-gray-700">Full Name</label>
                                <input type="text" name="fullname" required 
                                       class="w-full bg-gray-100 p-2 rounded-xl text-lg" 
                                       placeholder="John Doe">
                            </div>
                            
                            <div>
                                <label class="block text-gray-700">Phone Number</label>
                                <input type="tel" name="phone" required 
                                       class="w-full bg-gray-100 p-2 rounded-xl text-lg" 
                                       placeholder="+91 9876543210">
                            </div>
                            
                            <div>
                                <label class="block text-gray-700">Address</label>
                                <textarea name="address" required rows="3"
                                          class="w-full bg-gray-100 p-2 rounded-xl text-lg"
                                          placeholder="House No, Street, Area"></textarea>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-gray-700">City</label>
                                    <input type="text" name="city" required 
                                           class="w-full bg-gray-100 p-2 rounded-xl text-lg" 
                                           placeholder="City">
                                </div>
                                <div>
                                    <label class="block text-gray-700">State</label>
                                    <input type="text" name="state" required 
                                           class="w-full bg-gray-100 p-2 rounded-xl text-lg" 
                                           placeholder="State">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700">Pincode</label>
                                <input type="text" name="pincode" required 
                                       class="w-full bg-gray-100 p-2 rounded-xl text-lg" 
                                       placeholder="123456">
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <input type="checkbox" name="save_address" id="save_address">
                                <label for="save_address">Save this address for future orders</label>
                            </div>
                        </form>
                    </div>

                    <!-- Right (Order Summary & Payment) -->
                    <div class="flex flex-col gap-4">
                        <div class="text-blue-950 font-extrabold text-2xl">Order Summary</div>
                        
                        <div class="border rounded-xl p-4">
                            <div class="display max-h-60 overflow-y-auto">
                                <!-- Cart items will be dynamically inserted here -->
                            </div>
                            
                            <div class="mt-4 border-t pt-3">
                                <div class="flex justify-between">
                                    <span>Subtotal:</span>
                                    <span id="checkout-subtotal">₹0.00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Shipping:</span>
                                    <span id="checkout-shipping">₹0.00</span>
                                </div>
                                <div class="flex justify-between font-bold text-lg mt-2">
                                    <span>Total:</span>
                                    <span id="checkout-total">₹0.00</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-2">
                            <div class="text-blue-950 font-semibold text-lg mb-2">Payment Method</div>
                            <div class="flex flex-col gap-2">
                                <label class="flex items-center gap-2 p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                    <input type="radio" name="payment" value="credit_card" checked>
                                    <span>Credit/Debit Card</span>
                                </label>
                                <label class="flex items-center gap-2 p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                    <input type="radio" name="payment" value="upi">
                                    <span>UPI Payment</span>
                                </label>
                                <label class="flex items-center gap-2 p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                    <input type="radio" name="payment" value="cod">
                                    <span>Cash on Delivery</span>
                                </label>
                            </div>
                        </div>
                        
                        <button id="placeOrderBtn" class="w-full bg-blue-950 text-white py-3 rounded-xl font-bold hover:bg-blue-900 transition">
                            Place Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Processing Modal -->
    <div id="paymentModal" class="fixed w-full bg-black/70 h-[100vh] z-50 hidden pt-20">
        <div class="w-full absolute flex justify-center z-50 mt-16">
            <div class="bg-white rounded-2xl shadow-lg p-6 w-auto md:w-auto max-w-md relative animate-slide-down">
                <div class="flex flex-col items-center gap-4">
                    <div id="paymentLoader" class="w-16 h-16 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                    <div id="paymentStatus" class="text-xl font-semibold">Processing Payment...</div>
                    <div id="paymentMessage" class="text-center text-gray-600">Please wait while we process your payment</div>
                </div>
            </div>
        </div>
    </div>

    <div id="overlay" class="fixed inset-0 bg-black/60 bg-opacity-50 z-[60] hidden"></div>
    
    <main class="p-2 pt-20 grid grid-cols-[3fr_1fr] gap-2 min-h-[74vh] mt-18">
        <div class="bg-white w-full gap-2 p-3 flex flex-col items-center rounded-xl shadow-lg">
            <?php
            if (isset($_SESSION['username']) && isset($_SESSION['cartitems'])) {
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } else {
                    if (empty($_SESSION['cartitems'])) {
                        echo "<div class=' w-full  rounded-xl  flex flex-col items-center justify-center'>
                        <img src='images/emptycart.jpg' class='size-72 rounded-full'>
                        <p class='text-2xl font-bold'>Your Cart is Empty</p>
                        <p class='text-gray-600'>Looks like you haven't anything to your cart yet</p>
                        <a href='index.php' class='bg-blue-950 text-white px-4 py-2 rounded-full mt-4'>Start Shopping</a>
                        </div>";
                    } else {
                        $snos = array_column($_SESSION['cartitems'], 'sno');
                        $reindexedCart = [];
                        foreach ($_SESSION['cartitems'] as $item) {
                            $reindexedCart[$item['sno']] = $item['quant'];
                        }
                        
                        $sql = "SELECT * FROM productdetails WHERE `sno` IN (" . implode(',', $snos) . ")";
                        $result = $conn->query($sql);
                        $totalsum = 0;
                        
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $sno = $row['sno'];
                                $name = $row['prodname'];
                                $price = $row['prodprice'];
                                $img = $row['prodimagelink'];
                                $desc = $row['proddescription'];
                                $quantity = $reindexedCart[$sno];
                                $pricetoshow = $price * $quantity;
                                $totalsum += $pricetoshow;
                                $rand = floor(rand(20, 85));
                                $increasedprice = $price + $price * ($rand / 100);
                                
                                echo "<div data-price='{$price}' increased-price='{$increasedprice}' class='product border w-full border-gray-300 rounded-xl'>
                                        <div class='grid grid-cols-[1fr_3fr] gap-2 w-full rounded-xl'>
                                            <div class='sno hidden'>{$sno}</div>
                                            <div class='imglink hidden'>{$img}</div>
                                            <div class='pn hidden'>{$name}</div>
                                            <div class='flex items-center justify-center'>
                                                <img src='{$img}' class='size-24 rounded-l-xl'>
                                            </div>
                                            <div class='flex gap-2 flex-col bg-gray-100 rounded-r-xl pt-2 px-2'>
                                                <div class='font-bold'>{$name}</div>
                                                <div class='text-gray-600'>{$desc}</div>
                                                <div class='flex justify-between items-center pb-2'>
                                                    <div class='flex items-center font-semibold'>
                                                        Price: <span class='text-gray-500 px-2 line-through'>₹{$increasedprice}/-</span>
                                                        <span class='flex items-center font-semibold'>
                                                            <span class='text-green-500 px-2'>₹{$price}/-</span>
                                                        </span>
                                                    </div>
                                                    <div class='text-right'>                            
                                                        <span class='bg-white rounded-full p-2'>
                                                            <button class='text-2xl cursor-pointer minus-btn'>-</button>&nbsp&nbsp
                                                            <span class='quantity'>{$quantity}</span>&nbsp&nbsp
                                                            <button class='text-2xl cursor-pointer plus-btn'>+</button>
                                                        </span>
                                                        <span>
                                                            <button class='del-btn cursor-pointer hover:underline text-blue-900 font-bold px-3'>Delete</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                            }
                        } else {
                            echo "<div class='w-full border-gray-300 rounded-xl'>No items in the cart.</div>";
                        }
                    }
                }
            } else {
                echo "<div class='w-full rounded-xl flex flex-col items-center justify-center'>
                        <img src='images/emptycart.jpg' class='size-72 rounded-full'>
                        <p class='text-2xl font-bold'>Your Cart is Empty</p>
                        <p class='text-gray-600'>Looks like you haven't added anything to your cart yet</p>
                        <a href='test.php' class='bg-blue-950 text-white px-4 py-2 rounded-full mt-4'>Start Shopping</a>
                      </div>";
            }
            ?>            
        </div>
        
        <div>
            <div class="bg-white w-full rounded-2xl shadow-lg flex flex-col">
                <div class="flex justify-between flex-col">
                    <div class="flex flex-nowrap px-6 pt-6 pb-3 font-bold text-2xl text-white rounded-t-2xl bg-blue-950">
                        Subtotal: &nbsp <span class="sumtotal-amount">₹<?php echo number_format($totalsum, 2); ?></span>
                    </div>
                    <div class="text-xl px-4 pt-2 mt-2">
                        Price breakup
                    </div>
                </div>
                <div class="m-2 rounded-xl p-2 border border-gray-200">
                    <div class="flex justify-around">
                        <div class="font-semibold">Total:</div>
                        <div class="px-3 ml-auto font-semibold"><span class="increased-amount">₹0.00</span></div>
                    </div>
                    <div class="flex justify-around">
                        <span class="font-semibold">Discount:</span>
                        <span class="discount px-3 ml-auto font-semibold text-green-500">₹0.00</span>
                    </div>
                    <div class="flex justify-around">
                        <span class="font-semibold">Net:</span>
                        <span class="px-3 ml-auto font-semibold net-amount">₹0.00</span>
                    </div>
                    <div class="flex justify-around">
                        <div class="status text-sm"></div>
                    </div>
                </div>
                <div class="flex justify-center my-3 mb-5">
                    <button onclick="toggleCheckoutModal()" type="button" class="bg-blue-950 px-3 p-2 cursor-pointer hover:scale-110 hover:transition duration-500 rounded-full text-white font-bold">Proceed to checkout</button>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white text-center py-4 mt-20">
        <p>&copy; 2025 Nexamart. All rights reserved.</p>
    </footer>

    <script>
        // Initialize cart management
        document.addEventListener('DOMContentLoaded', function() {
            updateTotal();
            setupCartEventListeners();
            
            if (document.querySelectorAll(".product").length === 0) {
                document.getElementById("placeOrderBtn").disabled = true;
            }
        });

        function setupCartEventListeners() {
            document.querySelectorAll(".product").forEach(product => {
                const minusBtn = product.querySelector(".minus-btn");
                const plusBtn = product.querySelector(".plus-btn");
                const delBtn = product.querySelector(".del-btn");
                const quantityElement = product.querySelector(".quantity");

                plusBtn.addEventListener("click", () => {
                    let quantity = parseInt(quantityElement.textContent);
                    quantity++;
                    quantityElement.textContent = quantity;
                    updateTotal();
                    updateCartData();
                });

                minusBtn.addEventListener("click", () => {
                    let quantity = parseInt(quantityElement.textContent);
                    if (quantity > 1) {
                        quantity--;
                        quantityElement.textContent = quantity;
                        updateTotal();
                        updateCartData();
                    }
                });

                delBtn.addEventListener("click", () => {
                    product.remove();
                    updateTotal();
                    updateCartData();
                    
                    if (document.querySelectorAll(".product").length === 0) {
                        document.getElementById("placeOrderBtn").disabled = true;
                    }
                });
            });
        }

        function updateTotal() {
            let increasedtotal = 0.0;
            let sumtotal = 0.0;
            
            document.querySelectorAll(".product").forEach(product => {
                const quantity = parseFloat(product.querySelector(".quantity").textContent);
                const price = parseFloat(product.getAttribute("data-price"));
                const increasedprice = parseFloat(product.getAttribute("increased-price"));
                
                sumtotal += quantity * price;
                increasedtotal += quantity * increasedprice;
            });
            
            let discount = increasedtotal - sumtotal;
            
            document.querySelector(".sumtotal-amount").textContent = `₹${sumtotal.toFixed(2)}`;
            document.querySelector(".increased-amount").textContent = `₹${increasedtotal.toFixed(2)}`;
            
            if (sumtotal > 0) {
                document.querySelector(".discount").textContent = `-₹${discount.toFixed(2)}`;
            } else {
                document.querySelector(".discount").textContent = "-₹0.00";
            }
            
            document.querySelector(".net-amount").textContent = `₹${sumtotal.toFixed(2)}`;
            
            if (sumtotal > 499) {
                document.querySelector(".status").textContent = "Order Eligible for free shipping";
                document.querySelector(".status").classList.add("text-green-500");
                document.querySelector(".status").classList.remove("text-red-500");
            } else {
                document.querySelector(".status").textContent = `Add items worth ₹${(500 - sumtotal).toFixed(2)} or more to get free delivery`;
                document.querySelector(".status").classList.add("text-red-500");
                document.querySelector(".status").classList.remove("text-green-500");
            }
        }

        function updateCartData() {
            cartItems = {};
            document.querySelectorAll(".product").forEach(product => {
                const quantity = parseFloat(product.querySelector(".quantity").textContent);
                const sno = product.querySelector(".sno").textContent;
                const pn = product.querySelector(".pn").textContent;
                const imglink = product.querySelector(".imglink").textContent;
                const price = parseFloat(product.getAttribute("data-price"));
                
                cartItems[sno] = {
                    'name': pn,
                    'qty': quantity,
                    'imglink': imglink,
                    'price': price * quantity
                };
            });
        }

        function toggleCheckoutModal() {
            const modal = document.getElementById("checkoutModal");
            modal.classList.toggle("hidden");
            
            if (!modal.classList.contains("hidden")) {
                updateCheckoutSummary();
            }
        }

        function updateCheckoutSummary() {
            updateCartData();
            
            let cartContainer = document.querySelector(".display");
            let totalsum = 0;
            
            // Clear previous content
            cartContainer.innerHTML = '';
            
            for (let sno in cartItems) {
                let item = cartItems[sno];
                totalsum += item.price;
                
                let itemHTML = `
                    <div class="flex justify-between items-center py-2 border-b">
                        <div class="flex items-center gap-2">
                            <img src="${item.imglink}" class="w-12 h-12 rounded" />
                            <span>${item.name} x ${item.qty}</span>
                        </div>
                        <span>₹${item.price.toFixed(2)}</span>
                    </div>
                `;
                cartContainer.innerHTML += itemHTML;
            }
            
            document.getElementById("checkout-subtotal").textContent = `₹${totalsum.toFixed(2)}`;
            
            let shipping = totalsum > 499 ? 0 : 50;
            document.getElementById("checkout-shipping").textContent = 
                shipping === 0 ? 'FREE' : `₹${shipping.toFixed(2)}`;
            document.getElementById("checkout-total").textContent = 
                `₹${(totalsum + shipping).toFixed(2)}`;
            
            if (shipping === 0) {
                document.getElementById("checkout-shipping").classList.add("text-green-500");
            } else {
                document.getElementById("checkout-shipping").classList.remove("text-green-500");
            }
        }

        // Handle place order button
        document.getElementById('placeOrderBtn').addEventListener('click', function() {
            const form = document.getElementById('checkoutForm');
            const paymentMethod = document.querySelector('input[name="payment"]:checked').value;
            
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            
            // Update cart data before submission
            updateCartData();
            
            document.getElementById('checkoutModal').classList.add('hidden');
            document.getElementById('paymentModal').classList.remove('hidden');
            
            setTimeout(function() {
                document.getElementById('paymentLoader').classList.add('hidden');
                document.getElementById('paymentStatus').textContent = 'Payment Successful!';
                document.getElementById('paymentMessage').textContent = 'Your order has been placed successfully.';
                
                // Prepare form data
                const formData = new FormData();
                formData.append('payment_method', paymentMethod);
                formData.append('shipping_details', JSON.stringify(Object.fromEntries(new FormData(form))));
                formData.append('cart_items', JSON.stringify(cartItems));
                
                // In a real implementation, you would send this to your server
                console.log("Submitting order:", {
                    payment_method: paymentMethod,
                    shipping_details: Object.fromEntries(new FormData(form)),
                    cart_items: cartItems
                });
                
                // Simulate server response
                setTimeout(function() {
                    window.location.href = 'index.php?delses=yes';
                }, 2000);
                
            }, 2000);
        });
    </script>
</body>
</html> 