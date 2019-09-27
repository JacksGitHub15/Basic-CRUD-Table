<!DOCTYPE html>
<html>
<head>
<title>Basic CRUD Table</title>
	<!-- USING BOOTSTRAP AS MY CSS AS FOR DISPLAYING TABLE AND BUTTONS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
	<!-- CALLS ANOTHER FILE THAT CONTAINS THE FUNCTIONALITY OF THE TABLE -->
	<?php require_once 'process.php'; ?>
	
	<?php 
	if (isset($_SESSION['message'])): ?>
	
	<div class="alert alert-<?=$_SESSION['msg_type']?>">
	
		<?php 
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		?>
	</div> 
	<?php endif ?>
	
	<div class="container"> </div>
	
	<?php 
		$mysqli = new mysqli('localhost','root','','cs230') or die(mysqli_error($mysqli));
		$result = $mysqli->query("SELECT * FROM ebook_metadata") or die($mysqli->error);
	?>
	
	<div class="row justify-content-center">
		<table class="table"> 
			<thead>   
				<tr>
					<th>Creator</th>
					<th>Title</th>
					<th>Type</th>
					<th>Identifier</th>
					<th>Date</th>
					<th>Language</th>
					<th>Description</th>
					<th colspan="2">Action</th>
				</tr>
			</thead>			
	<?php
		while ($row = $result->fetch_assoc()):  ?>
			<tr>
				<td><?php echo $row['creator']; ?></td>
				<td><?php echo $row['title']; ?></td>
				<td><?php echo $row['type']; ?></td>
				<td><?php echo $row['identifier']; ?></td>
				<td><?php echo $row['date']; ?></td>
				<td><?php echo $row['language']; ?></td>
				<td><?php echo $row['description']; ?></td>
				<td>
					<a href="index.php?edit=<?php echo $row['ID']; ?>"
					class="btn btn-info">Edit</a>
					<a href="process.php?delete=<?php echo $row['ID']; ?>"
					class="btn btn-danger">Delete</a>
				</td>
			</tr>
		<?php endwhile; ?>
		</table>
	</div>
	<!-- THE FORM THAT LAYS OUT DATA FOR TABLE -->
	<div class="row justify-content-center">
	<form action="process.php" method="POST">
	<input type="hidden" name="ID" value="<?php echo $ID; ?>">
	
	<div class="form-group">
		<label for="creator">Creator:</label>
		<input type="text" name="creator" class="form-control" id="creator" value="<?php echo $creator; ?>" placeholder="Enter authors name: ">
	</div>	
	<div class="form-group">
		<label for="title">Title:</label>
		<input type="text" name="title"  class="form-control" id="title" value="<?php echo $title; ?>" placeholder="Enter the title: ">
	</div>
	<div>
		<label for="type">Type:</label>
		<input type="text" list="types" name="type" class="form-control" id="type" value="<?php echo $type; ?>" placeholder="Enter the type: ">
		<datalist id="types">
		<option value="Fantasy">
		<option value="Romance">
		<option value="Thriller">
		<option value="Kids">
	</div>
	<div>
		<label for="identifier">Identifier:</label>
		<input type="text" name="identifier" class="form-control" id="identifier" value="<?php echo $identifier; ?>" placeholder="The ISBN of the book: ">
	</div>
	<div>
		<label for="date">Date:</label>
		<input type="date" name="date" class="form-control" id="date" value="<?php echo $date; ?>" placeholder="Enter the date of publication:">
	</div>
	<div>
		<label for="language">Language:</label>
		<input type="text" list="languages" name="language" class="form-control" id="langauge" value="<?php echo $language; ?>"  placeholder="Enter the language used: ">
		<datalist id="languages">
		<option value="English">
		<option value="French">
		<option value="Spain">
		<option value="German">
	</datalist>
	</div>
	<div>
		<label for="description">Description:</label>
		<input type="text" name="description" class="form-control" id="description" value="<?php echo $description; ?>" placeholder="Enter a brief description: ">
	</div>
	
	<!-- IF THE EDIT BUTTON HAS BEEN CLICKED, CHANGE SAVE BUTTON TO UPDATE BUTTON-->
	<div class="form-group">
	<?php 
	if ($update == true):
	?>
	<button type="submit" class="bnt btn-info" name="update">Update</button>
	<?php else: ?>
	<button type="submit" class="btn btn-primary" name="save">Save</button>
	<?php endif; ?> 
	</div>

	</form>
	</div>
	</div>
</body>
</html>
