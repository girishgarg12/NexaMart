<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "dbdetails.php";
function validateName($name, $type) {
    $name = trim($name);
    if (empty($name)) {
        return $type . " is required.";
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $user = trim($_POST["username"]);
    $pass = trim(htmlspecialchars($_POST["password"]));
    $remember = isset($_POST["remember me"]) ? true : false;

    $usernameError = validateName($user, "Username");
    $PassError = validateName($pass, "Password");

    if ($usernameError !== true) {
        echo "<script>alert('$usernameError');</script>";
    } else if ($PassError !== true) {
        echo "<script>alert('$PassError');</script>";
    } else {
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $sql = "SELECT * FROM `userdetails` WHERE `email`='$user' AND `password`='$pass'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0) {
                echo "<script>alert('Invalid username or password');</script>";
            } else {
                session_unset();
                $row = mysqli_fetch_assoc($result);
                $_SESSION['username'] = $user;
                $_SESSION['role'] = $row['status'];
                echo "<script>
                    alert('Login successful!');
                    window.location.href = '" . $_SERVER['REQUEST_URI'] . "';
                </script>";
                exit();
            }
        }
    }
}
?>

<!-- Login Modal -->
<div id="loginModal" class="absolute w-full bg-black/70 h-[100vh] z-40 hidden pt-20">
    <div class="w-full absolute flex justify-center z-50 mt-16">
        <div class="bg-white rounded-2xl shadow-lg p-6 w-auto md:w-auto max-w-4xl relative animate-slide-down">
            <!-- Close Button -->
            <button onclick="toggleLoginModal()" class="absolute top-3 right-3 text-2xl font-bold text-gray-500">&times;</button>

            <!-- Login Grid -->
            <div class="login grid grid-cols-1 md:grid-cols-2 gap-4 min:w-60">
                <!-- Left (Form) -->
                <div class="flex flex-col items-center justify-center gap-3">
                    <div class="text-blue-950 font-extrabold text-3xl">User Login</div>
                    <form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method="POST" class="flex flex-col justify-center gap-4">
                        <input class="w-60 md:w-80 bg-gray-100 p-2 rounded-2xl text-center text-xl" type="text" name="username" placeholder="Username">
                        <input class="w-60 md:w-80 bg-gray-100 p-2 rounded-2xl text-center text-xl" type="password" required name="password" placeholder="Password">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="remember me">
                            <span>Remember me</span>
                            <a class="ml-auto text-blue-600 hover:underline text-sm" href="#">Forgot Password?</a>
                        </div>
                        <button class="w-60 cursor-pointer md:w-80 bg-blue-950 rounded-2xl text-white text-xl font-bold p-2" type="submit">Submit</button>
                        <a href="signup.php" class="text-center w-60 cursor-pointer md:w-80 bg-blue-950 rounded-2xl text-white font-bold p-2">New User? &nbspSignUp</a>
                    </form>
                </div>

                <!-- Right (Image) -->
                <div class="hidden md:flex items-center justify-center">
                    <img src="images/Login-01.jpg" class="w-full h-auto">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal Script -->
<script>
function toggleLoginModal() {
    const modal = document.getElementById("loginModal");
    modal.classList.toggle("hidden");
    setTimeout(() => {
        modal.classList.remove('animate-slide-down');
    }, 60000);
}
</script>

<style>
@keyframes slideDown {
  0% {
    transform: translateY(-100%);
    opacity: 0;
  }
  100% {
    transform: translateY(0);
    opacity: 1;
  }
}
.animate-slide-down {
  animation: slideDown .6s ease-out forwards;
}
</style>
