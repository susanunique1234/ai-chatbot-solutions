<?php

include 'config/database.php';

include 'includes/header.php';

include 'includes/navbar.php';

/*
LATEST SERVICES
*/

$serviceQuery = "

SELECT *

FROM services

ORDER BY id DESC

LIMIT 3

";

$serviceStmt = $conn->prepare($serviceQuery);

$serviceStmt->execute();

$services = $serviceStmt->fetchAll(PDO::FETCH_ASSOC);

/*
LATEST PROJECTS
*/

$projectQuery = "

SELECT *

FROM projects

ORDER BY id DESC

LIMIT 3

";

$projectStmt = $conn->prepare($projectQuery);

$projectStmt->execute();

$projects = $projectStmt->fetchAll(PDO::FETCH_ASSOC);

/*
LATEST TESTIMONIALS
*/

$feedbackQuery = "

SELECT *

FROM feedback

ORDER BY id DESC

LIMIT 3

";

$feedbackStmt = $conn->prepare($feedbackQuery);

$feedbackStmt->execute();

$feedbacks = $feedbackStmt->fetchAll(PDO::FETCH_ASSOC);

/*
LATEST EVENTS
*/

$eventQuery = "

SELECT *

FROM events

ORDER BY event_date ASC

LIMIT 3

";

$eventStmt = $conn->prepare($eventQuery);

$eventStmt->execute();

$events = $eventStmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- HERO -->

<section class="hero-section">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-6">

<h1 class="hero-title">

Intelligent AI Solutions For Modern Businesses

</h1>

<p class="hero-text">

AI-powered software solutions, chatbots,
web development, automation systems and
business transformation technologies.

</p>

<a href="pages/contact.php"
   class="btn btn-primary hero-btn mt-4">

Get Started

</a>

</div>

<div class="col-lg-6 text-center">

<img src="assets/images/about.jpg"
     class="img-fluid">

</div>

</div>

</div>

</section>

<!-- SERVICES -->

<section class="section-padding">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">

Our Services

</h2>

<p class="section-subtitle">

Professional software solutions for businesses

</p>

</div>

<div class="row g-4">

<?php foreach($services as $service){ ?>

<div class="col-lg-4">

<div class="custom-card h-100">

<img src="assets/uploads/services/<?php echo $service['image']; ?>"
     class="service-icon mx-auto d-block">

<h4>

<?php echo $service['title']; ?>

</h4>

<p>

<?php echo $service['description']; ?>

</p>

</div>

</div>

<?php } ?>

</div>

</div>

</section>

<!-- ABOUT -->

<section class="section-padding bg-light">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-6">

<img src="assets/images/about.jpg"
     class="img-fluid rounded shadow">

</div>

<div class="col-lg-6">

<h2 class="section-title">

About AI Solutions

</h2>

<p>

AI Solutions specializes in intelligent
software systems, AI-powered chatbots,
automation platforms and business websites.

</p>

<p>

Our mission is to help businesses
improve efficiency, customer engagement
and digital transformation.

</p>

<a href="pages/about.php"
   class="btn btn-primary">

Learn More

</a>

</div>

</div>

</div>

</section>

<!-- PROJECTS -->

<section class="section-padding">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">

Featured Projects

</h2>

</div>

<div class="row g-4">

<?php foreach($projects as $project){ ?>

<div class="col-lg-4">

<div class="custom-card overflow-hidden">

<img src="assets/uploads/projects/<?php echo $project['image']; ?>"
     class="project-image w-100">

<div class="p-4">

<h4>

<?php echo $project['title']; ?>

</h4>

<p>

<?php echo substr(

$project['description'],

0,

120

);

?>...

</p>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</section>

<!-- TESTIMONIALS -->

<section class="section-padding bg-light">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">

Customer Feedback

</h2>

</div>

<div class="row g-4">

<?php foreach($feedbacks as $feedback){ ?>

<div class="col-lg-4">

<div class="custom-card text-center h-100">

<h5>

<?php echo $feedback['customer_name']; ?>

</h5>

<p class="text-muted">

<?php echo $feedback['company_name']; ?>

</p>

<div class="mb-3">

<?php

for($i=1;$i<=$feedback['rating'];$i++){

echo "⭐";

}

?>

</div>

<p>

<?php echo $feedback['message']; ?>

</p>

</div>

</div>

<?php } ?>

</div>

</div>

</section>

<!-- EVENTS -->

<section class="section-padding">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">

Upcoming Events

</h2>

</div>

<div class="row g-4">

<?php foreach($events as $event){ ?>

<div class="col-lg-4">

<div class="custom-card overflow-hidden">

<img src="assets/uploads/events/<?php echo $event['image']; ?>"
     class="event-image w-100">

<div class="p-4">

<h4>

<?php echo $event['title']; ?>

</h4>

<p>

<?php echo $event['description']; ?>

</p>

<span class="badge bg-primary">

<?php

echo date(

'd M Y',

strtotime($event['event_date'])

);

?>

</span>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</section>

<!-- CONTACT CTA -->

<section class="section-padding bg-light">

<div class="container text-center">

<h2 class="section-title">

Ready To Start Your Project?

</h2>

<p class="section-subtitle">

Contact us today and discuss your software requirements.

</p>

<a href="pages/contact.php"
   class="btn btn-primary btn-lg mt-3">

Contact Us

</a>

</div>

</section>


<?php include 'includes/footer.php'; ?>