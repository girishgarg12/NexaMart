<?php
ob_start();
include 'bot.php';

include 'login1.php';
include 'dbdetails.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link rel="stylesheet" href="./output.css"> -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="" >
    <?php
    include 'navbar.php';
    ?>
 <div id="overlay" class="fixed inset-0 bg-black/60 bg-opacity-50 z-[60] hidden"></div>

<main class="p-0 flex items-center justify-center min-h-screen bg-gray-100 pt-20">

       
<div class="w-full max-w-5xl h-[500px] rounded-xl shadow-2xl flex overflow-hidden relative">
    

        

<div class="w-1/2 bg-blue-900  text-white px-10 py-12 flex flex-col justify-center overflow-hidden relative z-0 rounded-l-xl">

<!-- Circles (Background Decorations) -->
<div class="absolute w-48 h-48 bg-blue-700 opacity-60 rounded-full -bottom-10 -left-10 z-0"></div>
<div class="absolute w-32 h-32 bg-blue-500 opacity-80 rounded-full bottom-10 left-32 z-0"></div>
<div class="absolute w-32 h-32 bg-blue-400 opacity-60 rounded-full -bottom-8 -right-8 z-0"></div>

<!-- Text Content -->
<h1 class="text-4xl font-bold mb-2 text-center z-10">WELCOME</h1>
<p class="text-md text-justify text-white/80 leading-relaxed z-10">
    Discover the future of online shopping with Nexamart — where quality meets convenience. 
    Enjoy seamless browsing, secure transactions, and lightning-fast delivery all in one place. 
    Your perfect product is just a click away!
</p>
</div>

        <!-- Right Form section goes here (not included) -->
        <div class="w-2/3 bg-white flex flex-col items-center justify-between ">
            <div class="flex flex-col bg-white gap-3 ">
                
                <div class="px-6 flex flex-col items-center justify-center gap-2 " >
                    <h2 style="font-family: Georgia, serif;" class=" text-center text-2xl font-bold text-gray-800 my-4">Sign Up</h2>
                    <form action="" method="POST">
                    <input type="text" name="firstname" placeholder="First Name" class="w-full mb-3 p-2 rounded-md border border-gray-300 outline-none focus:ring-2 focus:ring-blue-950">
                    <input type="text" name="lastname" placeholder="Last Name" class="w-full mb-3 p-2 rounded-md border border-gray-300 outline-none focus:ring-2 focus:ring-blue-950">
                    <input type="number" min="0" max="9999999999" name="mobile" placeholder="+91 Mobile" class="w-full mb-3 p-2 rounded-md border border-gray-300 outline-none focus:ring-2 focus:ring-blue-950">
                    <input type="email" name="email" placeholder="Email" class="w-full mb-3 p-2 rounded-md border border-gray-300 outline-none focus:ring-2 focus:ring-blue-950">
                    <input type="password" name="password" placeholder="Create Password" class="w-full mb-3 p-2 rounded-md border border-gray-300 outline-none focus:ring-2 focus:ring-blue-950">

                    <label class="flex items-center space-x-2 text-gray-700 ">
                        <input type="checkbox" class="size-4">
                        <span>Get updates on Email</span>
                    </label>
                    <p class="text-center text-gray-600 text-sm my-2">
                        By signing up, you agree to our <a href="#" class="text-blue-900 font-medium">Terms of Service</a> and <a href="#" class="text-blue-900 font-medium">Privacy Policy</a>.
                    </p>
                    <button type="submit" id="sub" class="py-2 w-full bg-blue-950 text-white font-semibold rounded-md hover:bg-blue-900 transition">
                        Create an Account
                    </button>
                    </form>
                    <p class="text-center text-gray-600 text-sm">
                        Have an account? <a href="login.php" class="text-blue-900 font-medium">Log In</a>
                    </p>
                </div>
            </div>

        </div>
    
    </div>
    </main>
    <footer class="mb-0  w-full bg-[#0a192f]  text-white text-center py-4 ">
        <p>&copy; 2025 Nexamart. All rights reserved.</p>
    </footer>
    <?php
    function validateName1($name,$type) {
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
    function validatemobile1($mob) {
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
    function validatemail1($email) {
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
    function validatepass1($password) {
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
        if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['mobile'])&&isset($_POST['email'])&&isset($_POST['password'])){
            // if(!empty($_REQUEST['firstname'])&&!empty($_REQUEST['lastname'])&&!empty($_REQUEST['mob'])&&!empty($_REQUEST['email'])&&!empty($_REQUEST['password'])){
                $fname=$_POST['firstname'];
                $lname=$_POST['lastname'];
                $mob=$_POST['mobile'];
                $email=$_POST['email'];
                $pass=$_POST['password'];

                $fnameError = validateName1($fname,"Firstname");
                $lnameError = validateName1($lname,"Lastname");
                $mobError= validatemobile1($mob);
                $emailError=validatemail1($email);
                $passError=validatepass1($pass);
            // }
            if ($fnameError) {
                echo "<script>alert('$fnameError');</script>";
            } else if ($lnameError) {
                echo "<script>alert('$lnameError');</script>";
            } else if ($mobError) {
                echo "<script>alert('$mobError');</script>";
            } else if ($emailError) {
                echo "<script>alert('$emailError');</script>";
            } else if ($passError) {
                echo "<script>alert('$passError');</script>";
            } else {
 // Create connection
                if(!$conn){
                    echo "<script>alert('Cannot connect to database. Try again!')</script>";
                }
                $mailcheck="SELECT * FROM `userdetails` WHERE `email`='$email'";
                $result=$conn->query($mailcheck);
                $mobcheck="SELECT * FROM `userdetails` WHERE `mobile`='$mob'";
                $result2=$conn->query($mobcheck);        
                if(mysqli_num_rows($result)>0){
                    echo "<script>alert('Email already exists Please use a different email');</script>";
                }
                else if(mysqli_num_rows($result2)>0){
                        echo "<script>alert('Mobile number already exists');</script>";
                }
                else{
                $sql="INSERT INTO `userdetails` ( `firstname`, `lastname`, `mobile`, `email`, `password`,`status`) VALUES ( '$fname', '$lname', '$mob', '$email', '$pass','user');";
                if($conn->query($sql)==true){
                    echo "<script>alert('Account created successfuly')</script>";
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
    document.addEventListener('keydown', function (event) {
        let submitBtn = document.getElementById('sub');
            if (event.key === 'Enter') {
                event.preventDefault();
                submitBtn.click();
            }
        });
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
    <!-- INSERT INTO `userdetails` (`sno`, `firstname`, `lastname`, `mobile`, `email`, `password`) VALUES ('1', 'asd', 'zxc', '0123456789', 'abc@gmail.com', '123@1'); -->
</body>
</html>
