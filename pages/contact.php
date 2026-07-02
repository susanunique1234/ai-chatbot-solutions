<?php

include '../config/database.php';

$message = "";

if(isset($_POST['send_message'])){

    $name = trim($_POST['name']);

    $email = trim($_POST['email']);

    $phone = trim($_POST['phone']);

    $company_name = trim($_POST['company_name']);

    $country = trim($_POST['country']);

    $job_title = trim($_POST['job_title']);

    $job_details = trim($_POST['job_details']);

    $query = "

    INSERT INTO contact_messages(

        name,
        email,
        phone,
        company_name,
        country,
        job_title,
        job_details

    )

    VALUES(

        :name,
        :email,
        :phone,
        :company_name,
        :country,
        :job_title,
        :job_details

    )

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':name'=>$name,
        ':email'=>$email,
        ':phone'=>$phone,
        ':company_name'=>$company_name,
        ':country'=>$country,
        ':job_title'=>$job_title,
        ':job_details'=>$job_details

    ]);

    $message = "Thank you! Your inquiry has been submitted successfully.";

}

include '../includes/header.php';

include '../includes/navbar.php';

?>

<section class="page-banner">

    <div class="container text-center text-white">

        <h1>

            Contact Us

        </h1>

        <p>

            Tell us about your project requirements

        </p>

    </div>

</section>

<section class="section-padding">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="custom-card">

<h2 class="section-title mb-4">

Get In Touch

</h2>

<?php if($message != ""){ ?>

<div class="alert alert-success">

<?php echo $message; ?>

</div>

<?php } ?>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Full Name

</label>

<input type="text"
       name="name"
       class="form-control"
       required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Email Address

</label>

<input type="email"
       name="email"
       class="form-control"
       required>

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Phone Number

</label>

<input type="text"
       name="phone"
       class="form-control"
       required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Company Name

</label>

<input type="text"
       name="company_name"
       class="form-control">

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Country

</label>

<input type="text"
       name="country"
       class="form-control">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Job Title

</label>

<input type="text"
       name="job_title"
       class="form-control">

</div>

</div>

<div class="mb-4">

<label class="form-label">

Job Details

</label>

<textarea name="job_details"
          rows="6"
          class="form-control"
          required></textarea>

</div>

<button type="submit"
        name="send_message"
        class="btn btn-primary btn-lg">

Submit Inquiry

</button>

</form>

</div>

</div>

</div>

</div>

</section>


<?php include '../includes/footer.php'; ?>