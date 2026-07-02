<?php

session_start();

include '../config/database.php';

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");

    exit();

}

/*
ADD EVENT
*/

if(isset($_POST['add_event'])){

    $title = trim($_POST['title']);

    $description = trim($_POST['description']);

    $event_date = $_POST['event_date'];

    $image = $_FILES['image']['name'];

    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file(

        $tmp,

        "../assets/uploads/events/" . $image

    );

    $query = "

    INSERT INTO events(

        title,
        description,
        event_date,
        image

    )

    VALUES(

        :title,
        :description,
        :event_date,
        :image

    )

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':title'=>$title,
        ':description'=>$description,
        ':event_date'=>$event_date,
        ':image'=>$image

    ]);

}

/*
UPDATE EVENT
*/

if(isset($_POST['update_event'])){

    $id = $_POST['id'];

    $title = trim($_POST['title']);

    $description = trim($_POST['description']);

    $event_date = $_POST['event_date'];

    $old_image = $_POST['old_image'];

    if($_FILES['image']['name']!=""){

        $image = $_FILES['image']['name'];

        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file(

            $tmp,

            "../assets/uploads/events/" . $image

        );

    }

    else{

        $image = $old_image;

    }

    $query = "

    UPDATE events

    SET

    title=:title,
    description=:description,
    event_date=:event_date,
    image=:image

    WHERE id=:id

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':title'=>$title,
        ':description'=>$description,
        ':event_date'=>$event_date,
        ':image'=>$image,
        ':id'=>$id

    ]);

}

/*
DELETE EVENT
*/

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $query = "

    DELETE FROM events

    WHERE id=:id

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':id'=>$id

    ]);

}

/*
FETCH EVENTS
*/

$query = "

SELECT *

FROM events

ORDER BY event_date ASC

";

$stmt = $conn->prepare($query);

$stmt->execute();

$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';

?>

<section class="admin-section">

<div class="container">

<h2 class="mb-5">

Manage Events

</h2>

<div class="admin-card mb-5">

<form method="POST"
      enctype="multipart/form-data">

<input type="text"
       name="title"
       class="form-control mb-3"
       placeholder="Event Title"
       required>

<textarea name="description"
          rows="5"
          class="form-control mb-3"
          placeholder="Event Description"
          required></textarea>

<input type="date"
       name="event_date"
       class="form-control mb-3"
       required>

<input type="file"
       name="image"
       class="form-control mb-3"
       required>

<button type="submit"
        name="add_event"
        class="btn btn-primary">

Add Event

</button>

</form>

</div>

<div class="row">

<?php foreach($events as $row){ ?>

<div class="col-lg-6 mb-4">

<div class="admin-card">

<img src="../assets/uploads/events/<?php echo $row['image']; ?>"
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

<textarea name="description"
          rows="4"
          class="form-control mb-3"><?php echo $row['description']; ?></textarea>

<input type="date"
       name="event_date"
       value="<?php echo $row['event_date']; ?>"
       class="form-control mb-3">

<input type="file"
       name="image"
       class="form-control mb-3">

<div class="d-flex gap-2">

<button type="submit"
        name="update_event"
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