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
  $id_ = $_GET['id'];
  $query = "SELECT * FROM list WHERE id={$id_}" ;
  $stm = $story->conn->prepare($query);
  $stm->execute();
  $row = $stm->fetch(PDO::FETCH_ASSOC);
  extract($row);
  


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
        <div class='w3-container w3-blue' style='margin: 5% 0% 0% 0%;'>
          <h2 style='text-align:center;'><b>PRODUCT EDIT</b></h2>
        </div>
        <div class='mb-3 mt-3'>
          <label for='uname' class='w3-text-black'style='margin-left: 15px;'>Name:</label>
          <input style='border-radius: 10px;' type='text' value='{$name}' class='form-control' id='uname' placeholder='Enter username' name='name' required>
          
        </div>
        <div class='mb-3 mt-3'>
            <label class='w3-text-black' for='myfile'style='margin-left: 15px;'>Link:</label>
            <input style='border-radius: 10px;' type='text' class='form-control' value='{$link}' id='uname' placeholder='Enter username' name='link' required>
          
          </div>
          <div class='mb-3'>
            <label class='w3-text-black' for='myfile'style='margin-left: 15px;'>Images:</label>
            <img src='../images/{$images}' alt='Logo' style='width:50px ;height:50px'>
            <input style='border-radius: 10px;' type='file' class='form-control'name='images'>
            
          </div>
          <div class='mb-3'>
            <label for='pwd' class='w3-text-black'style='margin-left: 15px;'>REGION:</label>";

            $arr = array( 'B???c', 'Trung','Nam');
          echo" <select class='form-control' id='sel1' name='nation'style='border-radius: 10px;'>";
          echo" <option value='{$nation}'>{$nation}</option>";
          foreach($arr as $key=>$value){
            if($nation==$value)
              continue;
            echo"<option value='{$value}'>{$value}</option>";
          }
                
          echo"</select>
            
            
          </div>
          <div class='mb-3'>";
          
          $stmt = $category->read();          
          $category->id = $category_id ;
          $category->readName();
          echo"<label for='pwd' class='w3-text-black'style='margin-left: 15px;'>Category:</label>";
          echo "<select class='form-control' name='category_id'style='border-radius: 10px;'>";
          echo "<option value='{$category->id}'>{$category->name}</option>";
          while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row_category);
                if($id==$category_id)
                  continue;
                  echo "<option value='{$id}'>{$name}</option>";
                }
              echo "</select>
        </div>   
        
        <button type='submit' class='btn btn-primary' name='update' style='margin: 0% 0% 0% 25% ;background: green;border-radius:10px;'>EDIT</button>
        <a href='main.php' class='btn btn-danger' name='cancal' style='margin: 0% 10% 0% 25% ;background: darkred;border-radius:10px;' >BACK</a>
    </form>
</body>
</html>";
  if(isset($_POST['modified'])){
    $story->name = $_POST['name'];
    $story->link = $_POST['link'];
    $story->images = $_POST['images'];
    $story->nation = $_POST['nation'];
    $story->category_id = $_POST['category_id'];
    echo "$story->category_id";
    if($_POST['images']=="")
        $story->images = $images ;
    else {
        $story->images = $_POST['images'];
    }
    
    if($story->update($id_))
      header('location:./main.php');
    else {
        echo"Th???t b???i";
    }
  }

?>