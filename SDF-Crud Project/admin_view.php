<?php 

 require_once 'function.php';
// ...
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null; // Check if $_SESSION['id'] is set
// ...
 $connection = new Connection();
 $conn = $connection->conn;

 $users = $conn->query("SELECT * FROM todo_list WHERE user_id = $user_id ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/Todo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>User Tasks</title>
</head>
<body>
<header>
      <a href="admin.php">Back</a>
</header>
<br>
  <div class="container py-5 h-100">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="text-center">ID</th>
          <th class="text-center">Title</th>
          <th class="text-center">Date and Time</th>
          <th class="text-center">Checked</th>
          <th class="text-center">User Id</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while($user = $users->fetch_assoc()): ?>
        <tr>
          <td class="text-center"><?=$user['id']?></td>
          <td class="text-center"><?=$user['title']?></td>
          <td class="text-center"><?=$user['date_time']?></td>
          <td class="text-center"><?=$user['checked']?></td>
          <td class="text-center"><?=$user['user_id']?></td>
          <td class="d-flex justify-content-center"><a href="admin_edit.php?id=<?=$user['id']?>" class="btn btn-primary me-2">Edit</a><a href="admin_delete.php?id=<?=$user['id']?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php endwhile;?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>