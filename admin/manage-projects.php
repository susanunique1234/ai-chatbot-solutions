<?php

session_start();

include '../config/database.php';

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");

    exit();

}

/*
ADD PROJECT
*/

if(isset($_POST['add_project'])){

    $title = trim($_POST['title']);

    $description = trim($_POST['description']);

    $image = $_FILES['image']['name'];

    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file(

        $tmp,

        "../assets/uploads/projects/" . $image

    );

    $query = "

    INSERT INTO projects(

        title,
        description,
        image

    )

    VALUES(

        :title,
        :description,
        :image

    )

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':title'=>$title,
        ':description'=>$description,
        ':image'=>$image

    ]);

}

/*
UPDATE PROJECT
*/

if(isset($_POST['update_project'])){

    $id = $_POST['id'];

    $title = trim($_POST['title']);

    $description = trim($_POST['description']);

    $old_image = $_POST['old_image'];

    if($_FILES['image']['name'] != ""){

        $image = $_FILES['image']['name'];

        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file(

            $tmp,

            "../assets/uploads/projects/" . $image

        );

    }else{

        $image = $old_image;

    }

    $query = "

    UPDATE projects

    SET

    title=:title,
    description=:description,
    image=:image

    WHERE id=:id

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':title'=>$title,
        ':description'=>$description,
        ':image'=>$image,
        ':id'=>$id

    ]);

}

/*
DELETE PROJECT
*/

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $query = "

    DELETE FROM projects

    WHERE id=:id

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':id'=>$id

    ]);

}

/*
FETCH PROJECTS
*/

$query = "

SELECT *

FROM projects

ORDER BY id DESC

";

$stmt = $conn->prepare($query);

$stmt->execute();

$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';

?>

<section class="admin-section">

<div class="container">

<h2 class="mb-5">

Manage Projects

</h2>

<!-- ADD PROJECT -->

<div class="admin-card mb-5">

<h4 class="mb-4">

Add New Project

</h4>

<form method="POST"
      enctype="multipart/form-data">

<div class="mb-3">

<input type="text"
       name="title"
       class="form-control"
       placeholder="Project Title"
       required>

</div>

<div class="mb-3">

<textarea name="description"
          rows="5"
          class="form-control"
          placeholder="Project Description"
          required></textarea>

</div>

<div class="mb-3">

<input type="file"
       name="image"
       class="form-control"
       required>

</div>

<button type="submit"
        name="add_project"
        class="btn btn-primary">

Add Project

</button>

</form>

</div>

<!-- PROJECT LIST -->

<div class="row">

<?php foreach($projects as $project){ ?>

<div class="col-lg-6 mb-4">

<div class="admin-card">

<img src="../assets/uploads/projects/<?php echo $project['image']; ?>"
     class="service-image mb-4">

<form method="POST"
      enctype="multipart/form-data">

<input type="hidden"
       name="id"
       value="<?php echo $project['id']; ?>">

<input type="hidden"
       name="old_image"
       value="<?php echo $project['image']; ?>">

<div class="mb-3">

<label>

Project Title

</label>

<input type="text"
       name="title"
       value="<?php echo $project['title']; ?>"
       class="form-control">

</div>

<div class="mb-3">

<label>

Description

</label>

<textarea name="description"
          rows="5"
          class="form-control"><?php echo $project['description']; ?></textarea>

</div>

<div class="mb-3">

<label>

Change Image

</label>

<input type="file"
       name="image"
       class="form-control">

</div>

<div class="d-flex gap-2">

<button type="submit"
        name="update_project"
        class="btn btn-success w-100">

Update

</button>

<a href="?delete=<?php echo $project['id']; ?>"
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