<html>
<head>
	<title>Sample PHP Form</title>
	<?php 
		/* Sample form using bootstrap */
		include 'resources/bslinks.php';

		$a = "select * from authors order by l_name, f_name";
		/*require_once 'liblogin.php';*/
		
		$conn = new mysqli('localhost', 'root', 'root', 'library');
		if ($conn->connect_error) die($conn->connect_error);
		$result = $conn->query($a);

		$row = null; //in case no author data requested

		//get authors data if requested
		if ($_GET['aid']) {
			$aidq = "select * from authors where author_id = " . $_GET['aid'];
			$ar = $conn->query($aidq);
			$row = $ar->fetch_assoc();
		}
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
						<input type="text" onchange="validText(this.value, this.name)" class="form-control" id="f_name" name="f_name" placeholder="First Name" value="<?=$row['f_name']?>">
					</div>
					<div class="col-sm-4">
						<input type="text" onchange="validText(this.value, this.name)" class="form-control" id="l_name" name="l_name" placeholder="Last Name" maxlength="35" value="<?=$row['l_name']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="address1" class="control-label col-sm-3">Address</label>
					<div class="col-sm-4">
						<input type="text" onchange="validText(this.value, this.name)" class="form-control" id="address1" name="address1" placeholder="Address Line 1" value="<?=$row['address1']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="address2" class="control-label col-sm-3"></label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="address2" name="address2" placeholder="Address Line 2" value="<?=$row['address2']?>">
					</div>
				</div>

				<div class="form-group">
					<label for="city" class="control-label col-sm-3">City, State Zip</label>
					<div class="col-sm-3">
						<input type="text" name="city" placeholder="City" class="form-control" id="city" value="<?=$row['city']?>">
					</div>
					<div class="col-sm-1">
						<input type="text" name="state" class="form-control" id="state" placeholder="State" value="<?=$row['state']?>">
					</div>
					<div class="col-sm-2">
						<input type="text" name="zip" class="form-control" id="zip" placeholder="Zip Code" value="<?=$row['zip']?>">
					</div>
				</div>
				<div class="form-group">
					<input type="submit" value="Submit" class="btn btn-warning pull-right">
				</div>
			</form>
			<h2>Current Authors</h2>
			<?php if ($result): ?>
				<table class="small table table-condensed table-striped">
					<thead><tr><th>Name</th><th>City, State</th></tr></thead>
					<tbody>
						<?php foreach ($result as $r): ?>
							<tr><td><a href="sampleForm.php?aid=<?=$r['author_id']?>"><?=$r['f_name'] . " " . $r['l_name']?></a></td><td><?=$r['city'] . ", " . $r['state']?></td></tr>
						<?php endforeach ?>
					</tbody>
				</table>
			<?php else: ?>
				<p>No records</p>
			<?php endif ?>
			

			</form>
		</div> <!-- row -->
	</div> <!-- container -->
	</div> <!-- content -->


<?php 
	include 'resources/bsfooter.php';
?>	
</body>
</html>