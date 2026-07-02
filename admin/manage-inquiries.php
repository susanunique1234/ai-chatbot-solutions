<?php

session_start();

include '../config/database.php';

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");

    exit();

}

/*
DELETE INQUIRY
*/

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $query = "

    DELETE FROM contact_messages

    WHERE id = :id

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':id' => $id

    ]);

}

/*
FETCH INQUIRIES
*/

$query = "

SELECT *

FROM contact_messages

ORDER BY id DESC

";

$stmt = $conn->prepare($query);

$stmt->execute();

$inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';

?>

<style>

.admin-section{

    min-height:100vh;

    background:#f8fafc;

    padding:120px 0 60px;

}

.admin-card{

    background:white;

    border-radius:20px;

    padding:30px;

    box-shadow:
    0 10px 30px rgba(0,0,0,0.08);

}

.table th{

    background:#0f172a;

    color:white;

}

</style>

<section class="admin-section">

<div class="container">

<div class="admin-card">

<h2 class="mb-4">

Customer Inquiries

</h2>

<div class="table-responsive">

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>ID</th>

<th>Full Name</th>

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

<?php foreach($inquiries as $row){ ?>

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

<td>

<?php echo $row['job_details']; ?>

</td>

<td>

<?php echo $row['created_at']; ?>

</td>

<td>

<a href="?delete=<?php echo $row['id']; ?>"
   class="btn btn-danger btn-sm">

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