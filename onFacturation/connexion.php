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

  // $pseudo = "azerty";
  // $password = "zertya";
  // $id_membre = 1;

  // if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
  //   if ($_POST['pseudo'] == $pseudo && $_POST['password'] == $password) {
  //     //on devrait faire un select et vérifier que les données saisies correspondent 
  //     // à celles qui sont dans la base de données 
  //     session_start(); //on créé une session
  //     $_SESSION['pseudo'] = $pseudo;
  //     $_SESSION['password'] = $password;
  //     $_SESSION['id_membre'] = $id_membre;

  //Etape1 Inclusion des paramètres de connexion
  include_once("myparams.php");

  //Etape2 Connexion au serveur
  $createFact = new mysqli(HOST, USER, PASS, "onFacturation", PORT);

  if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {

    // session_start();
    $pseudo = $createFact->escape_string($_POST['pseudo']);
    $password = $createFact->escape_string($_POST['password']);


    $request = "SELECT id_membre FROM membres WHERE pseudo = '$pseudo' and password = '$password'";

    $result = mysqli_query($createFact, $request);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    if ($count == 1) {

      $_SESSION['pseudo'] = $pseudo;

      //page when login ok
      header('location: moncompte.php');
    } else {
      echo "Please LogIn!";
    }
  }
  ?>

  <br>
  <br>
  <a href="index.php">Back To Home</a>
  <br>
  <a href="index2.php">To page 2</a>


</body>

</html>