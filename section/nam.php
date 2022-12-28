<?php
  include_once './config/database.php' ;
  include_once './models/category.php' ;
  include_once './models/story.php' ;
  $database = new Database();
  $db = $database->getConnection();
  $story = new Story($db);
  $category = new Category($db);
  $page = isset($_GET['pa']) ? $_GET['pa'] : 1;
  $page_title = "Miền Nam";
  $records_per_page = 15;
  $total_rows = 40;
  
  $from_record_num = ($records_per_page * $page) - $records_per_page;
  $nation = "nam" ;
  $stmt = $story->nation($from_record_num, $records_per_page,$nation);
  $num = $stmt->rowCount();
  echo "<aside class='left' style='height: 900px ;width:90%; margin-left:5%;margin-bottom:3%;margin-top:1%;'>";
  echo "<h1 style='color: #fff;text-align: center;margin-top: 30px;'>{$page_title}</h1>";
  if($num>0){
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        echo "<div class='menu_left'>";
        echo "<a href='./view/{$link}' onmouseover='this.style.color = red' onmouseout='this.style.color = blue'><img src='images/{$images}' alt=' 'style='width:210px ;height:200px; margin-left:10px; margin-top:40px;border-radius:10px;'></a>";
      echo "<h2><a href='./view/{$link}' onmouseover='this.style.color = red' onmouseout='this.style.color = blue'>{$name}</a></h2>";
        echo "</div>";
    }
  }
  else{
    echo "<div class='alert alert-info'>No stories found.</div>";
  }
  
  echo"</aside>";
?>