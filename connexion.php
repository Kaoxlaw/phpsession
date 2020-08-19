<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Connexion</h1>

  <form action="<?= $_SERVER['PHP_SELF'] ?> " method="post">
    <input type="text" name="pseudo" placeholder="Votre pseudo">
    <input type="text" name="password" placeholder="Votre mot de passe">
    <input type="submit" value="Connexion">
  </form>

  <?php
  $pseudo = "monPseudo";
  $password = "monPassword";

  if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
    if ($_POST['pseudo'] == $pseudo && $_POST['password'] == $password) {

      session_start();
      $_SESSION['pseudo'] = $pseudo;
      $_SESSION['password'] = $password;

      //page when login ok
      header('location: moncompte.php');
    }
  } else {
    echo "Please LogIn!";
  }
  ?>

  <br>
  <br>
  <a href="index.php">Back To Home</a>
  <br>
  <a href="index2.php">To page 2</a>


</body>

</html>