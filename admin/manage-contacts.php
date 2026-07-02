<?php

session_start();

include '../config/database.php';

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");

    exit();

}

/*
DELETE CONTACT
*/

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $query = "

    DELETE FROM contact_messages

    WHERE id=:id

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':id'=>$id

    ]);

}

/*
FETCH CONTACTS
*/

$query = "

SELECT *

FROM contact_messages

ORDER BY created_at DESC

";

$stmt = $conn->prepare($query);

$stmt->execute();

$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';

?>

<section class="admin-section">

<div class="container">

<h2 class="mb-5">

Customer Inquiries

</h2>

<div class="admin-card">

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Phone</th>

<th>Company</th>

<th>Country</th>

<th>Job Title</th>

<th>Job Details</th>

<th>Date</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php foreach($contacts as $row){ ?>

<tr>

<td>

<?php echo $row['id']; ?>

</td>

<td>

<?php echo $row['name']; ?>

</td>

<td>

<?php echo $row['email']; ?>

</td>

<td>

<?php echo $row['phone']; ?>

</td>

<td>

<?php echo $row['company_name']; ?>

</td>

<td>

<?php echo $row['country']; ?>

</td>

<td>

<?php echo $row['job_title']; ?>

</td>

<td style="max-width:300px;">

<?php echo $row['job_details']; ?>

</td>

<td>

<?php echo date(

'd M Y',

strtotime($row['created_at'])

); ?>

</td>

<td>

<a href="?delete=<?php echo $row['id']; ?>"
   class="btn btn-danger btn-sm"
   onclick="return confirm('Delete Inquiry?')">

Delete

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</section>

<?php include '../includes/footer.php'; ?>