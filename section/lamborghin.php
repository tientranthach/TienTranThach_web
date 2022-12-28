<?php
  include_once './config/database.php' ;
  include_once './models/category.php' ;
  include_once './models/story.php' ;
  $database = new Database();
  $db = $database->getConnection();
  $story = new Story($db);
  $category = new Category($db);
  $page = isset($_GET['pa']) ? $_GET['pa'] : 1;
  $records_per_page = 15;
  $total_rows = 60;
  $page_title = "LAMBORGHINI ";
  $category_id = 1 ;
  $from_record_num = ($records_per_page * $page) - $records_per_page;
  $stmt = $story->category($from_record_num, $records_per_page,$category_id);
  echo "<aside class='left' style='height: 900px ;width:90%; margin-left:5%;margin-bottom:3%;margin-top:1%; '>";
  echo "<h1 style='color: #fff;text-align: center;margin-top: 30px; '>{$page_title}</h1>";
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      echo "<div class='menu_left'>";
      echo "<a href='./view/{$link}' onmouseover='this.style.color = red' onmouseout='this.style.color = blue'><img src='images/{$images}' alt=' 'style='width:210px ;height:200px; margin-left:10px; margin-top:40px;border-radius:10px; '></a>";
      echo "<h2><a href='./view/{$link}' onmouseover='this.style.color = red' onmouseout='this.style.color = blue'>{$name}</a></h2>";
      echo "</div>"; 
  }
  echo"</aside>";
?>