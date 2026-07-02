<?php

include '../config/database.php';

$message = "";

if(isset($_POST['submit_feedback'])){

    $customer_name = trim($_POST['customer_name']);

    $company_name = trim($_POST['company_name']);

    $rating = $_POST['rating'];

    $feedback_message = trim($_POST['message']);

    $query = "

    INSERT INTO feedback(

        customer_name,
        company_name,
        message,
        rating

    )

    VALUES(

        :customer_name,
        :company_name,
        :message,
        :rating

    )

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':customer_name'=>$customer_name,
        ':company_name'=>$company_name,
        ':message'=>$feedback_message,
        ':rating'=>$rating

    ]);

    $message = "Thank you for your feedback.";

}

include '../includes/header.php';

include '../includes/navbar.php';

?>

<section class="page-banner">

    <div class="container text-center text-white">

        <h1>Customer Feedback</h1>

        <p>

            Share your experience with us

        </p>

    </div>

</section>

<section class="section-padding">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="custom-card">

                    <?php if($message!=""){ ?>

                    <div class="alert alert-success">

                        <?php echo $message; ?>

                    </div>

                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">

                                Full Name

                            </label>

                            <input type="text"
                                   name="customer_name"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Company Name

                            </label>

                            <input type="text"
                                   name="company_name"
                                   class="form-control">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Rating

                            </label>

                            <select name="rating"
                                    class="form-control"
                                    required>

                                <option value="5">

                                    ⭐⭐⭐⭐⭐ Excellent

                                </option>

                                <option value="4">

                                    ⭐⭐⭐⭐ Very Good

                                </option>

                                <option value="3">

                                    ⭐⭐⭐ Good

                                </option>

                                <option value="2">

                                    ⭐⭐ Fair

                                </option>

                                <option value="1">

                                    ⭐ Poor

                                </option>

                            </select>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Feedback

                            </label>

                            <textarea name="message"
                                      rows="6"
                                      class="form-control"
                                      required></textarea>

                        </div>

                        <button type="submit"
                                name="submit_feedback"
                                class="btn btn-primary">

                            Submit Feedback

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>


<?php include '../includes/footer.php'; ?>