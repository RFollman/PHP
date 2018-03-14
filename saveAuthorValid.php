<?php 
	/*saveAuthor | saves data from sampleForm | 3/5/18*/
/*	require_once 'liblogin.php';*/
	$conn = new mysqli('localhost', 'root', 'root', 'library');
	if ($conn->connect_error) die($conn->connect_error);

	foreach ($_POST as $key => $value) {
		echo $key . " => " . $value . "<br>";
	}
	
	//store post data to array
	function checkData($data, $len, $fldname) {
		//check length of string
		if (strlen(trim($data)) > $len) {
			//return the data and an error
		} else {
			$insData[$fldname] = trim($data);
		}
		
	}

	$data['f_name'] = strlen(trim($_POST['f_name']));
	$data['l_name'] = $_POST['l_name'];
	$data['address1'] = $_POST['address1'];
	$data['address2'] = $_POST['address2'];
	$data['city'] = $_POST['city'];
	$data['state'] = $_POST['state'];
	$data['zip'] = $_POST['zip'];

	//validation goes here

	//each array key is a field name; use that to set up query
	$q = "insert into `authors` (`";
	$qd = ") values ('";
	foreach ($data as $fldName => $postdata) {
		$q .= $fldName . "`, `";
		$qd .= $postdata . "', '";
	}
	$qstr = substr($q,0,-3) . substr($qd,0,-3) . ");";
	echo $qstr . "<br>";
	$result = $conn->query($qstr);

	$q = "select * from authors";

	$result = $conn->query($q);
	if (!$result) die($conn->error);
	$rows = $result->num_rows;
	echo "There are " . $rows . " rows in the Authors table. <br>";
	echo "<a href='sampleForm.php'>Add another author... </a><br>";
?>