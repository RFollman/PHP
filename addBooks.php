<?php 
	include 'resources/bslinks.php';
	$a = "select l_name, f_name, author_id from authors order by l_name, f_name";
	require_once 'liblogin.php';
	$conn = new mysqli($hostname, $user, $pword, $database, 3306, '/Applications/MAMP/tmp/mysql/mysql.sock');
	if ($conn->connect_error) die($conn->connect_error);
	$result = $conn->query($a);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Books</title>
	<link rel="stylesheet" href="css/main-php.css">
</head>
<body>
	<div class="content">
		<div class="container">
			<div class="row">
				<h1>Add Books</h1>
				<div class="form-group">
					<select>
						<?php foreach ($result as $r): ?>
							<option value="<?=$r['author_id']?>"><?=$r['l_name'] . ", " . $r['f_name']?></option>
						<?php endforeach ?>
						
					</select>
					<input type="color" name="mydate">
					<?php echo date('m/d/y', strtotime($r['myDate'])); ?>
				</div>
			</div>	
		</div>
	</div>
<?php 
	include 'resources/bsfooter.php';
?>
</body>
</html>