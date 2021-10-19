<?php
session_start();
if(!isset($_SESSION['userLogin'])){
    die("Name parameter missing");
}
else {
  echo "<br>You are logged in !</br>";
}

if(isset($_POST['Logout'])){
  session.start();
  session.destroy();
  header('Location: index.php');
}

require_once "pdo.php";

if(isset($_POST['mileage']) && isset($_POST['year']) && isset($_POST['make']) && !is_numeric($_POST['mileage']) || !is_numeric($_POST['year'])){
  echo "<br>Mileage and year must be numeric</br>";
}
elseif(empty($_POST['make'])){
  echo "<br>Make is required</br>";
}
elseif(isset($_POST['mileage']) && isset($_POST['year']) && isset($_POST['make'])) {
  $sql = "INSERT INTO autos (make, year, mileage)
        VALUES (:make, :year, :mileage)";
  echo("<pre>\n".$sql."\n</pre>\n");
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':make' => $_POST['make'],
    ':year' => $_POST['year'],
    ':mileage' => $_POST['mileage']
  ));
echo '<font color="green">' . "Record inserted" . '</font><br>';
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

</style>
<body><table border="1">
<?php
$stmt = $pdo->query("SELECT mileage, year, make FROM autos");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  echo"<tr><td>";
  echo(htmlentities($row['mileage']));
  echo("</td><td>");
  echo(htmlentities($row['year']));
  echo("</td><td>");
  echo(htmlentities($row['make']));
  echo("</td></tr>\n");

}
 ?>
<br><a href="logout.php">Log Out</a></br>
<body class="homepage">
<p> AddAuto </p>
<form method="post">
<p>Mileage:
<input type="text" name="mileage"></p>
<p>Year:
<input type="text" name="year"></p>
<p>Make:
<input type="text" name="make"</p>
<p><input type="submit" value="Add"/></p></form>

</body>
</html>
