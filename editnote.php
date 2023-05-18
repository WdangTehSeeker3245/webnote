<?php
  date_default_timezone_set("Asia/Jakarta");
  session_start();
  include "db_connect.php";
  if( !isset( $_SESSION['user']) ){
    echo "You are not authorized to view this page. Go back <a href= 'index.php'>Login</a>";
  }
  if( isset( $_GET['id_note']) ){
    $id_note = $_GET['id_note'];
    $id_note = mysqli_real_escape_string($conn, $id_note);
    $sql = "SELECT * FROM note WHERE id_note=$id_note";
    $query = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($query);
    $judul_note = $data['judul_note'];
    $html_note = $data['html_note'];
    $series_note = 'coba';
    $type_note = 'normal';
  }
  else if ( isset( $_GET['id_story']) ){
    $id_note = $_GET['id_story'];
    $id_note = mysqli_real_escape_string($conn, $id_note);
    $sql = "SELECT * FROM draft_story WHERE id_story=$id_note";
    $query = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($query);
    $judul_note = $data['judul_story'];
    $series_note = $data['series_story'];
    $html_note = $data['html_story'];
    $type_note = 'draft_story';
  }
  else {
    header("Location : home.php");
  }
  
?>

<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./assets/img/icons/webnote_icon.png">
    <title>Webnote App</title>

     <!-- Required CSS -->
     <!-- Bootstrap 5 CSS -->
     <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
      <link rel="stylesheet" href="./lib/bootstrap-5.1.3/css/bootstrap.min.css">

     <!-- Font Awesome 4 CSS -->
     <!-- <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.min.css'> -->
      <link rel="stylesheet prefetch" href="./lib/fontawesome-4.7.0/css/font-awesome.min.css">

     <!-- Rich Text Editor CSS -->
      <link rel="stylesheet" href="css/rich-text-editor.css">
      
     <!-- Editor CSS -->
      <link rel="stylesheet" href="css/editor.css">

    <!-- My CSS -->
    <style type="text/css">
      .note-type {
        width: 300px;
      }
      @media only screen and (max-width: 600px) {
        .note-type {
          width: 200px;
        }
      }
    </style>


    <!-- Required JS -->
    <!-- Angular JS -->
    <!-- <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.2.4/angular.min.js'></script> -->
    <script src="./lib/angularjs-1.2.4/angular.min.js"></script>

    <!-- Angular Sanitize JS -->
    <!-- <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.2.4/angular-sanitize.min.js'></script> -->
    <script src="./lib/angularjs-1.2.4/angular-sanitize.min.js"></script>

    <!-- Text Angular JS -->
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/textAngular/1.1.2/textAngular.min.js'></script> -->
    <script src="./lib/angularjs-1.2.4/textAngular.min.js"></script>

    <!-- Jquery -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
    <script src="./lib/jquery-3.6.0/jquery-3.6.0.min.js"></script>

  </head>
  <body>
  <header class="intro container-fluid">
     <h1 class="text-decoration-underline text-uppercase"> Edit Note </h1>
     <div class="action">
     <a href="home.php" title="Back to Home" class="btn back">Back to Home</a>
     </div>
  </header>
  <main class="container-fluid">
    <div ng-app="textAngularTest" ng-controller="wysiwygeditor" class="container app">
      <form method="post" ng-submit="submitForm()">
          <br/>
          <input ng-model="titlecontent"  class="form-control my-2" type="text" name="titlecontent" placeholder="Judul Note" value="{{ titlecontent }}">
          <input id="series" ng-model="seriescontent"  class="form-control my-2" type="text" name="titlecontent" placeholder="Series" value="{{ seriescontent }}">
          <div text-angular="text-angular" name="htmlcontent" ng-model="htmlcontent" ta-disabled='disabled' value='{{ htmlcontent }}'></div>
          <br/>
          <center>
          <input type="submit" name="submit" id="submit" class="btn btn-info" value="{{submit_button}}" />
          </center>   
      </form>
        <br/>
    </div>
  </main>

    <!-- Required JS -->
    <!-- JavaScript Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
    <script src="./lib/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    
    <script>
    var app = angular.module("textAngularTest", ['textAngular']);
    app.controller('wysiwygeditor', function($scope, $http){
      $scope.orightml = '<?php echo $html_note; ?>';
      $scope.htmlcontent = $scope.orightml;
      $scope.disabled = false;
      $scope.submit_button = 'Save Note';
      $scope.idcontent = '<?php echo $id_note; ?>';
      $scope.titlecontent = '<?php echo $judul_note; ?>';
      $scope.seriescontent = '<?php echo $series_note; ?>';
      $scope.typecontent = '<?php echo $type_note; ?>';

      $scope.submitForm = function(){
          $http({
            method:"POST",
            url:"./ajax/edit.php",
            data:{'id_note':$scope.idcontent,'judul_note':$scope.titlecontent,'series_story':$scope.seriescontent,'html_note':$scope.htmlcontent,'type_note':$scope.typecontent}
          }).success(function(response){
            alert(response);
          });
      };
    });
    </script>
  
  <!-- My Js-->
  <script type="text/javascript">
      var typenote = "<?php echo $type_note; ?>";
      if(typenote == 'normal'){
        $('#series').hide();
      } 
  </script>
  </body>
</html>
