<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <title>NexaMart Chatbot</title>
</head>
<body class="bg-white">
<div id="overlay" class="fixed inset-0 bg-black/60 bg-opacity-50 z-[60] hidden"></div>
 
  <!-- Floating Chat Button -->
  <button 
    id="chat-toggle-btn"
    class="fixed bottom-6 right-6 bg-indigo-600 text-white p-4 rounded-full shadow-lg hover:bg-indigo-700 z-50"
  >
    💬
  </button>

  <!-- Chatbot Container -->
  <div 
    id="chat-container" 
    class="hidden fixed bottom-6 right-6 bg-gray-100 w-[360px] h-[500px] rounded-xl shadow-lg flex flex-col z-[70]"
  >
    <!-- Chat Header -->
    <div class="flex justify-between items-center bg-indigo-600 text-white p-3 rounded-t-xl">
      <h2 class="text-lg font-semibold">NexaMart Assistant</h2>
      <button id="chat-close-btn" class="text-xl hover:text-gray-200">✕</button>
    </div>

    <!-- Chat Messages -->
    <div id="chat-box" class="flex-1 p-4 overflow-y-auto space-y-2">
      <div class="flex mr-20 bg-gray-200 p-2 rounded-t-xl rounded-br-xl">Hi there, how can I help you?</div>
    </div>

    <!-- Chat Input -->
    <div class="chat-input flex p-3 border-t border-gray-200">
      <input 
        id="user-input" 
        type="text" 
        placeholder="Ask me anything..." 
        class="flex-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
      />
      <button 
        id="send-btn" 
        class="ml-2 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
      >
        Send
      </button>
    </div>
  </div>

  <script>
    const API_KEY = "AIzaSyDl0PyPjqraD1RoojlVIXctgtQBXdSpPa8"; // Replace with your actual key

    const initialPrompt = `
You are an AI shopping assistant for our e-commerce website named NexaMart. Our store sells clothes, footwear, and electronics such as laptops, watches, and mobile phones. Our mission is to help users find the perfect products and solve their doubts related to shopping.

Our headquarters are located at Lovely Professional University, Phagwara, and our customer helpline number is 9729024316.

You must:
- Greet users warmly and help them with shopping-related queries.
- Suggest trending designs and best-matching clothing and footwear based on user needs.
- Recommend electronics like mobile phones and laptops as per user preferences.
- Encourage customers to explore and buy from our website.
- Mention offers, categories, and help with product comparisons.
- If users ask about selling, inform them about our seller section where they can register to sell their products.
- Let them know sellers get benefits like cash bonuses, free promotions, and free delivery of goods for 1 month.

Always stay friendly, helpful, and specific to our platform's offerings.
If you do not know the answer to a user's question, politely direct them to our helpline: 9729024316.
Most importantly, provide **short, clear, and precise answers** to users. Keep responses helpful but **within 200 words**. Always encourage users to explore and shop from our website in a friendly and engaging tone.
`;

    // Toggle Chat
    const toggleBtn = document.getElementById("chat-toggle-btn");
    const chatContainer = document.getElementById("chat-container");
    const closeBtn = document.getElementById("chat-close-btn");
    const overlay = document.getElementById('overlay');

    toggleBtn.addEventListener("click", () => {
      chatContainer.classList.remove("hidden");
      overlay.classList.remove('hidden');
      toggleBtn.classList.add("hidden");

    });

    closeBtn.addEventListener("click", () => {
      chatContainer.classList.add("hidden");
      overlay.classList.add('hidden');
      toggleBtn.classList.remove("hidden");
    });

    // Message history (start with initial context)
    const messageHistory = [
      {
        role: "user",
        parts: [{ text: initialPrompt }]
      }
    ];

    // Send message to Gemini
    async function getGeminiReply() {
      const url = `https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key=${API_KEY}`;

      const payload = {
        contents: messageHistory
      };

      try {
        const res = await fetch(url, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(payload)
        });

        await new Promise(resolve => setTimeout(resolve, 1000));
        const data = await res.json();
        const reply = data?.candidates?.[0]?.content?.parts?.[0]?.text || "Support is away. Please try again later.";

        // Save bot reply to history
        messageHistory.push({
          role: "model",
          parts: [{ text: reply }]
        });

        return reply;
      } catch (err) {
        console.error("Error:", err);
        return "Error fetching response.";
      }
    }

    // Send message on click or enter
    async function sendMessage() {
      const input = document.getElementById("user-input");
      const message = input.value.trim();
      if (!message) return;

      const chatBox = document.getElementById("chat-box");

      // Add user message
      const userDiv = document.createElement("div");
      userDiv.className = "user";
      userDiv.innerText = message;
      userDiv.classList.add("flex", "ml-20", "bg-blue-200", "p-2", "m-2", "rounded-t-xl", "rounded-bl-xl");
      chatBox.appendChild(userDiv);
      input.value = "";

      // Save user message to history
      messageHistory.push({
        role: "user",
        parts: [{ text: message }]
      });

      // Add typing dots
      const botDiv = document.createElement("div");
      botDiv.className = "bot";
      botDiv.classList.add("flex", "mr-20", "bg-gray-200", "p-2", "m-2", "rounded-t-xl", "rounded-br-xl");
      botDiv.innerHTML = `<span class="dot font-extrabold text-3xl">.</span><span class="dot font-extrabold text-3xl">.</span><span class="dot font-extrabold text-3xl">.</span>`;
      chatBox.appendChild(botDiv);
      chatBox.scrollTop = chatBox.scrollHeight;

      // Get response
      const reply = await getGeminiReply();
      botDiv.innerText = reply;
      chatBox.scrollTop = chatBox.scrollHeight;
    }

    document.getElementById("send-btn").addEventListener("click", sendMessage);
    document.getElementById("user-input").addEventListener("keypress", function (e) {
      if (e.key === "Enter") sendMessage();
    });

    // Optional: send initial context after load to warm up
    document.addEventListener("DOMContentLoaded", () => {
      setTimeout(() => {
        console.log("Bot initialized with context.");
      }, 1000);
    });
  
   const searchInput = document.getElementById('search');
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
