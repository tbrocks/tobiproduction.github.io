<?php
require_once "pdo.php";

$failure = false;  // If we have no POST data
$success = false;  // If the record was added

// Demand a GET parameter
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}

// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}

if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
    if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
        $failure = "Mileage and year must be numeric";
    } elseif (strlen($_POST['make']) < 1 ) {
        $failure = "Make is required";
    } else {
        $sql = "INSERT INTO autos (make, year, mileage) VALUES ( :mk, :yr, :mi)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':mk' => $_POST['make'],
            ':yr' => $_POST['year'],
            ':mi' => $_POST['mileage'])
        );
        $success = "Record inserted";
    }
}

$stmt = $pdo->query("SELECT make, year, mileage FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tobias Brocks 73e42833</title>
    <?php require_once "pdo.php"; ?>
</head>
<body>
    <div class="container">
        <!-- Message for guest -->
        <?php
        if ( isset($_REQUEST['name']) ) {
            echo "<h1>Tracking Autos for ";
            echo htmlentities($_REQUEST['name']);
            echo "</h1>\n";
        }
        ?>

        <!-- Error logs -->
        <?php
        if ( $failure !== false ) {
            // Look closely at the use of single and double quotes
            echo('<p style="color: red;">'.htmlentities($failure)."</p>\n");
        }
        if ( $success !== false ) {
            // Look closely at the use of single and double quotes
            echo('<p style="color: green;">'.htmlentities($success)."</p>\n");
        }
        ?>

        <!-- form -->
        <form method="post">
            <label for="make">Maker:</label>
            <input type="text" name="make" id="make"><br/>

            <label for="year">Year:</label>
            <input type="text" name="year" id="year"><br/>

            <label for="mileage">Mileage:</label>
            <input type="text" name="mileage" id="mileage"><br/>

            <input type="submit" name="Add" value="Add">
            <input type="submit" name="logout" value="Logout">
        </form>
        <ul>
            <?php
                foreach($rows as $row) {
                    echo "<li>".htmlentities($row['year'])." ".htmlentities($row['make'])." / ".htmlentities($row['mileage'])."</li>";
                }
            ?>
        </ul>
    </div>
</body>
</html>
