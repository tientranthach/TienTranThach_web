<?php
   session_start();
  if(!isset($_GET['acc'])){
    $_SESSION['acc'] = "none" ;
  }
  else {
    $_SESSION['acc'] = "block";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
   
    <link rel="stylesheet" type="text/css" href="../css/admin1.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

      
      <form class="w3-container " action="main.php" method="POST" style="margin: 10% 30% 0% 30% ; height: 350px;border-radius:10px;background-color:black;">
      <div class="w3-container w3-brown" style=" background-image: linear-gradient(rgb(17, 17, 17), rgb(78, 78, 78), rgb(17, 17, 17));height:50px;">
          <h2 style="font-size: 18px;text-align: center;margin-top:13px">User Login</h2>
      </div><br>
      <div  style='height: 200px;'>
            
        <div class="mb-3 mt-3" style="width:80%;margin-left:10%">
          
          <input type="email" class="w3-input w3-border w3-sand" id="uname" placeholder="Email" name="email" required>
        </div>
        <div class="mb-3"style="width:80%;margin-left:10%">
          
          <input type="password" class="w3-input w3-border w3-sand" id="pwd" placeholder="Password" name="password" required>
          
          <input style="margin-top:20px;" type="checkbox" onclick="myFunction()"><b class="w3-text-blue"> Show Password</b>

          
        </div>
        <div class="invalid-feedback" style="display:<?=$_SESSION['acc'] ?> ;" ><b>Email hoặc mật khẩu không đúng<b></div>
        
      <button style="margin-left: 10%;width:80%;" type="submit" name="login" class="btn btn-success"><b> Sign In</b></button>
      
    </form>
 
</body>
</html>
<script>
  function myFunction() {
  var x = document.getElementById("pwd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  }
  </script>