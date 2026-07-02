<?php

session_start();

include '../config/database.php';

$error = "";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);

    $password = trim($_POST['password']);

    if(empty($email) || empty($password)){

        $error = "Please fill all fields.";

    }else{

        $query = "

        SELECT *

        FROM users

        WHERE email = :email

        LIMIT 1

        ";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':email',$email);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user){

            if(password_verify(

                $password,

                $user['password']

            )){

                $_SESSION['admin_id'] = $user['id'];

                $_SESSION['admin_name'] = $user['name'];

                $_SESSION['admin_email'] = $user['email'];

                $_SESSION['admin_role'] = $user['role'];

                header(

                    "Location: dashboard.php"

                );

                exit();

            }else{

                $error = "Invalid Password.";

            }

        }else{

            $error = "Invalid Email.";

        }

    }

}

include '../includes/header.php';

?>

<section class="login-section">

<div class="login-card">

<div class="text-center mb-4">

<h2 class="fw-bold">

Admin Login

</h2>

<p>

AI-Solutions Admin Panel

</p>

</div>

<?php if($error != ""){ ?>

<div class="alert alert-danger">

<?php echo $error; ?>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Email Address

</label>

<input type="email"
       name="email"
       class="form-control"
       required>

</div>

<div class="mb-4">

<label class="form-label">

Password

</label>

<input type="password"
       name="password"
       class="form-control"
       required>

</div>

<button type="submit"
        name="login"
        class="btn btn-primary w-100">

Login

</button>

</form>

</div>

</section>

<?php include '../includes/footer.php'; ?>