<?php // Do not put any HTML above this line

if ( isset($_POST['cancel'] ) ) {
    // Redirect the browser to game.php
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
// $stored_hash = 'a8609e8d62c043243c4e201cbb342862';  // Pw is meow123
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123

$failure = false;  // If we have no POST data

// Check to see if we have some POST data, if we do process it
if ( isset($_POST['who']) && isset($_POST['pass']) ) {
    if ( strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1 ) {
        $failure = "User name and password are required";
    } elseif(strpos($_POST['who'], '@') === false) {
        $failure = "Email must have an at-sign (@)";
    } else {
        $check = hash('md5', $salt.$_POST['pass']);
        if ( $check == $stored_hash ) {
            error_log("Login success ".$_POST['who']);
            // Redirect the browser to autos.php
            header("Location: autos.php?name=".urlencode($_POST['who']));
            return;
        } else {
            error_log("Login fail ".$_POST['who']." $check");
            $failure = "Incorrect password";
        }
    }
}

// // // // // // // // // // // // // // // // // //
// Fall through into the View
?>
<!DOCTYPE html>
<html>
<head>
    <?php require_once "pdo.php"; ?>
    <title>Tobias Brocks 73e42833</title>
</head>
<body>
    <div class="container">
        <h1>Please Log In</h1>

        <?php
        if ( $failure !== false ) {
            // Look closely at the use of single and double quotes
            echo('<p style="color: red;">'.htmlentities($failure)."</p>\n");
        }
        ?>

        <form method="POST">
            <label for="nam">User Name</label>
            <input type="text" name="who" id="nam"><br/>
            <label for="id_1723">Password</label>
            <input type="text" name="pass" id="id_1723"><br/>
            <input type="submit" value="Log In">
            <input type="submit" name="cancel" value="Cancel">
        </form>

    </div>
</body>
