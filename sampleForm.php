<html>
<head>
	<title>Sample PHP Form</title>
	<?php 
		/* Sample form using bootstrap */
		include 'resources/bslinks.php';
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
			</form>
		</div> <!-- row -->
	</div> <!-- container -->
	</div> <!-- content -->


<?php 
	include 'resources/bsfooter.php';
?>	
</body>
</html>