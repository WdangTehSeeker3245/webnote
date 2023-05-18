<?php
  date_default_timezone_set("Asia/Jakarta");
  session_start();
  include "db_connect.php";
  if( !isset( $_SESSION['user']) ){
    echo "You are not authorized to view this page. Go back <a href= 'index.php'>Login</a>";
  }
  $id_note = $_GET['id_note'];
  $sql = "SELECT * FROM note WHERE id_note=$id_note";
  $query = mysqli_query($conn,$sql);
  $data = mysqli_fetch_assoc($query);
  $judul_note = $data['judul_note'];
  $html_note = $data['html_note'];
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
 	<!--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    -->
    <link rel="stylesheet" href="./lib/bootstrap-5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./lib/fontawesome-free-6.1.2/css/all.min.css">
	
    <!-- My CSS -->
    <style type="text/css">
 	* {
 		margin:0;
 	}

 	.note-option {
 		width: 150px;
 		border-radius: 10px;
 		border : 2px solid lightblue;
 	}
	@media only screen and (max-width: 600px) {
		.note-option {
	 		width: 150px;
	 		border-radius: 10px;
	 		border : 2px solid lightblue;
 		}
 	}
    </style>
    <!-- Required JS -->
 
 
  </head>
  <body>
  	<!-- Header -->
  	<div class="container-fluid my-3">
  		<h3 class="display-4 text-center fw-bold"><?php echo $judul_note ?></h3>
  		<div class="note-option text-center mx-auto">
  			<span class="mx-2"><a href="home.php"><i class="fas fa-arrow-alt-circle-left text-secondary"></i></a></span>
  			<span class="mx-2"><a href="editnote.php?id_note=<?php echo $id_note ?>"><i class="fas fa-edit text-primary"></i></a></span>
  			<span class="mx-2"><a href="deletenote.php?id_note=<?php echo $id_note ?>"><i class="fas fa-trash text-danger"></i></a></span>
  		</div>
  	</div>
  	<hr>
  	<div class="container-fluid my-3">
  		<?php
 			echo $html_note;
 		?>
  	</div>
 	
    <!-- Required JS -->
 
    <!-- My Js-->
	<script type="text/javascript">
		var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    	if (width<600){
      		var element = document.querySelector("#example")
      		element.classList.add("mystyle");
    	}
	</script>
  </body>
</html>