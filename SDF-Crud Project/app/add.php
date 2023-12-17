<?php
session_start();

if(isset($_POST['title'])){
    require '../db_conn.php';

    $user_id = $_SESSION['id'];
    $title = $_POST['title'];

    if(empty($title)){
        header("Location: ../todo.php?mess=error");
    }else {
        $stmt = $conn->prepare("INSERT INTO todo_list(title,user_id) VALUE(?,?)");
        $res = $stmt->execute([$title,$user_id]);

        if($res){
            header("Location: ../todo.php?mess=success"); 
        }else {
            header("Location: ../todo.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../todo.php?mess=error");
}