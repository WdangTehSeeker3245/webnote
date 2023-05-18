<?php
include "db_connect.php";
?>
<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./assets/img/icons/webnote_icon.png">
    <title>Login Webnote App</title>

    <!-- Required CSS -->
    <!-- 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"> 
    -->
    <link rel="stylesheet" href="./lib/bootstrap-5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./lib/fontawesome-free-6.1.2/css/all.min.css">
    
    <link rel="stylesheet" type="text/css" href="./css/preloader.css">
    <!-- My CSS -->

    <style type="text/css">

      .login-label {
        font-weight: bold;
        color: white;
        text-transform: uppercase;
      }

      .login-box {
        border:2px solid lightblue;
        background-color:lightblue;
        width: 310px;
        margin-top: 150px;
        border-radius: 10px;
        box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
      }


    </style>
    <!-- Required JS -->
    <!-- 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script> 
    -->
    <script src="./lib/jquery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="./lib/gsap-3.10.4/gsap.min.js"></script>
  
  </head>
  <body>
    <div id="loader-warper">
      <img id="logo-preload" src="./assets/img/icons/webnote_icon.png" width="100px" height="100px">
      <h2 id="text-loading" class="mt-2">Loading..</h2>
    </div>
    <center>
    <img class="mt-5" id="logo" src="./assets/img/icons/webnote_icon.png" width="50px" height="50px">
    <h1 class="mt-2 text-info"><span id="label-app"><strong>Webnote App</strong></span></h1>
    <hr width="300px" style="color:lightblue; border:3px solid lightblue;">
    <div class="login-box">
      <form action="" method="POST">
          <div style=" width: 250px;">
            <div class="mt-3 mb-3">
                <label for="loginpass" class="form-label login-label">Password Confirmation:</label>
                <input class="form-control" type="password" id="loginpass" name="apppassword">
            </div>
            <button class="btn btn-warning mb-3" type="submit" name="login">Submit</button>
            </div>
      </form>
    </div>
    </center>
    <?php
    if(isset($_POST['login'])){
    $app_pass = $_POST['apppassword'];
    $passwordHashed = password_hash($app_pass, PASSWORD_BCRYPT);
    $passwordHashed = mysqli_real_escape_string($conn, $passwordHashed);
    $sql = "Select * From applogin Where id_applogin = 1";
    $sql = $conn->query($sql);
        if($sql){
        $sql = $sql->fetch_assoc();
            if(password_verify($app_pass, $sql['pass'])){
              session_start();
              $_SESSION['user'] = 'faizal' ;
              header('location: home.php');      
            } else {
              header('location: index.php?=loginfail'); 
            }
        }
    }
    ?>
    <!-- Required JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
    <script src="./lib/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>

    <!-- My Js-->
    <script type="text/javascript">
       $( document ).ready(function() {
        setTimeout(function(){
            $('#loader-warper').addClass('loaded');
            $('#loader-warper').remove();
        }, 5000);
        setTimeout(function(){
            gsap.to(".login-box", {duration: 2, y: -100});
            gsap.from("#logo", {duration: 3, x: 320, opacity: 0, scale: 0.5});
        }, 5100);
       });
    </script>

  </body>
</html>
