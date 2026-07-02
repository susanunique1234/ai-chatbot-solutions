<?php

include '../config/database.php';

include '../includes/header.php';

include '../includes/navbar.php';

?>

<section class="page-banner">

    <div class="container text-center text-white">

        <h1>Client Testimonials</h1>

        <p>

            What our customers say about us

        </p>

    </div>

</section>

<section class="section-padding bg-light">

    <div class="container">

        <div class="row g-4">

        <?php

        $query = "

        SELECT *

        FROM feedback

        ORDER BY id DESC

        ";

        $stmt = $conn->prepare($query);

        $stmt->execute();

        $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($feedbacks as $row){

        ?>

        <div class="col-lg-4">

            <div class="custom-card testimonial-card h-100">

                <div class="testimonial-stars">

                    <?php

                    for($i=1;$i<=$row['rating'];$i++){

                        echo "⭐";

                    }

                    ?>

                </div>

                <p class="testimonial-text mt-3">

                    "<?php echo $row['message']; ?>"

                </p>

                <hr>

                <h5>

                    <?php echo $row['customer_name']; ?>

                </h5>

                <small>

                    <?php echo $row['company_name']; ?>

                </small>

            </div>

        </div>

        <?php } ?>

        </div>

    </div>

</section>


<?php include '../includes/footer.php'; ?>