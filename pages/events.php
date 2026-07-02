<?php

include '../config/database.php';

include '../includes/header.php';

include '../includes/navbar.php';

$query = "

SELECT *

FROM events

ORDER BY event_date ASC

";

$stmt = $conn->prepare($query);

$stmt->execute();

$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="page-banner">

    <div class="container text-center text-white">

        <h1>

            Upcoming Events

        </h1>

        <p>

            Stay Updated With Our Latest Events

        </p>

    </div>

</section>

<section class="section-padding">

<div class="container">


<div class="row g-4">

<?php foreach($events as $event){ ?>

<div class="col-lg-4 col-md-6">

<div class="custom-card overflow-hidden h-100">

<img src="../assets/uploads/events/<?php echo $event['image']; ?>"
     class="event-image w-100"
     alt="<?php echo $event['title']; ?>">

<div class="p-4">

<span class="badge bg-primary mb-3">

<?php echo date(

'd M Y',

strtotime($event['event_date'])

); ?>

</span>

<h4>

<?php echo $event['title']; ?>

</h4>

<p>

<?php echo $event['description']; ?>

</p>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</section>


<?php include '../includes/footer.php'; ?>