<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Nhập dữ liệu</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<?php
	require_once "db3010.php";
	$db = new DbHelper();
	$id = isset($_GET['id'])?$_GET['id'] : "";
	//die($id);
	if ($id != "")
	{
		$sql = "delete from users where id = ?";
		if($db->delete($sql, [$id]) > 0)
			header("location: listofusers3010.php");
	}
	
?>