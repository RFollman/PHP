<html>
<head>
	<title>All About the Session</title>
	<?php 
		/* Sample form using bootstrap */
		session_start();
		$_SESSION['f_name'] = null;
		$_SESSION['l_name'] = null;
		$_SESSION['color'] = null;
		$_SESSION['name'] = 'Testing';
		include 'resources/bslinks.php';
	 ?>	
	 <link rel="stylesheet" href="css/main-php.css">
</head>
<body>
	<div class="content">
	<div class="container">
		<div class="row">
			<h1>Enter Your Data</h1><br>
			<form action="newSession.php" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="f_name" class="control-label col-sm-3">Your Name</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="f_name" name="f_name" placeholder="First Name" value="<?=$_SESSION['f_name']?>">
						<span class="small text-warning" id="f_nameerr"></span>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="l_name" name="l_name" placeholder="Last Name" maxlength="35" value="<?=$_SESSION['l_name']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="color" class="control-label col-sm-3">Favorite Color</label>
					<div class="col-sm-3">
						<input type="color" class="form-control" id="color" name="color" value="<?=$_SESSION['color']?>">
					</div>
				</div>
				<div class="form-group">
					<input type="submit" value="Submit" class="btn btn-info pull-right">
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