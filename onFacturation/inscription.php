<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
</head>

<body>
  <h1>Inscription</h1>

  <form action="<?= $_SERVER['PHP_SELF'] ?> " method="post">
    <input type="text" name="pseudo" placeholder="Votre pseudo">
    <br>
    <br>

    <input type="text" name="password" placeholder="Votre mot de passe">
    <br>
    <br>

    <input type="text" name="email" placeholder="Votre mail">
    <br>
    <br>

    <input type="submit" value="Valider">
    <br>
    <br>

  </form>

  <?php
  //Etape1 Inclusion des paramètres de connexion
  include_once("myparams.php");

  //Etape2 Connexion au serveur
  $createFact = new mysqli(HOST, USER, PASS, "onFacturation", PORT);

  if (!$createFact) {
    echo "Connexion impossible à la base";
    exit();
  } else {
    // On vérifie que tous les champs du formulaire sont renseignés, si un champs vide on met la variable $formValid à true
    $formValid = false;
    foreach ($_POST as $cle => $valeur) {
      if (empty($_POST[$cle])) {
        $formValid = true;
      } else {
        $pseudo = $createFact->escape_string($_POST['pseudo']);
        $password = $createFact->escape_string($_POST['password']);
        $email = $createFact->escape_string($_POST['email']);

        //hashage de mdp
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);

        //Verification if exist via Email
        // $request = "SELECT count(*) as countEmail FROM membres WHERE email = '$email'";


        // $result = mysqli_query($createFact, $request);

        // // Vérifiaction si email exist
        // // $row_count = $result->num_rows;

        // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        // $active = $row['active'];

        // $count = mysqli_num_rows($result);
        // echo "$count";
        // if ($count == 1) {
        //   echo "Email already exist";
        // } else {
          $request = "INSERT INTO membres(pseudo, password, email) VALUES ('$pseudo', '$pass_hash', '$email')";
          $result = mysqli_query($createFact, $request);
        }

        // if ($resulta) {
        //   echo "Bravo Account Created";
        //   echo "<br>";
        // } else {
        //   echo "Sorry not working bro";
        //   echo "<br>";
        // }


        $createFact->close();
      }
    }
    echo "<br>";
    echo "Veuillez remplir tous les champs du formulaire !";
  }


  ?>


</body>

</html>