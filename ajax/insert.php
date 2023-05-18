<?php
require ('../db_connect.php');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$judul_note = $request->judul_note;
$html_note = $request->html_note;
$type_note = $request->type_note;

if ($type_note == 'normal'){
	$sql = "INSERT INTO note (judul_note,html_note) VALUES ('$judul_note','$html_note')";
	if ($conn->query($sql) === TRUE) {
	  echo "New Note created successfully";
	} else {
	  echo "Error NN: " . $sql . "<br>" . $conn->error;
	}	
} 
if ($type_note == 'draft_story'){
	$series_note = $request->series_note;
	$sql = "INSERT INTO draft_story (series_story,judul_story,html_story) VALUES ('$series_note','$judul_note','$html_note')";
	if ($conn->query($sql) === TRUE) {
	  echo "New Draft Story created successfully";
	} else {
	  echo "Error DS: " . $sql . "<br>" . $conn->error;
	}	
} 


$conn->close();