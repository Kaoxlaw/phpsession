<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Session 1</title>
</head>

<body>

  <h1>Home</h1>

  <?php
  session_start();
  $_SESSION['prenom'] = "Mickael";
  $_SESSION['ville'] = "MickaeLand";
  // $prenom = "Mickael";
  echo "Welcome " . $_SESSION['prenom'] . " from " . $_SESSION['ville'];

  ?>

  <br>
  <br>

  <a href="index2.php">To page 2</a>
  <br>
  <a href="connexion.php">To connexion</a>

</body>

</html>