<?php
session_start();
require_once "pdo.php";
if(isset($_POST['email']) && isset($_POST['password'])){
$sql = "SELECT name from users
  WHERE email = :em AND password = :pw";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(
  ':em' => $_POST['email'],
  ':pw' => $_POST['password']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(empty($_POST['email']) || empty($_POST['password'])){
  echo"<h1>Email and password are required</h1>\n";
}
elseif(!str_contains($_POST['email'],"@")){
  echo "<h1>Email must have an at-sign (@)</h1>\n";
}
elseif( ($row === FALSE) ) {
  echo"<h1>Login incorrect.</h1>\n";
  error_log("Login fail ".$_POST['email']);
}
else{
  $_SESSION['userLogin'] = "Loggedin";
  error_log("Login success ".$_POST['email']);
  header("Location: autos.php".urlencode($_POST['who']));
}


}
?>

<html>
<head></head>
<body>
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
<p> Log in </p>
<form method="post">
<p>Email:
<input type="text" name="email"></p>
<p>Password:
<input type="password" name="password"</p>
<p><input type="submit" value="Log in"/></p></form>
</body>
</html>
