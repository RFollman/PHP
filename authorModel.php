<?php 
// authormodel.php
// RFollman 4/4/18


function authorName($aid) {
	
	$aidq = "select * from authors where author_id = " . $aid;
	$conn = new mysqli('localhost', 'root', 'root', 'library');
	if ($conn->connect_error) {echo 'no connection'; die();}
	$ar = $conn->query($aidq);
	$row = $ar->fetch_assoc();
	return $row['f_name'] . " " . $row['l_name'];
}
?>