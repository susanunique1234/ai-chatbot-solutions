<?php

session_start();

include '../config/database.php';

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");

    exit();

}

/*
ADD BLOG
*/

if(isset($_POST['add_blog'])){

    $title = trim($_POST['title']);

    $description = trim($_POST['description']);

    $image = $_FILES['image']['name'];

    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file(

        $tmp,

        "../assets/uploads/blogs/" . $image

    );

    $query = "

    INSERT INTO blogs(

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
UPDATE BLOG
*/

if(isset($_POST['update_blog'])){

    $id = $_POST['id'];

    $title = trim($_POST['title']);

    $description = trim($_POST['description']);

    $old_image = $_POST['old_image'];

    if($_FILES['image']['name'] != ""){

        $image = $_FILES['image']['name'];

        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file(

            $tmp,

            "../assets/uploads/blogs/" . $image

        );

    }else{

        $image = $old_image;

    }

    $query = "

    UPDATE blogs

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
DELETE BLOG
*/

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $query = "

    DELETE FROM blogs

    WHERE id=:id

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':id'=>$id

    ]);

}

/*
FETCH BLOGS
*/

$query = "

SELECT *

FROM blogs

ORDER BY id DESC

";

$stmt = $conn->prepare($query);

$stmt->execute();

$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';

?>

<section class="admin-section">

<div class="container">

<h2 class="mb-5">

Manage Blogs

</h2>

<!-- ADD BLOG -->

<div class="admin-card mb-5">

<h4 class="mb-4">

Add New Blog

</h4>

<form method="POST"
      enctype="multipart/form-data">

<div class="mb-3">

<input type="text"
       name="title"
       class="form-control"
       placeholder="Blog Title"
       required>

</div>

<div class="mb-3">

<textarea name="description"
          rows="5"
          class="form-control"
          placeholder="Blog Description"
          required></textarea>

</div>

<div class="mb-3">

<input type="file"
       name="image"
       class="form-control"
       required>

</div>

<button type="submit"
        name="add_blog"
        class="btn btn-primary">

Add Blog

</button>

</form>

</div>

<!-- BLOG LIST -->

<div class="row">

<?php foreach($blogs as $blog){ ?>

<div class="col-lg-6 mb-4">

<div class="admin-card">

<img src="../assets/uploads/blogs/<?php echo $blog['image']; ?>"
     class="service-image mb-4">

<form method="POST"
      enctype="multipart/form-data">

<input type="hidden"
       name="id"
       value="<?php echo $blog['id']; ?>">

<input type="hidden"
       name="old_image"
       value="<?php echo $blog['image']; ?>">

<div class="mb-3">

<label>

Blog Title

</label>

<input type="text"
       name="title"
       value="<?php echo $blog['title']; ?>"
       class="form-control">

</div>

<div class="mb-3">

<label>

Description

</label>

<textarea name="description"
          rows="5"
          class="form-control"><?php echo $blog['description']; ?></textarea>

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
        name="update_blog"
        class="btn btn-success w-100">

Update

</button>

<a href="?delete=<?php echo $blog['id']; ?>"
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