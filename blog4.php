<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BLOG</title>
</head>
<body>
  <h1>
    <?php
    session_start();
    $username = $_SESSION['username'];
    echo "WELCOME:";
    echo "<br>";
    echo "$username";
    ?>
  </h1>
  <h2>WRITE DOWN WHAT YOU WANT TO SAY TO THE WORLD!</h2>
  <form action="blog5.php" method="post">
    <li>
      <label for="message">你的留言</label>
      <br><br>
      <textarea id="m_text" name="m_text" rows="4" cols="100"></textarea>
      <br><br>
      <input type="submit" name="submit" value="发表">
    </li>
    <br><br>
    <a href="./blog3.php"><input type="button" name="return" value="返回主页"></a>
  </form>
</body>
</html>