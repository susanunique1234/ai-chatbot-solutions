<?php

include 'config/database.php';

$password = password_hash(

    'admin123',

    PASSWORD_DEFAULT

);

$query = "

INSERT INTO users(

    full_name,
    email,
    password,
    role

)

VALUES(

    :full_name,
    :email,
    :password,
    :role

)

";

$stmt = $conn->prepare($query);

$stmt->execute([

    ':full_name' => 'Administrator',

    ':email' => 'admin@aisolutions.com',

    ':password' => $password,

    ':role' => 'admin'

]);

echo "Admin Created Successfully";

?>