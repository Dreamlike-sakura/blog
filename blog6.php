<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>BLOG</title>
</head>
<body>
	<?php
	session_start();
	$name = $_SESSION['username'];
	$con = mysqli_connect("localhost","root");
	if (!$con){
		die('Could not connect: ' . mysqli_error());
	}
	$result = $con->query("SELECT m_text,m_addtime FROM blog_database WHERE Name == '$name'");
	echo "$result";
	?>
	<a href="./blog3.php"><input type="button" name="return" value="返回主页"></a>
<br><br>
</body>
</html>