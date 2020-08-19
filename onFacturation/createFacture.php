<?php
session_start();
if (isset($_SESSION['pseudo']) && isset($_SESSION['id_membre'])) {
  $id_membre = $_SESSION['id_membre'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Création de factures</title>
</head>

<body>
  <h1>Créer une facture</h1>
  <?php
    echo "Welcome " . $_SESSION['pseudo'];
    ?>
  <br>
  <br>
  <br>
  <fieldset>
    <legend>Créer votre facture</legend>
    <form action="<?= $_SERVER['PHP_SELF'] ?> " method="post">
      <table>
        <tr>
          <td>Numéro de la facture:</td>
          <td><input type="text" name="num"></td>
        </tr>
        <tr>
          <td>Numéro de la TVA:</td>
          <td><input type="numeric" name="numtva"></td>
        </tr>
        <tr>
          <td>Client</td>
          <td><input type="text" name="client"></td>
        </tr>
        <tr>
          <td>Mail Client</td>
          <td><input type="text" name="mailclient"></td>
        </tr>
        <tr>
          <td>Date de la facture:</td>
          <td><input type="date" name="datefacture"></td>
        </tr>
        <tr>
          <td>Info Entreprise:</td>
          <td><input type="text" name="facturede"></td>
        </tr>
        <tr>
          <td>Désignation:</td>
          <td><input type="text" name="designation"></td>
        </tr>
        <tr>
          <td>Quantité:</td>
          <td><input type="numeric" name="quantite"></td>
        </tr>
        <tr>
          <td>Prix Hors Taxe:</td>
          <td><input type="numeric" name="prixht"></td>
        </tr>
        <tr>
          <td>Taxe:</td>
          <td><input type="numeric" name="taxe"></td>
        </tr>
        <tr>
          <td>Conditions:</td>
          <td><input type="text" name="conditions"></td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="Valider">
          </td>
        </tr>
      </table>
  </fieldset>
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
          $num = $createFact->escape_string($_POST['num']);
          $numtva = $createFact->escape_string($_POST['numtva']);
          $client = $createFact->escape_string($_POST['client']);
          $mailclient = $createFact->escape_string($_POST['mailclient']);
          $datefacture = $createFact->escape_string($_POST['datefacture']);
          $facturede = $createFact->escape_string($_POST['facturede']);
          $designation = $createFact->escape_string($_POST['designation']);
          $quantite = $createFact->escape_string($_POST['quantite']);
          $prixht = $createFact->escape_string($_POST['prixht']);
          $taxe = $createFact->escape_string($_POST['taxe']);
          $conditions = $createFact->escape_string($_POST['conditions']);


          $request = "INSERT INTO facture(num, numtva, client, mailclient, datefacture, facturede, designation, quantite, 
        prixht, taxe, conditions, id_membre) VALUES ('$num', '$numtva', '$client', '$mailclient', '$datefacture', '$facturede', '$designation', '$quantite', 
        '$prixht', '$taxe', '$conditions', '$id_membre')";

          $result = $createFact->query($request);

          $createFact->close();
        }
      }
      echo "<br>";
      echo "Veuillez remplir tous les champs du formulaire !";
    }
    ?>
  <br>
  <a href="moncompte.php">Go back to my Account</a>
  <br>
  <a href="detailFacture.php">Consulter une Facture</a>
  <br>
  <a href="listeFacture.php">Consulter la liste des factures</a>
  <br>
</body>

</html>
<?php
} else {
  echo "You're not allowed to access to this page!";
  echo "<br/><a href=\"connexion.php\">Go to Login</a>";
};

?>