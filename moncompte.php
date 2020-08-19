<?php
session_start();
if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mon compte</title>
</head>

<body>
  <h1>Your Account</h1>

  <?php
    echo "Welcome " . $_SESSION['pseudo'];
    ?>

</body>

</html>
<?php
} else {
  echo "You're not allowed to access to this page!";
  echo "<br/><a href=\"connexion.php\">Go to Login</a>";
};

?>