 <?php

session_start();

//CONNECTING TO THE DATABASE
$mysqli = new mysqli('localhost', 'root', '','cs230') or die(mysqli_error($mysqli));

//INITIALIZING VARIABLES
$ID = 0;
$update = false;
$creator = '';
$title = '';
$type = '';
$identifier = '';
$date = '';
$language = '';
$description = '';

//FOR SAVING THE VARIABLES, CREATING A NEW ROW OF DATA
if (isset($_POST['save'])){
	$creator = $_POST['creator'];
	$title = $_POST['title'];
	$type = $_POST['type'];
	$identifier = $_POST['identifier'];
	$date = $_POST['date'];
	$language = $_POST['language'];
	$description = $_POST['description'];
	
	$_SESSION['message']="Record has been saved";
	$_SESSION['msg_type']="success";
	
	header("location: index.php");
	
	$mysqli->query("INSERT INTO ebook_metadata (creator, title, type, identifier, date, language, description) VALUES ('$creator', '$title', '$type', '$identifier', '$date', '$language', '$description')") or die($mysqli->error);
}

//FOR DELETING A ROW
if (isset($_GET['delete'])){
	$ID = $_GET['delete'];
	$mysqli->query("DELETE FROM ebook_metadata WHERE ID=$ID") or die($mysql->error());

	$_SESSION['message']="Record has been deleted.";
	$_SESSION['msg_type']="danger";
	
	header("location: index.php");
}

//SELECTS A ROW TO EDIT INFORMATION
if (isset($_GET['edit'])){
	$ID = $_GET['edit'];
	$update = true;
	$result=$mysqli->query("SELECT * FROM ebook_metadata WHERE ID=$ID") or die($mysqli->error());
	if (@count($result)==1){
		$row=$result->fetch_array();
		$creator = $row['creator'];
		$title = $row['title'];
		$type = $row['type'];
		$identifier = $row['identifier'];
		$date = $row['date'];
		$language = $row['language'];
		$description = $row['description'];
	}
}

//WHERE THE NEW INFORMATION FOR A ROW TO BE EDITED IS ENTERED
if (isset($_POST['update'])){
	$ID=$_POST['ID'];
	$creator = $_POST['creator'];
	$title = $_POST['title'];
	$type = $_POST['type'];
	$identifier = $_POST['identifier'];
	$date = $_POST['date'];
	$language = $_POST['language'];
	$description = $_POST['description'];
	
	$mysqli->query("UPDATE ebook_metadata SET creator='$creator', title='$title', type='$type', identifier='$identifier', date='$date', language='$language', description='$description' WHERE ID=$ID") or die($mysqli->error);
	$_SESSION['message'] = "Record has been updated";
	$_SESSION['msg_type'] = "warning";
	
	header("location: index.php");
}
