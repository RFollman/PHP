<?php 
	/*saveAuthor | saves data from sampleForm | 3/5/18*/
	require_once 'liblogin.php';
	$conn = new mysqli($hostname, $user, $pword, $database);
	if ($conn->connect_error) die($conn->connect_error);

	//ss validation goes here
	
	//store post data to array
	$data['title'] = $_POST['title'];
	$data['pub_date'] = $_POST['pub_date'];
	$data['author'] = $_POST['author'];
	$data['genre'] = $_POST['genre'];
	$data['pub_type'] = $_POST['pub_type'];

	//each array key is a field name; use that to set up query

	if ($_POST['book_id']) {
		$q = "update `books` set "; 
		foreach ($data as $fldName => $postdata) {
			$q .= $fldName . " = '" . $postdata . "', ";
		}
		$q = substr($q,0,-2);
		$q .= " where book_id = " . $_POST['book_id'];
		$tryit = $conn->query($q);
	} else {
		$q = "insert into `books` (`";
		$qd = ") values ('";
		foreach ($data as $fldName => $postdata) {
			$q .= $fldName . "`, `";
			$qd .= $postdata . "', '";
		}
		$qstr = substr($q,0,-3) . substr($qd,0,-3) . ");";
		echo $qstr . "<br>";
		$result = $conn->query($qstr);
	}
	/*header('Location: addBooks.php');*/
	$q = "select * from books";

	$result = $conn->query($q);
	if (!$result) die($conn->error);
	$rows = $result->num_rows;
	echo "There are " . $rows . " rows in the Books table. <br>";
	echo "<a href='addBooks.php'>Add another book... </a><br>";
?>