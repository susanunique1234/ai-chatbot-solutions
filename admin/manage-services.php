
<?php

session_start();

include '../config/database.php';

/*
CHECK LOGIN
*/

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");

    exit();

}

$message = "";

/*
ADD SERVICE
*/

if(isset($_POST['add_service'])){

    $title = trim($_POST['title']);

    $description = trim($_POST['description']);

    $image = $_FILES['image']['name'];

    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file(

        $tmp,

        "../assets/uploads/services/" . $image

    );

    $query = "INSERT INTO services

              (title,description,image)

              VALUES

              (:title,:description,:image)";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':title' => $title,
        ':description' => $description,
        ':image' => $image

    ]);

    $message = "Service added successfully.";

}

/*
UPDATE SERVICE
*/

if(isset($_POST['update_service'])){

    $id = $_POST['id'];

    $title = trim($_POST['title']);

    $description = trim($_POST['description']);

    $old_image = $_POST['old_image'];

    /*
    CHECK IMAGE
    */

    if($_FILES['image']['name'] != ""){

        $image = $_FILES['image']['name'];

        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file(

            $tmp,

            "../assets/uploads/services/" . $image

        );

    }

    else{

        $image = $old_image;

    }

    /*
    UPDATE QUERY
    */

    $query = "UPDATE services

              SET

              title = :title,
              description = :description,
              image = :image

              WHERE id = :id";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':title' => $title,
        ':description' => $description,
        ':image' => $image,
        ':id' => $id

    ]);

    $message = "Service updated successfully.";

}

/*
DELETE SERVICE
*/

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $query = "DELETE FROM services
              WHERE id = :id";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':id' => $id

    ]);

    $message = "Service deleted successfully.";

}

/*
FETCH SERVICES
*/

$query = "SELECT * FROM services
          ORDER BY id DESC";

$stmt = $conn->prepare($query);

$stmt->execute();

$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';

?>

<section class="admin-section">

<div class="container">

<h2 class="admin-title">

Manage Services

</h2>

<?php if($message != ""){ ?>

<div class="alert alert-success mb-4">

<?php echo $message; ?>

</div>

<?php } ?>

<!-- ADD SERVICE -->

<div class="admin-card mb-5">

<h4>

Add New Service

</h4>

<form method="POST"
      enctype="multipart/form-data">

<div class="row">

<div class="col-md-6 mb-3">

<label>

Service Title

</label>

<input type="text"
       name="title"
       class="form-control"
       placeholder="Enter service title"
       required>

</div>

<div class="col-md-6 mb-3">

<label>

Upload Image

</label>

<input type="file"
       name="image"
       class="form-control"
       required>

</div>

</div>

<div class="mb-4">

<label>

Description

</label>

<textarea name="description"
          rows="5"
          class="form-control"
          placeholder="Enter service description"
          required></textarea>

</div>

<button type="submit"
        name="add_service"
        class="admin-btn">

Add Service

</button>

</form>

</div>

<!-- SERVICES -->

<div class="row">

<?php foreach($services as $row){ ?>

<div class="col-lg-6 mb-4">

<div class="admin-card">

<img src="../assets/uploads/services/<?php echo $row['image']; ?>"
     class="admin-image">

<form method="POST"
      enctype="multipart/form-data">

<input type="hidden"
       name="id"
       value="<?php echo $row['id']; ?>">

<input type="hidden"
       name="old_image"
       value="<?php echo $row['image']; ?>">

<div class="mb-3">

<label>

Service Title

</label>

<input type="text"
       name="title"
       value="<?php echo $row['title']; ?>"
       class="form-control"
       required>

</div>

<div class="mb-3">

<label>

Description

</label>

<textarea name="description"
          rows="5"
          class="form-control"
          required><?php echo $row['description']; ?></textarea>

</div>

<div class="mb-4">

<label>

Change Image

</label>

<input type="file"
       name="image"
       class="form-control">

</div>

<div class="d-flex gap-2">

<button type="submit"
        name="update_service"
        class="update-btn">

Update

</button>

<a href="?delete=<?php echo $row['id']; ?>"
   class="delete-btn"

   onclick="return confirm('Are you sure you want to delete this service?')">

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
```
