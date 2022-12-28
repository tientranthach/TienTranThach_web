<?php
  include_once '../config/database.php' ;
  include_once '../models/story.php' ;
  include_once '../models/category.php' ;
  include_once '../admin/admin.php' ;
  $database = new Database();
  $db = $database->getConnection();
  $admin = new Admin($db);
  $story = new Story($db);
  $category = new Category($db);
 
  
  


echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Admin</title>
    
    <link rel='stylesheet' type='text/css' href='../css/admin.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css' rel='stylesheet'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet'href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' />
</head>
<body style='background-image: linear-gradient(to right, rgb(165, 165, 165), rgb(133, 133, 133), 
rgb(117, 116, 116),   rgb(109, 108, 108), rgb(79, 79, 79), rgb(57, 57, 57), rgb(14, 14, 14));'>
    
    <form action='' class='w3-container' method='POST' style='margin: 5% 20% 0% 20% ; height: 560px;'>
        <div class='w3-container w3-blue' style='margin: 5% 0% 0% 0%;text-align: center'>
              <h2>ADD PRODUCTS</h2>
        </div>
        <div class='mb-3 mt-3'>
          <label for='uname' class='w3-text-black'style='margin-left: 15px;'>Name:</label>
          <input style='border-radius: 10px;' type='text' class='w3-input w3-border w3-sand' id='uname' placeholder='Enter name' name='name' required>
          
        </div>
        <div class='mb-3 mt-3'>
            <label for='myfile'style='color: black;margin-left: 15px;'>Link:</label>
            <input style='border-radius: 10px;' type='text' class='w3-input w3-border w3-sand' id='uname' placeholder='Enter link' name='link' required>
            
          </div>
          <div class='mb-3'>
            <label for='myfile'style='color: black;margin-left: 15px;'>Images:</label>
            <input style='border-radius: 10px;' type='file' class='w3-input w3-border w3-sand'name='images' required>
           
          </div>
          <div class='mb-3'>
            <label for='pwd' class='form-label'style='color: black;margin-left: 15px;'>REGION:</label>
            <select  style='border-radius: 10px;' class='w3-input w3-border w3-sand' id='sel1' name='nation'>";
              
                echo"<option value='Bắc'>Bắc</option>";
                echo"<option value='Trung'>Trung</option>";
                echo"<option value='Nam'>Nam</option>";
          echo"</select>
            
          </div>
          <div class='mb-3'>";
          $stmt = $category->read();          
         
        echo"<label for='pwd' class='form-label'style='color: black;margin-left: 15px;'>Category:</label>";
          echo "<select class='w3-input w3-border w3-sand' name='category_id'style='border-radius: 10px;'>";
          while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row_category);
                  echo "<option value='{$id}'>{$name}</option>";
                }
              echo "</select>
          
          </div>
        <div class='form-check mb-3'>
          
          <label class='w3-text-brown' for='myCheck'></label>
          
        </div>
        <button type='submit' class='btn btn-primary' name='add' style='margin: 0% 0% 0% 25% ;background: green;border-radius:10px;'>ADD</button>
        <a href='main.php' class='btn btn-danger' name='add' style='margin: 0% 10% 0% 25% ;background: darkred;border-radius:10px;' >BACK</a>
    </form>
</body>
</html>";
  if(isset($_POST['created'])){
    $story->name = $_POST['name'];
    $story->link = $_POST['link'];
    $story->images = $_POST['images'];
    $story->nation = $_POST['nation'];
    $story->category_id = $_POST['category_id'];
    
    if($_POST['images']=="")
        $story->images = $images ;
    else {
        $story->images = $_POST['images'];
    }
    
    if($story->insert())
      header('location:./main.php');
    else {
        echo"Thất bại";
    }
  }

?>