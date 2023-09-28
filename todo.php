<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To Do App</title>
  <link rel="stylesheet" href="style.css">
</head>


<?php
if (!isset($_COOKIE['PHPSESSID'])) {
  header("Location: register.php");

  return;
} else {
  if (!isset($_SESSION['userId'])) {
    header("Location: register.php");

    return;
  }
}

?>

<?php

try {
  $pdo = new PDO("sqlite:database/todo.db");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $pdo->query(
    "CREATE TABLE IF NOT EXISTS tasks (taskId INTEGER PRIMARY KEY, userId INTEGER, description TEXT)"
  );
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

if (isset($_POST["add"])) {
  $id = $_SESSION['userId'];
  $value = $_POST['value'];

  try {
    $insert = $pdo->prepare(
      "INSERT INTO tasks (userId, description) VALUES (:userId, :value)"
    );
    $insert->execute([":userId" => $id, ":value" => $value]);

    header("Location: todo.php");
    return;
  } catch (PDOException $e) {
    echo "Todo creation failed: " . $e->getMessage();
  }
}


if(isset($_GET["delete"])){
  $id = $_GET['taskId'];
  $pdo->exec("DELETE from tasks Where taskId = $id");

}

$search = isset($_GET['search']) ? $_GET['search']: ""; 





$id = $_SESSION['userId'];
$tasks = $pdo->query("SELECT * FROM tasks WHERE userId = $id")->fetchAll(PDO::FETCH_ASSOC);


if($search != ""){
  $tasks = $pdo->query("SELECT * FROM tasks WHERE userId = $id AND description LIKE '%$search%'")->fetchAll(PDO::FETCH_ASSOC);
}

?>

<body>
  <div class="filter">
    <form action="./todo.php" method="GET">
    <input type="text" name="search" placeholder="search">
    <input type="submit" value="search">
    </form>
    <a href="todo.php">temizle</a>
  </div>
  <div class="container">
    <form action="./todo.php" method="post" class="todo_form">
      <h2 class="to_do_title">TO DO LIST</h2>
      <div class="todo_div">
        <input name="value" type="text" class="todo_input" placeholder="Add Content">
        <button name="add" type="submit" class="todo_button">Add</button>
      </div>
    </form>

    <div class="tasks">
    <div class="task">
        <div class="id bold">ID</div>
        <div class="description bold">Description</div>
        <div class="action bold">Action</div>
      </div>

      <?php
      
      $count = 1;
      foreach($tasks as $task){
        $id = $task['taskId'];
      ?>
      <div class="task">
        <div class="id"><?= $count ?></div>
        <div class="description"><?= $task['description'] ?></div>
        <div class="action">
          <a href=></a>
          <a href=<?="todo.php?delete=delete&taskId=$id"?>><button>Delete</button></a>
        </div>
      </div>

      <?php $count++; } ?>
    </div>
  </div>



    

</body>

</html>
