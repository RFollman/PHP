<html>
	<head>
		<title>Table Information</title>
		<?php 
			include 'resources/bslinks.php';

			require_once 'liblogin.php';
			$conn = new mysqli($hostname, $user, $pword, $database);
			if ($conn->connect_errno) {
				printf("Connect failed: %s\n", $conn->connect_error);
				exit();
			} 
			$query = "select * from authors";
			$result = $conn->query($query);
			$finfo = $result->fetch_fields();
			$rows = $result->num_rows;
			function transType($t) {
				switch ($t) {
					case '3':
						return 'Long';
						break;
					case '253':
						return 'Varchar';
						break;
					default:
						return 'Error';
						break;
				}
			}
		?>
		<link rel="stylesheet" href="css/main-php.css">
	</head>
	<body>
		<div class="content">
			<div class="container">
				<div class="row">
					<h1>Table Data</h1>
					<?php if ($result): ?>
						<section class="col-sm-6 col-sm-offset-3">
						<table class="small table table-condensed table-striped">
							<thead>
								<tr><th>Field Name</th><th class="text-right">Length</th><th class="text-right">Data Type</th></tr>
							</thead>
							<tbody>
								<?php foreach ($finfo as $r): ?>
									<tr><td><?=$r->name?></td><td class="text-right"><?=$r->length?></td><td class="text-right"><?=$r->type?></td></tr>
								<?php endforeach ?>
							</tbody>
						</table>
						<blockquote><h4>There are <?=$rows?> rows in the Authors table.</h4></blockquote>
						<a href="sampleForm.php" class="btn btn-info pull-right">Add a New Author</a>
						</section>
					<?php endif ?>
				</div>
			</div>
		</div>
		<?php include 'resources/bsfooter.php'; ?>
	</body>
</html>
