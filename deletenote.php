<?php
 date_default_timezone_set("Asia/Jakarta");
 session_start();
 include "db_connect.php";
 if( !isset( $_SESSION['user']) ){
    echo "You are not authorized to view this page. Go back <a href= 'index.php'>Login</a>";
  }

 if(isset($_GET['id_note'])){
 	$id_note = $_GET['id_note'];
	$id_note = mysqli_real_escape_string($conn, $id_note);
	$sql = "DELETE FROM note WHERE id_note=$id_note";

	if ($conn->query($sql) === TRUE) {
	  echo '<script language="javascript">';
      echo 'alert("Note Deleted Successfully")';
      echo '</script>';
	  header('location: home.php');
	} else {
	  $error = $conn->error ;
	  echo '<script language="javascript">';
      echo 'alert("'.$error.'")';
      echo '</script>';
      header('location: home.php');
	}
 }
 if(isset($_GET['id_story'])){
 	$id_note = $_GET['id_story'];
	$id_note = mysqli_real_escape_string($conn, $id_note);
	$sql = "DELETE FROM draft_story WHERE id_story=$id_note";

	if ($conn->query($sql) === TRUE) {
	  echo '<script language="javascript">';
      echo 'alert("Draft Deleted Successfully")';
      echo '</script>';
	  header('location: list_darft_story.php');
	} else {
	  $error = $conn->error ;
	  echo '<script language="javascript">';
      echo 'alert("'.$error.'")';
      echo '</script>';
      header('location: home.php');
	}
 }
