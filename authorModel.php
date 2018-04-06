<?php 
// authormodel.php
// RFollman 4/4/18


function authorName($aid, $conn) {
	$aidq = "select * from authors where author_id = " . $aid;
	if ($conn->connect_error) {echo 'no connection'; die();}
	$ar = $conn->query($aidq);
	$row = $ar->fetch_assoc();
	return $row['f_name'] . " " . $row['l_name'];
}

function bookCount($aid, $conn) {
	$bctq = "select * from books where author = " . $aid;
	$bctr = $conn->query($bctq);
	return $bctr->num_rows;
}

?>