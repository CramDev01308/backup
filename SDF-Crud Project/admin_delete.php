<?php
 require_once 'function.php';

 $connection = new Connection();
 $conn = $connection->conn;

   if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM todo_list WHERE user_id=$id"; // Delete tasks associated with the user
    $conn->query($sql);
    $sql = "DELETE FROM users WHERE id=$id"; // Delete the user

    if ($conn->query($sql) === TRUE) {
      header('location:admin.php');
    }
}
?>