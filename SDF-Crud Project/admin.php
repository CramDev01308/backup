<?php 
 require_once 'function.php';

 $connection = new Connection();
 $conn = $connection->conn;

 $users = $conn->query("SELECT * FROM users ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="img/Todo.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Admin</title>
</head>

<body>
<header>
      <a href="logout.php"> Admin Logout</a>
</header>
<br>
  <div class="container py-5 h-100">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="text-center">ID</th>
          <th class="text-center">Username</th>
          <th class="text-center">Email</th>
          <th class="text-center">Password</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while($user = $users->fetch_assoc()): ?>
        <tr>
          <td class="text-center"><?=$user['id']?></td>
          <td class="text-center"><?=$user['username']?></td>
          <td class="text-center"><?=$user['email']?></td>
          <td class="text-center"><?=$user['password']?></td>
          <td class="d-flex justify-content-center"><a href="admin_view.php?id=<?=$user['id']?>" class="btn btn-primary me-2">View</a><a href="admin_delete.php?id=<?=$user['id']?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php endwhile;?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>