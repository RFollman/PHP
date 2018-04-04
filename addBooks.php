<?php 
	include 'resources/bslinks.php';
	$a = "select l_name, f_name, author_id from authors order by l_name, f_name";
	$b = "select * from books order by title";
	$row = null;
	require_once 'liblogin.php';
	$conn = new mysqli($hostname, $user, $pword, $database);
	if ($conn->connect_error) die($conn->connect_error);
	$author = $conn->query($a);
	$books = $conn->query($b);
	if ($_GET['bid']) {
		$bidq = "select * from books where book_id = " . $_GET['bid'];
		$ar = $conn->query($bidq);
		$row = $ar->fetch_assoc();
	}
	include 'authorModel.php';
	
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
			<form action="saveBook.php" method="post" class="form-horizontal">
				<input type="hidden" name="book_id" value="<?=$row['book_id']?>" id="book_id">
				<div class="form-group">
					<label for="title" class="control-label col-sm-3">Book Title</label>
					<div class="col-sm-4">
						<input type="text" onchange="validText(this.value, this.name)" name="title" placeholder="Book Title" value="<?=$row['title']?>" class="form-control" id="title" required="required">
						<span class="small text-warning" id="titleerr"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="author" class="control-label col-sm-3">Author</label>
					<div class="col-sm-4">
						<select name="author" id="author" class="form-control" required="required">
							<option value="" selected="selected">Please make a choice</option>
							<?php foreach ($author as $r): ?>
								<?php if ($r['author_id'] == $row['author']): ?>
									<option value="<?=$r['author_id']?>" selected="selected"><?=$r['l_name'] . ", " . $r['f_name']?></option>
								<?php else: ?>
									<option value="<?=$r['author_id']?>"><?=$r['l_name'] . ", " . $r['f_name']?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="pub_date" class="control-label col-sm-3">Date of Publication</label>
					<div class="col-sm-3">
						<input type="date" name="pub_date" required="required" class="form-control" id="pub_date" value="<?=$row['pub_date']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="genre" class="control-label col-sm-3">Genre of Publication</label>
					<div class="col-sm-4">
						<input type="text" name="genre" class="form-control" id="genre" value="<?=$row['genre']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="pub_type" class="control-label col-sm-3">Type of Publication</label>
					<div class="col-sm-4">
						<input type="text" name="pub_type" class="form-control" id="pub_type" value="<?=$row['pub_type']?>">
					</div>
				</div>
				<div class="form-group">
					<input type="submit" value="Submit" class="btn btn-info pull-right">
				</div>
			</form>
			<section class="col-sm-6 col-sm-offset-3">
			<h2>Current Books</h2>
			
			<?php if ($books): ?>
				<table class="small table table-condensed table-striped">
					<thead><tr><th>Title</th><th>Author</th></tr></thead>
					<tbody>
						<?php foreach ($books as $r): ?>
							<tr><td><a href="addBooks.php?bid=<?=$r['book_id']?>"><?=$r['title']?></a></td><td><?=authorName($r['author'])?></td></tr>
						<?php endforeach ?>
					</tbody>
				</table>
			<?php else: ?>
				<p>No records</p>
			<?php endif ?>
			</section>			
		</div>	
	</div>
</div>
<?php 
	include 'resources/bsfooter.php';
?>
</body>
</html>