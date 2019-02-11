<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<?php
session_start();
$m_text = $_POST['m_text'];
$name = $_SESSION['username'];
if($m_text==null){
	echo "<script type='text/javascript'>alert('ID或内容未填写，请先填写内容！');</script>";
	$url="blog4.php";
	echo "<script language=\"javascript\">";
	echo "location.href=\"$url\"";
	echo "</script>";
}
else{
	$m_addtime = date("Y-m-d h:i:sa");
	$con = mysqli_connect("localhost","root");
	if (!$con){
		die('Could not connect: ' . mysqli_error());
	}
	// $result = $con->query("SELECT m_text FROM blog_database WHERE Name == '$name'");
	// if($result){
		$con->query("INSERT INTO blog_database (m_text,m_addtime) VALUES('$m_text','$m_addtime')");
		$con->close();
    	echo "发表成功！";
		header("Refresh:2;url=blog3.php");
	// }
	// else{
	// 	$con->query("UPDATE blog_database SET m_text = '$m_text',m_addtime = '$m_addtime'");
	// 	$con->close();
	//     echo "发表成功！";
	// 	header("Refresh:2;url=blog3.php");
	// }
}

?>
</body>
</html>
