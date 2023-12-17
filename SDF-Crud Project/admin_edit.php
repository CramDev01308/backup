<?php
require_once 'function.php';

$connection = new Connection();
$conn = $connection->conn;

if(isset($_GET['id'])){
  $taskId = $_GET['id']; 
  $sql = "SELECT * from todo_list WHERE id=$taskId ";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $task = $result->fetch_assoc();
  } else {
      echo "No task found with this ID";
      exit();
  }

  if(isset($_POST['btn-edit'])){ 
      if(isset($_POST['newTask'])){
          $newtask = $_POST['newTask'];
          $sql = "UPDATE todo_list SET title='$newtask' WHERE id=$taskId";
          if ($conn->query($sql) === TRUE) {
              if ($conn->affected_rows > 0) {
                header("location:admin.php");
              } else {
                echo "No rows updated.";
              }
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }
      }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="img/Todo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<title>Edit</title>
<body style="background: #34495e;">
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 col-xl-7">
        <div class="card rounded-3">
          <div class="card-body p-4">
            <div class="container">
           <form method="post">
              <div class="mb-4 text-center" >
               <label for="" class="label-form fs-2">Edit Your Task</label>
               <input type="text" class="form-control" name="newTask" placeholder="<?=$task['title']?>" required>
              </div>
              <div class="mb-3 text-center ">
               <a href="todo.php" class="btn btn-danger">Exit</a>
               <button name="btn-edit" type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>