<?php
require_once "pdo.php";
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && !str_contains($_POST['email'],"@")){
  echo "<br>Email must have an at-sign (@)</br>";
}
elseif(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])){
  echo "<br>Please fill out the whole From !</br>";
}
elseif(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && str_contains($_POST['email'],"@")) {
  $sql = "INSERT INTO users (name, email, password)
        VALUES (:name, :email, :password)";
  echo("<pre>\n".$sql."\n</pre>\n");
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':name' => $_POST['name'],
    ':email' => $_POST['email'],
    ':password' => $_POST['password']
  ));
}
 ?>
<html>
<head></head>
<style>
body {
  background-color: #0d0d0d;
  color:white;
  font-family: Helvetica, serif;
  font-size: 20px;
}

ul.bar {
  list-style-type: none;
  margin: 0;
  padding-bottom: 50px;
  overflow: hidden;
  background-color: inherit;
}
ul.bar li {
  float: left;
}

</style>
<body>
  <body class="homepage">
      <ul class="bar">
        <li style="padding-right:30px;"><a href= "login.php">Log In</a></li>
        <li><a href= "index.php">Registration</a></li>
        </div>
      </ul>
<p> Registry </p>
<form method="post">
<p>Name:
<input type="text" name="name" size="40"></p>
<p>Email:
<input type="text" name="email"></p>
<p>Password:
<input type="password" name="password"</p>
<p><input type="submit" value="Add New"/></p></form>
</body>
</html>
