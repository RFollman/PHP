<html>
<head>
	<title>Sample PHP Form</title>
	<?php 
		/* Sample form using bootstrap */
		include 'resources/bslinks.php';

		//get authors data
		$a = "select * from authors order by l_name, f_name";
		require_once 'liblogin.php';
		$conn = new mysqli($hostname, $user, $pword, $database, 3305, '/Applications/MAMP/tmp/mysql/mysql.sock');
		if ($conn->connect_error) die($conn->connect_error);
		$result = $conn->query($a);
	 ?>	
	 <link rel="stylesheet" href="css/main-php.css">
</head>
<body>
	<div class="content">
	<div class="container">
		<div class="row">
			<h1>Enter Author Data</h1><br>
			<form action="saveAuthor.php" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="f_name" class="control-label col-sm-3">Author's Name</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="f_name" name="f_name" placeholder="First Name">
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="l_name" name="l_name" placeholder="Last Name">
					</div>
				</div>
				<div class="form-group">
					<label for="address1" class="control-label col-sm-3">Address</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="address1" name="address1" placeholder="Address Line 1">
					</div>
				</div>
				<div class="form-group">
					<label for="address2" class="control-label col-sm-3"></label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="address2" name="address2" placeholder="Address Line 2">
					</div>
				</div>

				<div class="form-group">
					<label for="city" class="control-label col-sm-3">City, State Zip</label>
					<div class="col-sm-3">
						<input type="text" name="city" placeholder="City" class="form-control" id="city">
					</div>
					<div class="col-sm-1">
						<input type="text" name="state" class="form-control" id="state" placeholder="State">
					</div>
					<div class="col-sm-2">
						<input type="text" name="zip" class="form-control" id="zip" placeholder="Zip Code">
					</div>
				</div>
				<div class="form-group">
					<input type="submit" value="Submit" class="btn btn-warning pull-right">
				</div>
			</form>
			<h2>Current Authors</h2>
			<?php 
				foreach ($result as $r) {
					echo "<p>" . $r['f_name'] . "</p>";
				}
			?>

			</form>
		</div> <!-- row -->
	</div> <!-- container -->
	</div> <!-- content -->


<?php 
	include 'resources/bsfooter.php';
?>	
</body>
</html>