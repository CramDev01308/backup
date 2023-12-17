<?php

require 'function.php';

if (!isset($_SESSION["id"])) {
    header("Location: reglog.php");
    exit;
}

$user_id = $_SESSION["id"];
$userProfile = new UserManager(); // Use the UserManager class for user-related operations

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $userProfile->updateUser($user_id, $username, $email);
}

$row = $userProfile->getUserInfo($user_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="icon" href="img/Todo.png" type="image/x-icon">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #34495e;
}

.header {
    background-color: white;
    color: white;
    padding: 10px;
}

.header h2 {
    margin: 0;
}

.header a {
    color: white;
    text-decoration: none;
    padding: 5px 10px;
    border: 1px solid black;
    border-radius: 4px;
}

.header a:hover {
    background-color: lightblue;
    color: red;
}

.container {
    width: 400px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 6px;
}

.container h2 {
    margin-top: 0;
    font-size: 24px;
    color: #333;
}

input[type="text"],
input[type="email"],
input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #333;
    color: white;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #555;
}
    </style>
</head>
<body>
    <div class="header">
        <h1 style="color: black;">To-Do List</h1>
        <a href="todo.php" style="text-decoration: none; color: black;">Back</a>
    </div>

    <div class="container">
        <h2>Edit Profile</h2>
        <form method="post" action="">
            <input type="text" name="username" value="<?=$row["username"]?>"><br>
            <input type="email" name="email" value="<?=$row["email"]?>"><br>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>