<?php

session_start();

include '../config/database.php';

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");

    exit();

}

/*
ADD FEEDBACK
*/

if(isset($_POST['add_feedback'])){

    $customer_name = trim($_POST['customer_name']);

    $company_name = trim($_POST['company_name']);

    $message = trim($_POST['message']);

    $rating = $_POST['rating'];

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
        ':message'=>$message,
        ':rating'=>$rating

    ]);

}

/*
UPDATE
*/

if(isset($_POST['update_feedback'])){

    $id = $_POST['id'];

    $customer_name = trim($_POST['customer_name']);

    $company_name = trim($_POST['company_name']);

    $message = trim($_POST['message']);

    $rating = $_POST['rating'];

    $query = "

    UPDATE feedback

    SET

    customer_name=:customer_name,
    company_name=:company_name,
    message=:message,
    rating=:rating

    WHERE id=:id

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':customer_name'=>$customer_name,
        ':company_name'=>$company_name,
        ':message'=>$message,
        ':rating'=>$rating,
        ':id'=>$id

    ]);

}

/*
DELETE
*/

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $query = "

    DELETE FROM feedback

    WHERE id=:id

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':id'=>$id

    ]);

}

/*
FETCH
*/

$query = "

SELECT *

FROM feedback

ORDER BY id DESC

";

$stmt = $conn->prepare($query);

$stmt->execute();

$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';

?>

<section class="admin-section">

<div class="container">

<h2 class="mb-5">

Manage Feedback

</h2>

<div class="admin-card mb-5">

<form method="POST">

<input type="text"
       name="customer_name"
       class="form-control mb-3"
       placeholder="Customer Name"
       required>

<input type="text"
       name="company_name"
       class="form-control mb-3"
       placeholder="Company Name">

<textarea name="message"
          rows="5"
          class="form-control mb-3"
          placeholder="Feedback Message"
          required></textarea>

<select name="rating"
        class="form-control mb-3"
        required>

<option value="5">★★★★★</option>
<option value="4">★★★★</option>
<option value="3">★★★</option>
<option value="2">★★</option>
<option value="1">★</option>

</select>

<button type="submit"
        name="add_feedback"
        class="btn btn-primary">

Add Feedback

</button>

</form>

</div>

<div class="row">

<?php foreach($feedbacks as $row){ ?>

<div class="col-lg-6 mb-4">

<div class="admin-card">

<form method="POST">

<input type="hidden"
       name="id"
       value="<?php echo $row['id']; ?>">

<input type="text"
       name="customer_name"
       value="<?php echo $row['customer_name']; ?>"
       class="form-control mb-3">

<input type="text"
       name="company_name"
       value="<?php echo $row['company_name']; ?>"
       class="form-control mb-3">

<textarea name="message"
          rows="4"
          class="form-control mb-3"><?php echo $row['message']; ?></textarea>

<select name="rating"
        class="form-control mb-3">

<option value="5" <?php if($row['rating']==5) echo "selected"; ?>>
★★★★★
</option>

<option value="4" <?php if($row['rating']==4) echo "selected"; ?>>
★★★★
</option>

<option value="3" <?php if($row['rating']==3) echo "selected"; ?>>
★★★
</option>

<option value="2" <?php if($row['rating']==2) echo "selected"; ?>>
★★
</option>

<option value="1" <?php if($row['rating']==1) echo "selected"; ?>>
★
</option>

</select>

<div class="d-flex gap-2">

<button type="submit"
        name="update_feedback"
        class="btn btn-success w-100">

Update

</button>

<a href="?delete=<?php echo $row['id']; ?>"
   class="btn btn-danger w-100">

Delete

</a>

</div>

</form>

</div>

</div>

<?php } ?>

</div>

</div>

</section>

<?php include '../includes/footer.php'; ?>