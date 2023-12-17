<?php
session_start(); // Start a session
require 'db_conn.php';
// ...
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null; // Check if $_SESSION['id'] is set
$todos = $conn->query("SELECT * FROM todo_list WHERE user_id = $user_id ORDER BY id DESC"); // Correct the SQL query
// ...
$username = $conn->query("SELECT * FROM users WHERE id = $user_id ");
$user = $username->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-Do List</title>
    <link rel="stylesheet" href="css/todo.css">
    <link rel="icon" href="img/Todo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="container">
    <div class="header sticky">
      <h2><a href="user_profile.php" style="text-decoration: none; color: black;"><?=$user['username']?></a></h2>
      <h1 class="todo-logo">Todo-List</h1>
      <a href="logout.php" class="logout">Logout</a>
    </div>
    <div class="main-section">
       <div class="add-section">
          <form action="app/add.php" method="POST" autocomplete="off">
             <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                <input type="text" 
                     name="title" 
                     style="border-color: #ff6666"
                     placeholder="This field is required" />
              <button type="submit">Add &nbsp; <span>&#43;</span></button>

             <?php }else{ ?>
              <input type="text" 
                     name="title" 
                     placeholder="What do you need to do?" />
              <button type="submit">Add &nbsp; <span>&#43;</span></button>
             <?php } ?>
          </form>
       </div>
       <div class="show-todo-section">
            <?php if($todos->rowCount() <= 0){ ?>
                <div class="todo-item">
                    <div class="empty">
                        <img src="img/f.png" width="100%" />
                        <img src="img/Ellipsis.gif" width="80px">
                    </div>
                </div>
            <?php } ?>

            <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id']; ?>"
                          class="remove-to-do" style="margin-top: 15px; font-weight: bold; font-stretch: expanded;">x</span>
                    <?php if($todo['checked']){ ?> 
                        <input type="checkbox"
                               class="check-box"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               checked />
                        <h2 class="checked"><?php echo $todo['title'] ?></h2>
                    <?php }else { ?>
                        <input type="checkbox"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               class="check-box" />
                        <h2><?php echo $todo['title'] ?></h2>
                        <span>
                          <a href="app/edit.php?id=<?= $todo['id']?>"><i class="fa-solid fa-pen-to-square" style="color: gray;"></i></a>
                        </span>
                    <?php } ?>
                    <br>
                    <small>created: <?php echo $todo['date_time'] ?></small> 
                </div>
            <?php } ?>
       </div>
    </div>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>

    <script>
    $(document).ready(function(){
        $('.remove-to-do').click(function(){
            const id = $(this).attr('id');
            
            $.post("app/remove.php", 
                  {
                      id: id
                  },
                  (data)  => {
                     if(data){
                         $(this).parent().hide(600);
                     }
                  }
            );
        });

        $(".check-box").click(function(e){
            const id = $(this).attr('data-todo-id');
            
            $.post('app/check.php', 
                  {
                      id: id
                  },
                  (data) => {
                      if(data != 'error'){
                          const h2 = $(this).next();
                          const editIcon = $(this).siblings('span').find('i');
                          if(data === '1'){
                              h2.removeClass('checked');
                              editIcon.show();
                          }else {
                              h2.addClass('checked');
                              editIcon.hide();
                          }
                      }
                  }
            );
        });
    });
</script>
</body>
</html>