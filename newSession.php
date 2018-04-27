<html>
<head>
	<title>All About the Session</title>
	<?php 
		session_start();
		$_SESSION['f_name'] = $_POST['f_name'];
		$_SESSION['l_name'] = $_POST['l_name'];
		$_SESSION['color'] = $_POST['color'];
		include 'resources/bslinks.php';
	?>
	 <link rel="stylesheet" href="css/main-php.css">
</head>
<body>
	<div class="content">
		<div class="container">
			<h1>Your Session Variables</h1>
			<div class="col-sm-6">
				<h3>Great choices, <?=$_SESSION['f_name']?>!</h3>
			</div>
			<div class="col-sm-6">
				<h3>Here is a big box full of color!</h3>
<style>
#rectangle {
	margin-top: 5px;
	width: 200px;
	height: 100px;
	background: <?=$_SESSION['color']?>;
}
</style>
			<div id="rectangle">
				
			</div>
			<a href="sessionForm.php" class="btn btn-warning pull-right">Try Again</a>
			</div>
		</div>
	</div>
<?php 
	include 'resources/bsfooter.php';
?>	
</body>
</html>