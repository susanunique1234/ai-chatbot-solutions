<?php

session_start();

include '../config/database.php';

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");

    exit();

}

/*
ADD IMAGE
*/

if(isset($_POST['add_image'])){

    $title = trim($_POST['title']);

    $image = $_FILES['image']['name'];

    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file(

        $tmp,

        "../assets/uploads/gallery/" . $image

    );

    $query = "

    INSERT INTO gallery(

        title,
        image

    )

    VALUES(

        :title,
        :image

    )

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':title'=>$title,
        ':image'=>$image

    ]);

}

/*
UPDATE
*/

if(isset($_POST['update_image'])){

    $id = $_POST['id'];

    $title = trim($_POST['title']);

    $old_image = $_POST['old_image'];

    if($_FILES['image']['name']!=""){

        $image = $_FILES['image']['name'];

        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file(

            $tmp,

            "../assets/uploads/gallery/" . $image

        );

    }

    else{

        $image = $old_image;

    }

    $query = "

    UPDATE gallery

    SET

    title=:title,
    image=:image

    WHERE id=:id

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':title'=>$title,
        ':image'=>$image,
        ':id'=>$id

    ]);

}

/*
DELETE
*/

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $query = "

    DELETE FROM gallery

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

FROM gallery

ORDER BY id DESC

";

$stmt = $conn->prepare($query);

$stmt->execute();

$gallery = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';

?>

<section class="admin-section">

<div class="container">

<h2 class="mb-5">

Manage Gallery

</h2>

<div class="admin-card mb-5">

<form method="POST"
      enctype="multipart/form-data">

<input type="text"
       name="title"
       class="form-control mb-3"
       placeholder="Image Title"
       required>

<input type="file"
       name="image"
       class="form-control mb-3"
       required>

<button type="submit"
        name="add_image"
        class="btn btn-primary">

Upload Image

</button>

</form>

</div>

<div class="row">

<?php foreach($gallery as $row){ ?>

<div class="col-lg-4 mb-4">

<div class="admin-card">

<img src="../assets/uploads/gallery/<?php echo $row['image']; ?>"
     class="img-fluid rounded mb-3">

<form method="POST"
      enctype="multipart/form-data">

<input type="hidden"
       name="id"
       value="<?php echo $row['id']; ?>">

<input type="hidden"
       name="old_image"
       value="<?php echo $row['image']; ?>">

<input type="text"
       name="title"
       value="<?php echo $row['title']; ?>"
       class="form-control mb-3">

<input type="file"
       name="image"
       class="form-control mb-3">

<div class="d-flex gap-2">

<button type="submit"
        name="update_image"
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