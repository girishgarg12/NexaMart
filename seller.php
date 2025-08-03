<?php 
session_start();
ob_start();
include 'bot.php';
include 'login1.php';
include 'navbar.php'; 
include 'dbdetails.php';
$timeout_duration = 300;
if (isset($_SESSION['LAST_ACTIVITY']) && 
    (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    // Last request was more than 10 minutes ago
    session_unset();     // Unset $_SESSION variable
    session_destroy();
    $_SESSION['LAST_ACTIVITY'] = time();
}
$_SESSION['LAST_ACTIVITY'] = time();
if(isset($_SESSION['role'])&&$_SESSION['role']!='seller'){
    echo "<script>alert('Only verified sellers are authorized to access this page.');</script>";
    
}
if (!isset($_SESSION['username'])) {
    echo"<script>
    window.onload = function() {
    console.log('Page fully loaded!');
    toggleLoginModal();
    };</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Inventory - NexaMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<div id="overlay" class="fixed inset-0 bg-black/60 bg-opacity-50 z-[60] hidden"></div>

<body class="bg-gray-100 flex flex-col w-screen">
    <div class="flex flex-col  w-full justify-center items-start p-6 gap-8  mt-18 pt-20">
        <div class="w-full  bg-white p-6 border shadow-lg rounded-2xl ">
            <h1 class="text-2xl font-semibold mb-4">Add Inventory</h1>
            <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div  class="grid grid-cols-[1fr_1fr] gap-4 w-full">
                <label>Product Name
                    <input name="productName" class="w-full p-2 rounded-md border border-gray-300" type="text" placeholder="Enter Product Name">
                </label>
                <label>Category
                    <select name="productCategory" class="w-full p-2 rounded-md border border-gray-300" >
                        <option value="select" disabled selected>select</option>
                        <option value="Clothing">Clothing</option>
                        <option value="Laptops">Laptops</option>
                        <option value="Mobile Phones">Mobile Phones</option>
                        <option value="Earbuds">Earbuds</option>
                        <option value="Footwear">Footwear</option>
                        <option value="Smart Watches">Smart Watches</option>
                        <option value="Miscellaneous">Miscellaneous</option>
                    </select>
                    <!-- <input name="productCategory" class="w-full p-2 rounded-md border border-gray-300" type="text" placeholder="Enter Category"> -->
                </label>
                <label>Price
                    <input name="productPrice" class="w-full p-2 rounded-md border border-gray-300" type="number" step="any" min="0" placeholder="Enter Price">
                </label>
                <label>Stock Quantity
                    <input name="productQuantity" class="w-full p-2 rounded-md border border-gray-300" type="number" placeholder="Enter Quantity">
                </label>
                <label>Product Description
                    <textarea name="productDescription" class="w-full h-12 p-2 rounded-md border border-gray-300" placeholder="Enter Description"></textarea>
                </label>
                <label>Upload Product Image
                    <input name="productImage" class="w-full p-2 rounded-md border border-gray-300" type="file" accept="image/*">
                </label>
                </div>
                
                <button type="submit" class="mt-2 w-full bg-blue-900 p-2 rounded-md text-white hover:bg-blue-950">Add Product</button>
            </form>
        </div>

        <!-- <div class="w-full mt-6 flex items-center justify-center gap-4">
            <button onclick="window.location.href='?view=orders'" class="w-[90%] bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-800">View Orders</button>
            <button onclick="window.location.href='?view=inventory'" class="w-[90%] bg-green-600 text-white px-4 py-2 rounded hover:bg-green-800">View Inventory</button>
        </div> -->
        <div id="pr" class="w-full flex items-center justify-center ">
                <button name="promote" id="promote" class=" bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-800">Promote My Products</button></a>
            <?php
            $promote=false;
            if($_SERVER['REQUEST_METHOD']=="POST"&&isset($_POST['promote'])&&isset($_POST['promote_prod'])&&isset($_SESSION['role'])&&$_SESSION['role']=='seller'){
                $promote=true;
            }
            if ($_SERVER['REQUEST_METHOD']=="POST"&&isset($_POST['promote_prod'])&&isset($_SESSION['role'])&&$_SESSION['role']=='seller'){
                $targetDir = "uploads/";
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $prodname=$_POST['productName'];
                $imageName = str_replace(' ', '', basename($_FILES["prod_image"]["name"]));
                $targetFile = $targetDir . time() . "_" . $imageName;
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            
                $validExtensions = ["jpg", "jpeg", "png"];
                if (!in_array($imageFileType, $validExtensions)) {
                    echo "<script>alert('Invalid image format. Only JPG, JPEG, PNG allowed.')</script> ";
                } else if (move_uploaded_file($_FILES["prod_image"]["tmp_name"], $targetFile)) {
                    if ($conn->connect_error) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    else{
                        $quer="INSERT INTO `promotion`( `prodname`, `prodimagelink`) VALUES ('$prodname','$targetFile')";
                        $result=mysqli_query($conn,$quer);
                        if ($result) {
                            echo "<script>alert('Product promoted successfully!');</script>";
                        } else {
                            echo "<script>alert('Error: {$conn->error}');</script>";
                        }
                    }
                } else {
                    echo "<script>alert('Failed to upload image');</script>";
                }
                $promote=true;
            }
            ?>
            
                
            <div id="promoteform" class='hidden flex flex-col bg-white p-4 rounded-2xl shadow-md w-full gap-3'>
                <h3 class='font-bold text-lg'>Enter Product details</h3>
                <form method='POST' enctype='multipart/form-data' class='flex flex-col gap-3'>
                    <label>Product Name
                        <input name='productName' class='w-full p-2 rounded-md border border-gray-300' type='text' placeholder='Enter Product Name'>
                    </label>
                    <label>Choose Product Image
                        <input name='prod_image' class='w-full p-2 rounded-md border border-gray-300' type='file' accept='image/*'>
                    </label>
                    <label>
                    <span class='text-red-500'>*</span>
                    Make sure you add the product image of min dimensions 1000px 760px
                    </label>
                    <button type='submit' name='promote_prod' class='mt-2 bg-green-600 text-white px-4 py-1 rounded hover:bg-green-800'>Promote</button>
                    
                </form>
            </div>
        </div>
        <script>
            const promoteBtn = document.getElementById('promote');
            const promoteForm = document.getElementById('promoteform');
            
            promoteBtn.addEventListener('click', () => {
                promoteBtn.classList.add('hidden');
                promoteForm.classList.toggle('hidden');
            });

        </script>
    

        <div class="flex w-full justify-center items-center">
            <?php
            if (isset($_SESSION['username'])&&$_SESSION['role']=='seller') {
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sellername = $_SESSION['username'];
                $sql = "SELECT * FROM productdetails WHERE sellerid = '$sellername'";
                $result = $conn->query($sql);
                echo "<div class='mt-8 shadow-xl p-3 w-full'><h2 class='text-xl font-bold mb-4 text-green-500'>Your Inventory</h2><div class='grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6'>";
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='bg-white p-4 rounded-lg shadow-md'>
                            <div class='flex justify-center items-center'>
                            <img src='{$row['prodimagelink']}' class='w-48 h-48  rounded-md mb-2'>
                            </div>
                            <h3 class='font-bold text-lg'>{$row['prodname']}</h3>
                            <p class='text-gray-600'>{$row['prodcategory']}</p>
                            <p class='text-blue-800 font-semibold'>₹ {$row['prodprice']}</p>
                            <p class='text-sm'>Stock: {$row['prodquantity']}</p>
                            <p class='text-sm mt-1'>{$row['proddescription']}</p>
                            <form method='POST' onsubmit='return confirm(\"Are you sure you want to delete this product?\");'>
                                <input type='hidden' name='delete_sno' value='{$row['sno']}'>
                                <button type='submit' name='delete_product' class='mt-2 bg-red-600 text-white px-4 py-1 rounded hover:bg-red-800'>Delete</button>
                            </form>
                        </div>";
                    }   
                    
                } else {
                    echo "<p class='text-gray-500 mt-4'>Inventory is Empty.</p>";
                }echo "</div></div>";
                if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_product'])) {
                    $deleteSno = intval($_POST['delete_sno']);
                
                    // // First, optionally delete associated image file
                    // $imgQuery = "SELECT prodimagelink FROM productdetails WHERE sno = $deleteSno AND sellerid = '{$_COOKIE['username']}'";
                    // $imgResult = $conn->query($imgQuery);
                    // if ($imgResult && $imgResult->num_rows > 0) {
                    //     $imgRow = $imgResult->fetch_assoc();
                    //     if (file_exists($imgRow['prodimagelink'])) {
                    //         unlink($imgRow['prodimagelink']);
                    //     }
                    // }
                
                    // Then delete from database
                    $deleteQuery = "DELETE   FROM productdetails WHERE sno = '$deleteSno' AND sellerid = '$sellername'";
                    if ($conn->query($deleteQuery) == TRUE) {
                        echo "<script>alert('Product deleted successfully!'); window.location.href='seller.php';</script>";
                    } else {
                        echo "<script>alert('Error deleting product: {$conn->error}');</script>";
                    }
                }
                
            }
            ?>
        </div>
        <div class="flex w-full justify-center items-center">

            <?php
            if (isset($_SESSION['username'])&&$_SESSION['role']=='seller') {
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sellername = $_SESSION['username'];
                $sql = $sql = "SELECT productdetails.*, orderdetails.quantity AS order_quantity 
                FROM productdetails 
                JOIN orderdetails ON productdetails.sno = orderdetails.prodsno 
                WHERE productdetails.sellerid = '$sellername' 
                AND orderdetails.status = 'pending'";
                 $result = $conn->query($sql);
                echo "<div class='mt-8  shadow-xl p-3 w-full'><h2 class='text-xl font-bold mb-4 text-green-500'>Orders Received</h2><div class='grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6'>";
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='bg-white p-4 rounded-lg shadow-md'>
                            <div class='flex justify-center items-center'>
                            <img src='{$row['prodimagelink']}' class='w-48 h-48  rounded-md mb-2'>
                            </div>
                            <h3 class='font-bold text-lg'>{$row['prodname']}</h3>
                            <p class='text-gray-600'>{$row['prodcategory']}</p>
                            <p class='text-blue-800 font-semibold'>₹ {$row['prodprice']}</p>
                            <p class='text-sm'>Available Stock: {$row['prodquantity']}</p>
                            <p class='text-sm text-red-600 font-semibold'>Ordered Quantity: {$row['order_quantity']}</p>
                            <p class='text-sm mt-1'>{$row['proddescription']}</p>
                            <form method='POST' >
                                <input type='hidden' name='accept_sno' value='{$row['sno']}'>
                                <button type='submit' name='accept_product' class='mt-2 bg-green-600 text-white px-4 py-1 rounded hover:bg-green-800'>Accept</button>
                            </form>
                        </div>";
                    }
                    
                } else {
                    echo "<p class='text-gray-500 mt-4'>No orders to display.</p>";
                }
                echo"</div></div>";
                if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['accept_product'])) {
                    $acceptSno = intval($_POST['accept_sno']);
                    // Then delete from database
                    $deleteQuery = "UPDATE orderdetails
                    SET status = 'accepted'
                    WHERE prodsno = '$acceptSno' AND status = 'pending'";
                    if ($conn->query($deleteQuery) == TRUE) {
                        echo "<script>alert('Order accepted successfully!'); window.location.href='seller.php';</script>";
                    } else {
                        echo "<script>alert('Error accepting the order: {$conn->error}');</script>";
                    }
                }
            }
            ?>
        </div>

        <div class="flex w-full justify-center items-center">

            <?php
            if (isset($_SESSION['username'])&&$_SESSION['role']=='seller') {
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sellername = $_SESSION['username'];
                $sql = $sql = "SELECT productdetails.*, orderdetails.quantity AS order_quantity 
                FROM productdetails 
                JOIN orderdetails ON productdetails.sno = orderdetails.prodsno 
                WHERE productdetails.sellerid = '$sellername' 
                AND orderdetails.status = 'accepted'";
                 $result = $conn->query($sql);
                 echo "<div class='mt-8  shadow-xl p-3 w-full'><h2 class='text-xl font-bold mb-4 text-green-500'>Orders Fulfilled</h2><div class='grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6'>";
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='bg-white p-4 rounded-lg shadow-md'>
                            <div class='flex justify-center items-center'>
                            <img src='{$row['prodimagelink']}' class='w-48 h-48 object-cover rounded-md mb-2'>
                            </div>
                            <h3 class='font-bold text-lg'>{$row['prodname']}</h3>
                            <p class='text-gray-600'>{$row['prodcategory']}</p>
                            <p class='text-blue-800 font-semibold'>₹ {$row['prodprice']}</p>
                            <p class='text-sm'>Available Stock: {$row['prodquantity']}</p>
                            <p class='text-sm text-red-600 font-semibold'>Ordered Quantity: {$row['order_quantity']}</p>
                            <p class='text-sm mt-1'>{$row['proddescription']}</p>
                        </div>";
                    }
                    
                    
                } 
                else {
                    echo "<p class='text-gray-500 mt-4'>No orders fulfilled yet.</p>";
                }
                echo "</div></div>";
                
            }
            ?>
        </div>
    </div>

<?php
if(isset($_SESSION['username'])&&$_SESSION['role']=='seller') {
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] == "POST"&&isset($_POST['productName'])&&isset($_POST['productCategory'])){
    $prodname = clean_input($_POST["productName"]);
    $category = clean_input($_POST["productCategory"]);
    $price = clean_input($_POST["productPrice"]);
    $quantity = clean_input($_POST["productQuantity"]);
    $description = clean_input($_POST["productDescription"]);

    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $imageName = str_replace(' ', '', basename($_FILES["productImage"]["name"]));
    $targetFile = $targetDir . time() . "_" . $imageName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $validExtensions = ["jpg", "jpeg", "png"];
    if (!in_array($imageFileType, $validExtensions)) {
        echo "<script>alert('Invalid image format. Only JPG, JPEG, PNG allowed.')</script> ";
    } else if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
        $sellername = $_SESSION['username'];
        $sql = "INSERT INTO productdetails (sellerid, prodname, prodcategory, prodprice, prodquantity, proddescription, prodimagelink) VALUES ('$sellername','$prodname', '$category', '$price', '$quantity', '$description', '$targetFile')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Product added successfully!'); window.location.href='seller.php';</script>";
        } else {
            echo "<script>alert('Error: {$conn->error}');</script>";
        }
    } else {
        echo "<script>alert('Failed to upload image');</script>";
    }
}
$conn->close();
}
?>

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
<!-- Footer -->
<footer class="bg-[#0a192f] text-white text-center py-4 mt-10">
        <p>&copy; 2025 Nexamart. All rights reserved.</p>
    </footer>
</body>
</html>
<!-- INSERT INTO `orderdetails` (`sno`, `prodsno`, `quantity`) VALUES ('1', '13', '12'); -->