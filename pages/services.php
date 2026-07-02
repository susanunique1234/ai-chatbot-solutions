
<?php

include '../config/database.php';

include '../includes/header.php';

include '../includes/navbar.php';

?>

<section class="page-banner">

    <div class="container text-center text-white">

        <h1>Our Services</h1>

        <p>

            Professional AI and software solutions

        </p>

    </div>

</section>

<section class="section-padding bg-light">

    <div class="container">

        <div class="row g-4">

            <?php

            $query = "SELECT * FROM services
                      ORDER BY id DESC";

            $stmt = $conn->prepare($query);

            $stmt->execute();

            $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($services as $service){

            ?>

            <div class="col-lg-4 col-md-6">

                <div class="custom-card h-100">

                    <img src="../assets/uploads/services/<?php echo $service['image']; ?>"
                         class="project-image w-100 mb-4">

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


<?php include '../includes/footer.php'; ?>

