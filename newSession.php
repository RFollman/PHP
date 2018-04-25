<html>
<head>
	<title>All About the Session</title>
	<?php 
		session_start();
		/*$_SESSION['f_name'] = $this->input->post('f_name');
		$_SESSION['l_name'] = $this->input->post('l_name');
		$_SESSION['color'] = $this->input->post('color');*/
		include 'resources/bslinks.php';
	?>
	 <link rel="stylesheet" href="css/main-php.css">
</head>
<body>
	<div class="content">
		<div class="container">
			<?=$_SESSION['name']?>
			<h1>Your Session Variables</h1>
			<div class="col-sm-6">
				<h3>Great choices, <?=$_SESSION['f_name']?>!</h3>
			</div>
			<div class="col-sm-6">
				<h3>Here is a big box full of color!</h3>
<style>
#rectangle {
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