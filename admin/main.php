<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>ADMIN</title>

  <link rel='stylesheet' type='text/css' href='../css/admin1.css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://www.markuptag.com/bootstrap/5/css/bootstrap.min.css" />
  <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
</head>

<body>
  <?php
  session_start();
  include_once '../config/database.php';
  include_once '../models/story.php';
  include_once '../models/category.php';
  include_once '../admin/admin.php';
  $database = new Database();
  $db = $database->getConnection();
  $admin = new Admin($db);
  $story = new Story($db);
  $category = new Category($db);

  if (!isset($_GET['pa']))
    $_GET['pa'] = 1;
  if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = -1;
  }

  if (isset($_POST['login'])) {
    $acc = false;
    $em = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $admin->ConnectAccount();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      if ($email === $em && $pass === $password) {
        $acc = true;
        $_SESSION['id'] = $id;
      }
    }

    if ($acc == false) {
      header('location:index.php?acc=false');
      return;
    }
  }

  if ($_SESSION['id'] == -1) {
    header('location:index.php');
  }

  $stmt = $admin->Account($_SESSION['id']);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  extract($row);
  ?>
  <header>


    <div class="head_left" style='float:right;'>

      <a href='information.php?id=<?= $_SESSION['id'] ?>'><img src="../images/<?= $avatar ?>" alt="Logo" style="width:40px;" class="rounded-pill"></a>

      <i><?= $name ?></i>
      <a href="logout.php" style="margin-left: 10px;margin-top:10px; background:black;border-radius:10px;" class='btn btn-primary left-margin'><i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
  </header>

  <?php
  $page = isset($_GET['pa']) ? $_GET['pa'] : 1;
  $records_per_page = 5;
  $total_rows = 60;
  $from_record_num = ($records_per_page * $page) - $records_per_page;
  $search = "";
  if (isset($_POST['ok'])) {
    $search = $_POST['search'];
    if ($search != "") {
      $query = "select * from list where name like '%$search%'  LIMIT {$from_record_num},{$records_per_page}";
      $stmt = $story->conn->prepare($query);
      $stmt->execute();
    }
  } else {
    $stmt = $story->readAll($from_record_num, $records_per_page);
  }

  $num = $stmt->rowCount();

  echo "<div class='main'>
       
        <a href='add.php' class='btn btn-success left-margin'style='float:right;margin-right:1%; margin-bottom:1%;border-radius:10px;'>Creat</a>";
  if ($num > 0) {

    echo "<table class='table table-dark table-bordered' style='background-color :black;opacity: 0.9;>
            <thead style='text-align:center;'>
              <tr style='text-align:center;font-size:17px; color:red;'>
                <th style='background-color:rgb(4, 239, 239);'>Name</th>
                <th style='background-color:rgb(4, 239, 239);'>Images</th>
                <th style='background-color:rgb(4, 239, 239);'>Category</th>
                <th style='background-color:rgb(4, 239, 239);'>REGION</th>
                <th style='background-color:rgb(4, 239, 239);'>Action</th>
              </tr>
            </thead>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      echo "<tr>
                <td style='text-align:center;'><b>{$name}</b></td>
                <td style='text-align:center;'><img src='../images/{$images}'style='width:50px ;height:50px'>
                <td style='text-align:center;'>";
      $category->id = $category_id;
      $category->readName();
      echo "<b>$category->name</b>";
      echo "</td>
                <td style='text-align:center;'><b>{$nation}</b></td>
                <td style='text-align:center;'>
                  
                  <a href='update.php?id={$id}' class='btn btn-warning left-margin'style='background: green; color:#fff;border-radius:10px;'>Edit</a>
                  <button class='btn btn-danger left-margin' onclick='delete_story({$id})'style='background: darkred; color:#fff;border-radius:10px;'>Delete</button></td>
             </tr>";
    }
  } else {
    echo "<div class='alert alert-info'>No result is found.</div>";
  }
  echo "</table>
    </div>";


  echo "  <footer>";

  echo "<ul class='pagination' style='margin-left:40%;'>";
  $page_url = "main.php";

  if ($page > 1) {
    echo "<li><a href='{$page_url}?pa=1' title='Go to the first
              page.'>";
    echo "First";
    echo "</a></li>";
  }


  $total_pages = ceil($total_rows / $records_per_page);

  $range = 2;

  $initial_num = $page - $range;
  $condition_limit_num = ($page + $range) + 1;
  for ($x = $initial_num; $x < $condition_limit_num; $x++) {

    if (($x > 0) && ($x <= $total_pages)) {

      if ($x == $page) {

        echo "<li class='active'><a href=\"#\">$x <span class=\"sr-
                  only\"></span></a></li>";
      } else {
        echo "<li><a href='{$page_url}?pa=$x'>$x</a></li>";
      }
    }
  }

  if ($page < $total_pages) {
    
    
  }
  echo "</ul>";

  echo "  </footer>";


  ?>
</body>

</html>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script language="javascript">
  function delete_story(id) {
    option = confirm('Delete this category?')
    if (!option) {
      return;
    }
    $.ajax({
      url: "delete.php",
      type: "post",
      dataType: "text",
      data: {
        'id': id
      },
      success: function(result) {
        location.reload()
      }
    });
  }
</script>