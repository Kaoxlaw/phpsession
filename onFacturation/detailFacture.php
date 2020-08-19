<?php
session_start();
if (isset($_SESSION['pseudo']) && isset($_SESSION['id_membre'])) {
  $id_membre = $_SESSION['id_membre'];

?>
<!DOCTYPE html>
<html>

<head>
  <title>Détails d'une facture</title>
</head>

<body>
  <h1>Détails de la facture <?= $_SESSION['pseudo']  ?> </h1>

  <!-- <form action="detailFacture.php" method="post">
    <fieldset id="main">
      <legend>Afficher le détails de la facture :</legend>
      <label>Id Facture:</label>
      <input type="numeric" name="id">
      <br><br>
      <input type="submit" value="Envoyer">
      <input type="reset" value="Annuler">
    </fieldset>
  </form> -->
  <br>

  <?php
    //Etape 1: Inclusion des paramètres de connexion
    include_once('myparams.php');

    //Etape 2: Connexion au serveur de base de données MySQL
    $createFact = new mysqli(HOST, USER, PASS, "onFacturation", PORT);

    //Etape 3: Test de la connexion
    if (!$createFact) {
      echo "Connexion impossible";
      exit(); //On arrete tout, on sort du script
    }

    if (isset($_GET['id'])) {
      $id = array($_GET['id']);
      // echo $_GET['id'];

      $requete = "SELECT * FROM facture WHERE id = '$id'";

      $result = mysqli_query($createFact, $requete);

      echo "<table border>";

      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        echo "<tr>
            <td>Numéro de la facture</td>
            <td>" . $row['num'] . "</td>
            </tr>
            <tr>
            <td>Numéro de la TVA</td>
            <td>" . $row['numtva'] . "</td>
            </tr>
            <tr>
            <td>Client</td>
            <td>" . $row['client'] . "</td>
            </tr>
            <tr>
            <td>Mail du client</td>
            <td>" . $row['mailclient'] . "</td>
            </tr>
            <tr>
            <td>Date de la facture</td>
            <td>" . $row['datefacture'] . "</td>
            </tr>
            <tr>
            <td>Infos de mon entreprise</td>
            <td>" . $row['facturede'] . "</td>
            </tr>
            <tr>
            <td>Designation</td>
            <td>Quantité</td>
            <td>Prix HT</td>
            <td>Taxe</td>
            </tr>
            <tr>
            <td>" . $row['designation'] . "</td>
            <td>" . $row['quantite'] . "</td>
            <td>" . $row['prixht'] . "</td>
            <td>" . $row['taxe'] . "</td>
            </tr>
            
            ";
      }

      //Etape 9 et dernière étape: On ferme la connexion
      $createFact->close();

      echo "</table>";
    }
    ?>
  <br>
  <a href="moncompte.php">Go back to my Account</a>
  <br>
  <a href="createFacture.php">Creer une Facture</a>
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