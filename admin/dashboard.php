<?php

session_start();

include '../config/database.php';

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");

    exit();

}

$services = $conn->query(
"SELECT COUNT(*) FROM services"
)->fetchColumn();

$projects = $conn->query(
"SELECT COUNT(*) FROM projects"
)->fetchColumn();

$blogs = $conn->query(
"SELECT COUNT(*) FROM blogs"
)->fetchColumn();

$gallery = $conn->query(
"SELECT COUNT(*) FROM gallery"
)->fetchColumn();

$events = $conn->query(
"SELECT COUNT(*) FROM events"
)->fetchColumn();

$contacts = $conn->query(
"SELECT COUNT(*) FROM contact_messages"
)->fetchColumn();

include '../includes/header.php';

?>

<section class="admin-section">

<div class="container">

<div class="d-flex justify-content-between mb-5">

<div>

<h2>

Welcome

<?php echo $_SESSION['admin_name']; ?>

</h2>

<p>

AI Solutions Administration Panel

</p>

</div>

<div>

<a href="logout.php"
   class="btn btn-danger">

Logout

</a>

</div>

</div>

<div class="row g-4">

<div class="col-md-4">

<div class="dashboard-card">

<h2>

<?php echo $services; ?>

</h2>

<p>

Services

</p>

</div>

</div>

<div class="col-md-4">

<div class="dashboard-card">

<h2>

<?php echo $projects; ?>

</h2>

<p>

Projects

</p>

</div>

</div>

<div class="col-md-4">

<div class="dashboard-card">

<h2>

<?php echo $blogs; ?>

</h2>

<p>

Blogs

</p>

</div>

</div>

<div class="col-md-4">

<div class="dashboard-card">

<h2>

<?php echo $gallery; ?>

</h2>

<p>

Gallery Images

</p>

</div>

</div>

<div class="col-md-4">

<div class="dashboard-card">

<h2>

<?php echo $events; ?>

</h2>

<p>

Events

</p>

</div>

</div>

<div class="col-md-4">

<div class="dashboard-card">

<h2>

<?php echo $contacts; ?>

</h2>

<p>

Customer Inquiries

</p>

</div>

</div>

</div>

<hr class="my-5">

<div class="row g-4">

<div class="col-md-3">

<a href="manage-users.php"
   class="quick-link">

<div class="dashboard-card">

👤

<h5 class="mt-3">

Manage Users

</h5>

</div>

</a>

</div>

<div class="col-md-3">

<a href="manage-services.php"
   class="quick-link">

<div class="dashboard-card">

🛠️

<h5 class="mt-3">

Manage Services

</h5>

</div>

</a>

</div>

<div class="col-md-3">

<a href="manage-projects.php"
   class="quick-link">

<div class="dashboard-card">

📁

<h5 class="mt-3">

Manage Projects

</h5>

</div>

</a>

</div>

<div class="col-md-3">

<a href="manage-blogs.php"
   class="quick-link">

<div class="dashboard-card">

📰

<h5 class="mt-3">

Manage Blogs

</h5>

</div>

</a>

</div>

<div class="col-md-3">

<a href="manage-gallery.php"
   class="quick-link">

<div class="dashboard-card">

🖼️

<h5 class="mt-3">

Manage Gallery

</h5>

</div>

</a>

</div>

<div class="col-md-3">

<a href="manage-events.php"
   class="quick-link">

<div class="dashboard-card">

📅

<h5 class="mt-3">

Manage Events

</h5>

</div>

</a>

</div>

<div class="col-md-3">

<a href="manage-feedback.php"
   class="quick-link">

<div class="dashboard-card">

⭐

<h5 class="mt-3">

Manage Feedback

</h5>

</div>

</a>

</div>

<div class="col-md-3">

<a href="manage-inquiries.php"
   class="quick-link">

<div class="dashboard-card">

📨

<h5 class="mt-3">

Customer Inquiries

</h5>

</div>

</a>

</div>

</div>

</div>

</section>

<?php include '../includes/footer.php'; ?>