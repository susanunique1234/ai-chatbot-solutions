<?php

$currentPage = basename($_SERVER['PHP_SELF']);

?>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">

    <div class="container">

        <a class="navbar-brand"
           href="/ai-chatbot-solutions/index.php">

            <span class="logo-text">

                AI-Solutions

            </span>

        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarContent"
                aria-controls="navbarContent"
                aria-expanded="false"
                aria-label="Toggle navigation">

         <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarContent">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage=='index.php') ? 'active' : ''; ?>"
                       href="/ai-chatbot-solutions/index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage=='about.php') ? 'active' : ''; ?>"
                       href="/ai-chatbot-solutions/pages/about.php">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage=='services.php') ? 'active' : ''; ?>"
                       href="/ai-chatbot-solutions/pages/services.php">Services</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage=='projects.php') ? 'active' : ''; ?>"
                       href="/ai-chatbot-solutions/pages/projects.php">Projects</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage=='blog.php') ? 'active' : ''; ?>"
                       href="/ai-chatbot-solutions/pages/blog.php">Blog</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage=='gallery.php') ? 'active' : ''; ?>"
                       href="/ai-chatbot-solutions/pages/gallery.php">Gallery</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage=='events.php') ? 'active' : ''; ?>"
                       href="/ai-chatbot-solutions/pages/events.php">Events</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage=='testimonials.php') ? 'active' : ''; ?>"
                       href="/ai-chatbot-solutions/pages/testimonials.php">Testimonials</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage=='feedback.php') ? 'active' : ''; ?>"
                       href="/ai-chatbot-solutions/pages/feedback.php">Feedback</a>
                </li>

                <!-- Contact Us as plain nav-link -->
                <li class="nav-item ms-lg-3">
                    <a class="nav-link <?php echo ($currentPage=='contact.php') ? 'active' : ''; ?>"
                       href="/ai-chatbot-solutions/pages/contact.php">
                        Contact Us
                    </a>
                </li>

                <!-- Admin as highlighted button -->
                <li class="nav-item">
                    <a href="/ai-chatbot-solutions/admin/login.php"
                       class="btn custom-btn <?php echo ($currentPage=='login.php') ? 'active-btn' : ''; ?>">
                        Admin
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>