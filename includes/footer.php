<footer class="footer">

<div class="container">

<div class="row">

<div class="col-lg-4 mb-4">

<h4>

AI-Solutions

</h4>

<p>

AI-powered software development,
business automation,
web development,
and chatbot solutions.

</p>

</div>

<div class="col-lg-4 mb-4">

<h5>

Quick Links

</h5>

<ul class="footer-links">

<li>

<a href="/ai-chatbot-solutions/index.php">

Home

</a>

</li>

<li>

<a href="/ai-chatbot-solutions/pages/about.php">

About

</a>

</li>

<li>

<a href="/ai-chatbot-solutions/pages/services.php">

Services

</a>

</li>

<li>

<a href="/ai-chatbot-solutions/pages/projects.php">

Projects

</a>

</li>

<li>

<a href="/ai-chatbot-solutions/pages/contact.php">

Contact

</a>

</li>

</ul>

</div>

<div class="col-lg-4 mb-4">

<h5>

Contact Info

</h5>

<p>

📧 info@aisolutions.com

</p>

<p>

📞 +977 9800000000

</p>

<p>

📍 Kathmandu, Nepal

</p>

</div>

</div>

<hr>

<div class="text-center">

<p>

© <?php echo date('Y'); ?>

AI-Solutions.

All Rights Reserved.

</p>

</div>

</div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<button class="chatbot-toggle" onclick="toggleChatbot()">
    💬
</button>


<div class="chatbot-container" id="chatbot" style="display:none;">

<div class="chat-header">
    AI Assistant
    <span onclick="toggleChatbot()" style="float:right;cursor:pointer;">
        ✖
    </span>
</div>

<div class="chat-body" id="chatBody">

    <div class="bot-message">
        Hello 👋<br>
        Welcome to AI-Solutions.<br><br>
        How can I help you today?
    </div>

</div>

<div class="chat-footer">

    <input
        type="text"
        id="userInput"
        placeholder="Type your question...">

    <button onclick="sendMessage()">
        Send
    </button>

</div>

</div>

<script src="/ai-chatbot-solutions/assets/chatbot/chatbot.js"></script>

</body>

</html>