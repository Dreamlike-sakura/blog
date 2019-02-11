<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户登录界面</title>
<style>
	.error {color: #FF0000;}
</style>
</head>
<body>
	<?php
	$nameErr=$passwordErr=" ";
	$name=$password="";

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(empty($_POST["name"])) $nameErr="请输入用户名";
		else $name=test_input($_POST["name"]);

		if(empty($_POST["password"])) $passwordErr="请输入登录密码";
		else $password=md5(test_input($_POST["password"]));

		if($name){
			$mysqli=new mysqli("localhost","root","","mysql");
			if(mysqli_connect_errno()){
			    echo "连接数据库失败：".mysqli_connect_error();
			    $mysqli=null;
			    exit;
			}
			$result = $mysqli->query("SELECT Name,Password FROM blog_database WHERE Name='$name'");
			$result1 = $mysqli->query("SELECT Name FROM blog_database WHERE Name='$name'");
			if ($result1->num_rows>0) {
				$row = $result->fetch_assoc();
				if ($row['Password'] == $password) {
  					session_start();
				    $_SESSION['username']=$name;

	//session值的读取:
    //session值的销毁
	//			    unset($_SESSION['one']);
  					echo "登录成功";
  					header("Refresh:2;url=blog3.php");
				}
				else echo "密码不正确";
			}
			else{
				echo "您还没有注册";
			}
		}
	}

	function test_input($data)
	{
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
	?>
	<h2>登录界面</h2>
	<h3>如果您还没有注册，请点击注册</h3>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		姓名:<input type="text" name="name">
		<br><br>
		密码:<input type="text" name="password">
		<br><br>
		<input type="submit" name="submit" value="登录">
		<br><br>
	</form>
<a href="./blog2.php"><input type="button" name="login" value="注册"></a>
</body>
</html>
