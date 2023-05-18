<?php
  date_default_timezone_set("Asia/Jakarta");
  session_start();
  include "db_connect.php";
  if( !isset( $_SESSION['user']) ){
    echo "You are not authorized to view this page. Go back <a href= 'index.php'>Login</a>";
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
		 <h1 class="text-decoration-underline text-uppercase"> Add Note </h1>
		 <div class="action">
		 <a href="home.php" title="Back to Home" class="btn back">Back to Home</a>
		 </div>
	</header>

	<main class="container-fluid">
		<div ng-app="textAngularTest" ng-controller="wysiwygeditor" class="container app">
			<form method="post" ng-submit="submitForm()">
				  <br/>
				  <input ng-model="titlecontent"  class="form-control my-2" type="text" name="titlecontent" placeholder="Judul Note">
				  <input id="series" ng-model="seriescontent"  class="form-control my-2" type="text" name="titlecontent" placeholder="Series">
				  <center>
				  <h2 class="text-center my-2 fs-5 ">Choose Note Type :</h2>
				  
				  <div class="note-type border border-primary border-2 my-2">
				  	<div class="form-check ms-2">
					  <input ng-model="radio" value="normal" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
					  <label  class="form-check-label" for="flexRadioDefault1">
					    Normal Note
					  </label>
					</div>
					<div class="form-check ms-2">
					  <input ng-model="radio" value="draft_story" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
					  <label class="form-check-label" for="flexRadioDefault2">
					    Draft Story
					  </label>
					</div>
				  </div>
				  </center>
				  
					
				  <div text-angular="text-angular" name="htmlcontent" ng-model="htmlcontent" ta-disabled='disabled'></div>
				  <!-- <h3>Output Code</h3>
				  <textarea ng-model="htmlcontent" style="width: 100%"></textarea> -->
				  <!-- <div id="note-code" ng-bind-html="htmlcontent"></div>
				  <br/> -->
				  <!-- <div class="d-none" ta-bind="text" ng-model="htmlcontent" ta-readonly='disabled'></div> -->
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
		$scope.orightml = '';
		$scope.htmlcontent = $scope.orightml;
		$scope.disabled = false;
		$scope.submit_button = 'Save Note';
		

		$scope.submitForm = function(){
				$http({
					method:"POST",
					url:"./ajax/insert.php",
					data:{'judul_note':$scope.titlecontent,'series_note':$scope.seriescontent,'html_note':$scope.htmlcontent,'type_note':$scope.radio}
				}).success(function(response){
					alert(response);
				});
		};
	});
	</script>
    <!-- My Js-->
    <script type="text/javascript">
		$("#series").hide();
		$( document ).ready(function() {
		  $( "#flexRadioDefault1" ).click(function() {
  			$("#series").hide();
		  });
		  $( "#flexRadioDefault2" ).click(function() {
  			$("#series").show();
		  });
		});
    </script>
  </body>
</html>