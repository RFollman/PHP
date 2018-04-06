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
			$finfo['a'] = $result->fetch_fields();
			$finfo['a']['rows'] = $result->num_rows;
			$query = "select * from books";
			$result = $conn->query($query);
			$finfo['b'] = $result->fetch_fields();
			$finfo['b']['rows'] = $result->num_rows;
			function transType($t) {
				if ($t) {
					switch ($t) {
						case '3':
							return 'Long';
							break;
						case '253':
							return 'Varchar';
							break;
						default:
							return 'Error: ' . $t . ' not found.';
							break;
					}
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
							<?php foreach ($finfo as $k => $tType): ?>
								<?php if ($k == 'a') {$tname = 'Authors';} else {$tname = 'Books';} ?>
								<table class="small table table-condensed table-striped">
									<thead>
										<tr><th>Field Name</th><th class="text-right">Length</th><th class="text-right">Data Type</th></tr>
									</thead>
									<tbody>
										<?php foreach ($tType as $r): ?>
											<tr><td><?=$r->name?></td><td class="text-right"><?=$r->length?></td><td class="text-right"><?=transType($r->type)?></td></tr>
										<?php endforeach ?>
									</tbody>
								</table>
								<blockquote><h4>There are <?=$tType['rows']?> rows in the <?=$tname?> table.</h4></blockquote>
								
							<?php endforeach ?>
						<a href="sampleForm.php" class="btn btn-info pull-right">Add a New Author</a>
						<a href="addBooks.php" class="btn btn-warning pull-right">Add a New Book</a>
						</section>
					<?php endif ?>
				</div>
			</div>
		</div>
		<?php include 'resources/bsfooter.php'; ?>
	</body>
</html>
