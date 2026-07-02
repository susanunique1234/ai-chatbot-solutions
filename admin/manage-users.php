<?php

session_start();

include '../config/database.php';

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");

    exit();

}

/*
ADD USER
*/

if(isset($_POST['add_user'])){

    $name = trim($_POST['name']);

    $email = trim($_POST['email']);

    $password = password_hash(

        $_POST['password'],

        PASSWORD_DEFAULT

    );

    $role = trim($_POST['role']);

    $query = "

    INSERT INTO users(

        name,
        email,
        password,
        role

    )

    VALUES(

        :name,
        :email,
        :password,
        :role

    )

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':name'=>$name,
        ':email'=>$email,
        ':password'=>$password,
        ':role'=>$role

    ]);

}

/*
UPDATE USER
*/

if(isset($_POST['update_user'])){

    $id = $_POST['id'];

    $name = trim($_POST['name']);

    $email = trim($_POST['email']);

    $role = trim($_POST['role']);

    if(!empty($_POST['password'])){

        $password = password_hash(

            $_POST['password'],

            PASSWORD_DEFAULT

        );

        $query = "

        UPDATE users

        SET

        name=:name,
        email=:email,
        password=:password,
        role=:role

        WHERE id=:id

        ";

        $stmt = $conn->prepare($query);

        $stmt->execute([

            ':name'=>$name,
            ':email'=>$email,
            ':password'=>$password,
            ':role'=>$role,
            ':id'=>$id

        ]);

    }else{

        $query = "

        UPDATE users

        SET

        name=:name,
        email=:email,
        role=:role

        WHERE id=:id

        ";

        $stmt = $conn->prepare($query);

        $stmt->execute([

            ':name'=>$name,
            ':email'=>$email,
            ':role'=>$role,
            ':id'=>$id

        ]);

    }

}

/*
DELETE USER
*/

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $query = "

    DELETE FROM users

    WHERE id=:id

    ";

    $stmt = $conn->prepare($query);

    $stmt->execute([

        ':id'=>$id

    ]);

}

/*
FETCH USERS
*/

$query = "

SELECT *

FROM users

ORDER BY id DESC

";

$stmt = $conn->prepare($query);

$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';

?>

<section class="admin-section">

<div class="container">

<h2 class="mb-5">

Manage Users

</h2>

<!-- ADD USER -->

<div class="admin-card mb-5">

<h4 class="mb-4">

Add New User

</h4>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<input type="text"
       name="name"
       class="form-control"
       placeholder="Full Name"
       required>

</div>

<div class="col-md-6 mb-3">

<input type="email"
       name="email"
       class="form-control"
       placeholder="Email Address"
       required>

</div>

<div class="col-md-6 mb-3">

<input type="password"
       name="password"
       class="form-control"
       placeholder="Password"
       required>

</div>

<div class="col-md-6 mb-3">

<select name="role"
        class="form-control">

<option value="admin">

Admin

</option>

<option value="staff">

Staff

</option>

</select>

</div>

</div>

<button type="submit"
        name="add_user"
        class="btn btn-primary">

Add User

</button>

</form>

</div>

<!-- USER LIST -->

<div class="row">

<?php foreach($users as $user){ ?>

<div class="col-lg-6 mb-4">

<div class="admin-card">

<form method="POST">

<input type="hidden"
       name="id"
       value="<?php echo $user['id']; ?>">

<div class="mb-3">

<label>

Full Name

</label>

<input type="text"
       name="name"
       value="<?php echo $user['name']; ?>"
       class="form-control">

</div>

<div class="mb-3">

<label>

Email

</label>

<input type="email"
       name="email"
       value="<?php echo $user['email']; ?>"
       class="form-control">

</div>

<div class="mb-3">

<label>

New Password
(Optional)

</label>

<input type="password"
       name="password"
       class="form-control">

</div>

<div class="mb-3">

<label>

Role

</label>

<select name="role"
        class="form-control">

<option value="admin"

<?php

if($user['role']=="admin")
echo "selected";

?>

>

Admin

</option>

<option value="staff"

<?php

if($user['role']=="staff")
echo "selected";

?>

>

Staff

</option>

</select>

</div>

<div class="d-flex gap-2">

<button type="submit"
        name="update_user"
        class="btn btn-success w-100">

Update

</button>

<a href="?delete=<?php echo $user['id']; ?>"
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