<?php

include '../config/database.php';

include '../includes/header.php';

include '../includes/navbar.php';

$query = "

SELECT *

FROM gallery

ORDER BY created_at DESC

";

$stmt = $conn->prepare($query);

$stmt->execute();

$gallery = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="page-banner">

    <div class="container text-center text-white">

        <h1>

            Photo Gallery

        </h1>

        <p>

            Company Activities, Events & Promotions

        </p>

    </div>

</section>

<section class="section-padding">

<div class="container">


<div class="row g-4">

<?php foreach($gallery as $image){ ?>

<div class="col-md-4">

<div class="custom-card overflow-hidden h-100">

<img src="../assets/uploads/gallery/<?php echo $image['image']; ?>"
     class="img-fluid gallery-image w-100"
     alt="<?php echo $image['title']; ?>">

<div class="p-3">

<h5>

<?php echo $image['title']; ?>

</h5>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</section>


<?php include '../includes/footer.php'; ?>