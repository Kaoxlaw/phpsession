<?php
session_start();
if (isset($_SESSION['pseudo']) && isset($_SESSION['id_membre'])) {
  $id_membre = $_SESSION['id_membre'];
?>
<!DOCTYPE html>
<html>

<head>
  <title>Liste des factures</title>
</head>

<body>
  <h1>Liste des factures <?= $_SESSION['pseudo'] ?> </h1>

  <!-- <form action="listeFacture.php" method="post">
    <fieldset id="main">
      <legend>Afficher la Liste :</legend>
      <label>Mon Id:</label>
      <input type="text" name="id_membre">
      <br><br>
      <input type="submit" value="Envoyer">
      <input type="reset" value="Annuler">
    </fieldset>
  </form> -->
  <br>

  <?php
    // Etape 0 : Créer la base de données

    //Etape 1: Inclusion des paramètres de connexion
    include_once('myparams.php');

    //Etape 2: Connexion au serveur de base de données MySQL
    $createFact = new mysqli(HOST, USER, PASS, "onFacturation", PORT);

    //Etape 3: Test de la connexion
    if (!$createFact) {
      echo "Connexion impossible";
      exit(); //On arrete tout, on sort du script
    }

    $requete = " SELECT * FROM facture WHERE id_membre = '$id_membre' ";

    $result = $createFact->query($requete);

    echo "<table border>
        <tr>
        <td>ID de la facture</td>
        <td>Numéro de la facture</td>
        <td>Client</td>
        <td>Date de la facture</td>
        <td>Actions</td>
        </tr>";


    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      echo "<tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['num'] . "</td>
            <td>" . $row['client'] . "</td>
            <td>" . $row['datefacture'] . "</td>
            <td> 
            <a href=\"detailFacture.php?=" . $row['id'] . "\">Details</a><br/>
            <a href=\"imprimer-facture.php?=" . $row['id'] . "\">Télécharger au format PDF</a>
            </td>
            </tr>";
      //$_SESSION['id_facture'] = $row['id'];
    }

    //$id_facture = $_SESSION['id'];
    //Etape 9 et dernière étape: On ferme la connexion
    $createFact->close();

    echo "</table>";
    ?>
  <br>
  <a href="moncompte.php">Go back to my Account</a>
  <br>
  <a href="createFacture.php">Creer une Facture</a>
  <br>
  <a href="detailFacture.php">Consulter une Facture</a>
  <br>
</body>

</html>
<?php
} else {
  echo "You're not allowed to access to this page!";
  echo "<br/><a href=\"connexion.php\">Go to Login</a>";
};

?>