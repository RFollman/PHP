<?php 
include 'resources/bslinks.php';
include 'resources/validation.php';
 ?>
<link rel="stylesheet" href="css/main-php.css">

<html>
 	<head>
 		<title>PHP Validation</title>
 	</head>
 	<body>
	<div class="content">
	<div class="container">
		<div class="row">
			<h1>Enter Author Data</h1><br>
				<form action="validTest.php" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="f_name" class="control-label col-sm-3">Author's Name</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="f_name" name="f_name" placeholder="First Name" maxlength="25" value="<?=testLength(25)?>">
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="l_name" name="l_name" placeholder="Last Name" maxlength="35">
					</div>
				</div>
				<div class="form-group">
					<input type="submit" value="Submit" class="btn btn-warning pull-right">
				</div>
			</form>
 	</body>
<?php 
include 'resources/bsfooter.php';
 ?>
</html>
