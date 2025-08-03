<?php
include 'dbdetails.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration - NexaMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg {
            /* background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); */
            background:	#f1f5f9;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="gradient-bg flex flex-col items-center">
    
    
        
       <?php
    include 'navbar.php';
       ?>
       <header class="w-full bg-white shadow-lg fixed top-0 z-50 mt-16">
        <div class="bg-amber-400 text-black text-center py-2 px-4 font-bold text-sm md:text-base">
            🚀Free seller onboarding & 0% commission for first 3 months! Limited time offer.
        </div>
    </header>
    <div id="overlay" class="fixed inset-0 bg-black/60 bg-opacity-50 z-[60] hidden"></div>
    <div class="w-[80%] max-w-6xl mt-24 p-2 mb-10 px-4 h-[80%]">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden h-120px">
            <div class=" w-full flex flex-row lg:flex-row ">
                <div class="w-1/2 lg:w-1/2 bg-gradient-to-br from-blue-600 to-blue-800 text-white flex flex-col">
                    <img class="w-full h-full" src="images/sellerreg.jpg" alt="">
                    
                </div>
               
                <div class="w-1/2 lg:w-1/2 p-8 md:p-10">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Create Seller Account</h2>
                        
                    </div>
                    
                    <form method="POST" action="" id="registrationForm" class="space-y-5">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">Shop Name *</label>
                            <div class="relative">
                                <input  type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="Your shop/brand name" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-store text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-1">
                                <label  class="block text-sm font-medium text-gray-700">Owner Name *</label>
                                <div class="relative">
                                    <input name="username" type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="Full name" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-1">
                                <label  class="block text-sm font-medium text-gray-700">Mobile Number *</label>
                                <div class="relative">
                                    <input name="mobile" type="tel" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="+91 9876543210" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <i class="fas fa-mobile-alt text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <label  class="block text-sm font-medium text-gray-700">Email Address *</label>
                            <div class="relative">
                                <input name="email" type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="your@email.com" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label  class="block text-sm font-medium text-gray-700">Create Password *</label>
                            <div class="relative">
                                <input name="password" type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all " placeholder="Enter password" required>
                                
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">Business Address *</label>
                            <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"  placeholder="Shop/office address" required></textarea>
                        </div>
                        
            
                        
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" required>
                            </div>
                            <label for="terms" class="ml-2 text-sm font-medium text-gray-700">
                                I agree to the <a href="#" class="text-blue-600 hover:underline">Terms & Conditions</a> and <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>
                            </label>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-all flex items-center justify-center space-x-2">
                            <span>Continue Registration</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>


            </div>
        </div>
        

    </div>

    <?php
    function validateNames($name,$type) {
        // Trim whitespace
        $name = trim($name);
    
        // Check if name is empty
        if (empty($name)) {
            return $type." is required.";
        }
    
        // Check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            return "Only letters and spaces are allowed in the ".$type;
        }
    
        // Optional: check name length
        if (strlen($name) < 2 || strlen($name) > 50) {
            return $type." must be between 2 and 50 characters.";
        }
    
        // If all checks pass
        return "";
    }
    function validatemobiles($mob) {
        $mob = trim($mob);
        if (empty($mob)) {
            return "Mobile is required.";
        }
        if (!preg_match("/^[0-9]*$/", $mob)) {
            return "Only digits are allowed in the name.";
        }
        if (strlen($mob) !=10) {
            return "Mobile number must be 10 digits.";
        }
        return "";
    }
    function validatemails($email) {
        $email = trim($email);
        if (empty($email)) {
            return "Email is required.";
        }
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email address";
        }
        return "";
    }
    function validatepasss($password) {
        $password = trim($password);
        if (strlen($password) < 8) {
            return "Password must be at least 8 characters long.";
        }
        if (!preg_match('/[\W_]/', $password)) {
            return "Password must include at least one special character.";
        }
        if (!preg_match('/[A-Z]/', $password)) {
            return "Password must include at least one uppercase letter.";
        }
        if (!preg_match('/[a-z]/', $password)) {
            return "Password must include at least one lowercase letter.";
        }
        return "";
    }

    


    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['username'])&&isset($_POST['mobile'])&&isset($_POST['email'])&&isset($_POST['password'])){
            // if(!empty($_REQUEST['firstname'])&&!empty($_REQUEST['lastname'])&&!empty($_REQUEST['mob'])&&!empty($_REQUEST['email'])&&!empty($_REQUEST['password'])){
                $fname=$_POST['username'];
                $mob=$_POST['mobile'];
                $email=$_POST['email'];
                $pass=$_POST['password'];

                $fnameError = validateNames($fname,"Name");
                $mobError= validatemobiles($mob);
                $emailError=validatemails($email);
                $passError=validatepasss($pass);
            // }
            if ($fnameError) {
                echo "<script>alert('$fnameError'); window.location.href = '" . $_SERVER['REQUEST_URI'] . "'</script>";
            } else if ($mobError) {
                echo "<script>alert('$mobError');window.location.href = '" . $_SERVER['REQUEST_URI'] . "'</script>";
            } else if ($emailError) {
                echo "<script>alert('$emailError');window.location.href = '" . $_SERVER['REQUEST_URI'] . "'</script>";
            } else if ($passError) {
                echo "<script>alert('$passError');window.location.href = '" . $_SERVER['REQUEST_URI'] . "'</script>";
            } else {
 // Create connection
                if(!$conn){
                    echo "<script>alert('Cannot connect to database. Try again!')</script>";
                }
                $mailcheck="SELECT * FROM `userdetails` WHERE `email`='$email'";
                $result=$conn->query($mailcheck);        
                if(mysqli_num_rows($result)>0){
                    echo "<script>alert('Email already exists Please use a different email');</script>";
                }
                
                else{
                $sql="INSERT INTO `userdetails` ( `firstname`, `lastname`, `mobile`, `email`, `password`,`status`) VALUES ( '$fname', '', '$mob', '$email', '$pass','seller');";
                if($conn->query($sql)==true){
                    echo "<script>alert('Account created successfuly');window.location.href = 'index.php'</script>";
                    exit();
                }
                else{
                    echo "<script>alert('Something went wrong Try again!')</script>";
                }
            }
            }
            }
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

</body>
</html>