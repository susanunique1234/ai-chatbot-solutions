
<?php

include '../config/database.php';

include '../includes/header.php';

include '../includes/navbar.php';

?>

<section class="page-banner">

    <div class="container text-center text-white">

        <h1>Projects</h1>

        <p>

            Explore our latest software projects

        </p>

    </div>

</section>

<section class="section-padding">

    <div class="container">

        <div class="row g-4">

            <?php

            $query = "SELECT * FROM projects
                      ORDER BY id DESC";

            $stmt = $conn->prepare($query);

            $stmt->execute();

            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($projects as $project){

            ?>

            <div class="col-lg-4 col-md-6">

                <div class="custom-card overflow-hidden h-100">

                    <img src="../assets/uploads/projects/<?php echo $project['image']; ?>"
                         class="img-fluid project-image w-100">

                    <div class="pt-4">

                        <h4>

                            <?php echo $project['title']; ?>

                        </h4>

                        <p>

                            <?php echo $project['description']; ?>

                        </p>

                    </div>

                </div>

            </div>

            <?php } ?>

        </div>

    </div>

</section>


<?php include '../includes/footer.php'; ?>
```
