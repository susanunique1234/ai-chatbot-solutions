
<?php

include '../config/database.php';

include '../includes/header.php';

include '../includes/navbar.php';

?>

<section class="page-banner">

    <div class="container text-center text-white">

        <h1>Blog</h1>

        <p>

            Latest AI and technology articles

        </p>

    </div>

</section>

<section class="section-padding bg-light">

    <div class="container">

        <div class="row g-4">

            <?php

            $query = "SELECT * FROM blogs
                      ORDER BY id DESC";

            $stmt = $conn->prepare($query);

            $stmt->execute();

            $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($blogs as $blog){

            ?>

            <div class="col-lg-4 col-md-6">

                <div class="custom-card overflow-hidden h-100">

                    <img src="../assets/uploads/blogs/<?php echo $blog['image']; ?>"
                         class="img-fluid project-image w-100">

                    <div class="pt-4">

                        <h4>

                            <?php echo $blog['title']; ?>

                        </h4>

                        <p>

                            <?php echo substr(
                                $blog['description'],
                                0,
                                150
                            ); ?>...

                        </p>

                    </div>

                </div>

            </div>

            <?php } ?>

        </div>

    </div>

</section>


<?php include '../includes/footer.php'; ?>

