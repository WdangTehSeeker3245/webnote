<?php
require ('../db_connect.php');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id_note = $request->id_note;
$judul_note = $request->judul_note;
$html_note = $request->html_note;
$type_note = $request->type_note;

if ($type_note == 'normal'){
	$sql = "UPDATE note SET judul_note='$judul_note', html_note='$html_note' WHERE id_note=$id_note";

	if ($conn->query($sql) === TRUE) {
	  echo "Note updated successfully";
	} else {
	  echo "Error updating note: " . $conn->error;
	}
} 
if ($type_note == 'draft_story'){
	$series_note = $request->series_story;
	$sql = "UPDATE draft_story 
			SET series_story='$series_note', judul_story='$judul_note', html_story='$html_note' 
			WHERE id_story=$id_note";

	if ($conn->query($sql) === TRUE) {
	  echo "Story updated successfully";
	} else {
	  echo "Error updating draft_story: " . $conn->error;
	}
} 


$conn->close();