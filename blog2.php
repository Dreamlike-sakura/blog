<!DOCTYPE HTML> 
<html>
<head>
<meta charset="UTF-8">
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 

<?php
$nameErr = $passwordErr = $emailErr = "";
$name = $password = $email = $m_text = $m_addtime = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
     $nameErr = "姓名是必填的";
     }
    else {
     $name = test_input($_POST["name"]);
     if (!preg_match("/^[a-zA-Z]*$/",$name)) {
       $nameErr = "只允许字母"; 
     }
    }

    if (empty($_POST["password"])) {
     $passwordErr = "密码是必填的";
     }
    else {
      $password = test_input($_POST["password"]);
      $p = valid_pass($password);
      if($p){
        $password = md5($_POST["password"]);
      }
      else{
        $password = "";
      }
      
    }
   
    if(empty($_POST["email"])) {
      $emailErr = "邮箱是必填的";
     }
     else {
     $email = test_input($_POST["email"]);
     if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
       $emailErr = "无效的 email 格式"; 
     }
    }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

// a valid password should contains:
// at least 1 upper case letter, 1 lower case letter, 1 number, 1 special character, 
// and 8 characters in length
function valid_pass($password) {
    $r1='/[A-Z]/';  //uppercase
    $r2='/[a-z]/';  //lowercase
    $r3='/[0-9]/';  //numbers
    $r4='/[~!@#$%^&*()\-_=+{};:<,.>?]/';  // special char
 
    if(preg_match_all($r1,$password, $o)<1) {
        echo "密码必须包含至少一个大写字母，请返回修改！<br />";
        return FALSE;
    }
    if(preg_match_all($r2,$password, $o)<1) {
        echo "密码必须包含至少一个小写字母，请返回修改！<br />";
        return FALSE;
    }
    if(preg_match_all($r3,$password, $o)<1) {
        echo "密码必须包含至少一个数字，请返回修改！<br />";
        return FALSE;
    }
    if(preg_match_all($r4,$password, $o)<1) {
        echo "密码必须包含至少一个特殊符号：[~!@#$%^&*()\-_=+{};:<,.>?]，请返回修改！<br />";
        return FALSE;
    }
    if(strlen($password)<8) {
        echo "密码必须包含至少含有8个字符，请返回修改！<br />";
        return FALSE;
    }
    return TRUE;
}

if($name&&$password&&$email){
  $mysqli=new mysqli("localhost","root","","mysql");
  if(mysqli_connect_errno()){
    echo "连接数据库失败：".mysqli_connect_error();
    $mysqli=null;
    exit;
  }
  $result = $mysqli->query("SELECT Name FROM blog_database WHERE Name == '$name'");
  if($result!=0){
    echo "用户名重复"."<br>";
  }
  else{
    $mysqli->query("INSERT INTO blog_database (Name, Password, Email, m_text, m_addtime) VALUES ('$name','$password','$email','','')");
    session_start();
    $_SESSION['userpassword']=$password; 
    $_SESSION['useremail']=$email;
    echo "注册成功";
    $mysqli->close();
    header("Refresh:2;url=blog1.php");
  }
}
?>

<h2>用户注册界面</h2>
<p><span class="error">* 必需的字段</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
   姓名：<input type="text" name="name" value="<?php echo $name;?>">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   密码：<input type="text" name="password">
   <span class="error">* <?php echo $passwordErr;?></span>
   <br><br>
   邮箱：<input type="text" name="email" value="<?php echo $email;?>">
   <span class="error">* <?php echo $emailErr;?></span>
   <br><br>
   <input type="submit" name="enroll" value="注册">
   <br><br>
</form>

<a href="./blog1.php"><input type="button" name="return" value="返回登录"></a>
<br><br>

</body>
</html>