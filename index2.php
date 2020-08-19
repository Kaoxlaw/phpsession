<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Session 2</title>
</head>

<body>

  <h1>Page 2</h1>
  <?php
  session_start();
  echo "ReWelcome " . $_SESSION['prenom'] . " from " . $_SESSION['ville'] . " always";
  ?>


  <br>
  <br>

  <a href="index.php">Back To Home</a>
  <br>
  <a href="connexion.php">To connexion</a>

</body>

</html>