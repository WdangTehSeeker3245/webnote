<?php
require "../db_connect.php";

$search = $_POST["search"];
$sql = "SELECT * FROM note WHERE judul_note LIKE '%$search%'";
$query = mysqli_query($conn, $sql);
$rows = array();
while ($r = mysqli_fetch_assoc($query)){
	$rows[] = $r;
}
echo json_encode($rows);