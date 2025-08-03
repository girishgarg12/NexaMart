<?php
ob_start();
include 'login1.php';
include 'bot.php';
include 'dbdetails.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - NexaMart</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/your-kit-code.js" crossorigin="anonymous"></script>
  <style>
    .floating-form { display: none; }
    .team-section { margin-top: 10px; }
  </style>
</head>

<body class="bg-gray-100 flex flex-col">
<?php
include 'navbar.php';
?>

 
  <!-- Contact Section -->
  <div class=" mt-16 relative w-full flex flex-col md:flex-row items-center justify-center bg-cover shadow-lg"
    style="background-image: url('./images/contact1.jpg'); background-size: cover; background-position: center; height: 600px;">

    <div class="absolute bg-black bg-opacity-50 w-full h-full flex flex-col justify-center items-center text-center px-6">

      <h1 class="text-5xl font-bold text-white mb-4">Get in Touch with NexaMart</h1>
      <p class="text-white text-lg mb-6">We would love to hear from you. Whether you have a question or feedback, feel free to send us a message!</p>

      <button onclick="toggleForm()" class="bg-purple-700 hover:bg-purple-900 text-white py-3 px-6 rounded-full font-semibold transition-all duration-300">
        Send Message
      </button>

      <!-- Floating Form -->
      <div id="floatingForm" class="floating-form mt-8 bg-white p-6 rounded-2xl shadow-2xl w-80">
        <h3 class="text-xl font-bold mb-4 text-purple-700">Send us a message</h3>
        <form id="contactForm" class="flex flex-col gap-4">
          <input class="border p-2 rounded-md" type="text" name="name" placeholder="Your Name" required>
          <input class="border p-2 rounded-md" type="email" name="email" placeholder="Your Email" required>
          <textarea class="border p-2 rounded-md" name="message" placeholder="Your Message" rows="4" required></textarea>
          <button class="bg-purple-700 hover:bg-purple-900 text-white py-2 rounded-md" type="submit">
            Send
          </button>
        </form>
        
        <div id="successMessage" class="hidden text-blue-950 font-semibold mt-4 ">
          Thank you! We will get back to you shortly.
        </div>
      </div>

    </div>
  </div>
  <div id="overlay" class="fixed inset-0 bg-black/60 bg-opacity-50 z-[60] hidden"></div>
  <div class="team-section pt-20 pb-10">
    <h2 class="text-4xl font-bold  text-center mb-12">Meet Our Team</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 max-w-7xl mx-auto">
    
      
      <div class="flex flex-col items-center text-center bg-white p-8 rounded-3xl shadow-xl hover:scale-105 transition-transform duration-300">
      
        <h3 class="text-2xl font-bold mb-2">Bharat Kumar</h3>
        <p class="text-gray-600 mb-2">BTech CSE Student</p>
        <p class="text-gray-500 mb-4">This is our first website project, developed as part of our learning journey in web development.</p>
        <div class="flex gap-4 mt-4 max-h-10">
          <a href="https://www.linkedin.com/in/piyushkumar5621?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank" class="text-purple-700 hover:text-purple-900 text-2xl">
           <img class="h-8 w-30 hover:scale-105 transition-transform duration-300" src="images/Linkdin.png" alt="">
          </a>
          <a href="https://www.instagram.com/piyush5621_?igsh=cWlicnFzajE5OHJi" target="_blank" class="text-purple-700 hover:text-purple-900 text-2xl">
            <img class="h-8 w-30  hover:scale-105 transition-transform duration-300" src="images/instagram.png" alt="">
          </a>
          <a href="https://x.com/KamlapuriPiyush?t=ptE-Gh6OcVcHgZEU0ZP1Cg&s=09" target="_blank" class="text-purple-700 hover:text-purple-900 text-2xl">
           <img class="h-8 w-30  hover:scale-105 transition-transform duration-300" src="images/twitter.svg" alt="">
          </a>
        </div>
      </div>
      <div class="flex flex-col items-center text-center bg-white p-8 rounded-3xl shadow-xl hover:scale-105 transition-transform duration-300">
      
        <h3 class="text-2xl font-bold  mb-2">Girish Garg</h3>
        <p class="text-gray-600 mb-2">BTech CSE Student</p>
        <p class="text-gray-500 mb-4">This is our first website project, developed as part of our learning journey in web development.</p>
        <div class="flex gap-4 mt-4 max-h-10">
          <a href="https://www.linkedin.com/in/piyushkumar5621?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank" class="text-purple-700 hover:text-purple-900 text-2xl">
           <img class="h-8 w-30 hover:scale-105 transition-transform duration-300" src="images/Linkdin.png  " alt="">
          </a>
          <a href="https://www.instagram.com/piyush5621_?igsh=cWlicnFzajE5OHJi" target="_blank" class="text-purple-700 hover:text-purple-900 text-2xl">
            <img class="h-8 w-30  hover:scale-105 transition-transform duration-300" src="images/instagram.png" alt="">
          </a>
          <a href="https://x.com/KamlapuriPiyush?t=ptE-Gh6OcVcHgZEU0ZP1Cg&s=09" target="_blank" class="text-purple-700 hover:text-purple-900 text-2xl">
           <img class="h-8 w-30  hover:scale-105 transition-transform duration-300" src="images/twitter.svg" alt="">
          </a>
        </div>
      </div>
      <div class="flex flex-col items-center text-center bg-white p-8 rounded-3xl shadow-xl hover:scale-105 transition-transform duration-300">
      
        <h3 class="text-2xl font-bold mb-2">Piyush Kumar</h3>
        <p class="text-gray-600 mb-2">BTech CSE Student</p>
        <p class="text-gray-500 mb-4">This is our first website project, developed as part of our learning journey in web development.</p>
        <div class="flex gap-4 mt-4 max-h-10">
          <a href="https://www.linkedin.com/in/piyushkumar5621?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank" class="text-purple-700 hover:text-purple-900 text-2xl">
           <img class="h-8 w-30 hover:scale-105 transition-transform duration-300" src="images/Linkdin.png  " alt="">
          </a>
          <a href="https://www.instagram.com/piyush5621_?igsh=cWlicnFzajE5OHJi" target="_blank" class="text-purple-700 hover:text-purple-900 text-2xl">
            <img class="h-8 w-30  hover:scale-105 transition-transform duration-300" src="images/instagram.png" alt="">
          </a>
          <a href="https://x.com/KamlapuriPiyush?t=ptE-Gh6OcVcHgZEU0ZP1Cg&s=09" target="_blank" class="text-purple-700 hover:text-purple-900 text-2xl">
           <img class="h-8 w-30  hover:scale-105 transition-transform duration-300" src="images/twitter.svg" alt="">
          </a>
        </div>
      </div>
      <div class="flex flex-col items-center text-center bg-white p-8 rounded-3xl shadow-xl hover:scale-105 transition-transform duration-300">
      
        <h3 class="text-2xl font-bold mb-2">Abhay Chaudhary</h3>
        <p class="text-gray-600 mb-2">BTech CSE Student</p>
        <p class="text-gray-500 mb-4">This is our first website project, developed as part of our learning journey in web development.</p>
        <div class="flex gap-4 mt-4 max-h-10">
          <a href="https://www.linkedin.com/in/piyushkumar5621?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank" class="text-purple-700 hover:text-purple-900 text-2xl">
           <img class="h-8 w-30 hover:scale-105 transition-transform duration-300" src="images/Linkdin.png  " alt="">
          </a>
          <a href="https://www.instagram.com/piyush5621_?igsh=cWlicnFzajE5OHJi" target="_blank" class="text-purple-700 hover:text-purple-900 text-2xl">
            <img class="h-8 w-30  hover:scale-105 transition-transform duration-300" src="images/instagram.png" alt="">
          </a>
          <a href="https://x.com/KamlapuriPiyush?t=ptE-Gh6OcVcHgZEU0ZP1Cg&s=09" target="_blank" class="text-purple-700 hover:text-purple-900 text-2xl">
           <img class="h-8 w-30  hover:scale-105 transition-transform duration-300" src="images/twitter.svg" alt="">
          </a>
        </div>
      </div>
     
  </div>

  <script>
    function toggleForm() {
      const form = document.getElementById('floatingForm');
      form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    }

    document.getElementById('contactForm').addEventListener('submit', function(event) {
      event.preventDefault(); 
      document.getElementById('contactForm').style.display = 'none';
      document.getElementById('successMessage').classList.remove('hidden');

      
      setTimeout(() => {
        document.getElementById('floatingForm').style.display = 'none';
        document.getElementById('contactForm').reset();
        document.getElementById('contactForm').style.display = 'flex';
        document.getElementById('successMessage').classList.add('hidden');
      }, 5000); 
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

</body>

</html>
