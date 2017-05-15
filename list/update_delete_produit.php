<head>
  <link rel="stylesheet" href="/echomer/style.css" type="text/css">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<?php


#envoi_produit.php
#Récupère les données du formulaire add_produit.php et les insère dans la base de données.

// ----------- CONNEXION A LA BASE DE DONNEES -----------

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "echomer";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $databasename);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error . "\n");
}

echo '<body>';

// ----------- EXTRACTION DES VALEURS DU FORMULAIRE -----------

#On vérifie que les valeurs obligatoires pour l'insertion ont bien été rentrées par l'utilisateur. Sinon, on abandonne directement l'opération.

if ($_POST['action'] == 'Update') {

    extract($_POST);
    #Extraction des valeurs obligatoires (valeurs NON NULL)
    $idp = $_POST['hidden_idproduit'];
    $nomp = $_POST['hidden_nomproduit'];
    $prixp = $_POST['hidden_prixproduit'];

    #Extraction des valeurs NULL. Si on détecte qu'elles sont vides, on leur donne une valeur vide.

    echo '<h1>Modification du produit</h1>';

    if(empty($_POST['hidden_descriptifproduit']))
      $descriptifp = "";
    else
      $descriptifp = $_POST['hidden_descriptifproduit'];

    if(empty($_POST['hidden_coutproduit']))
      $coutp = 0;
    else
      $coutp = $_POST['hidden_coutproduit'];

    if(empty($_POST['hidden_materiauxproduit']))
      $materiauxp= "";
    else
    {
      $materiauxp = $_POST['hidden_materiauxproduit'];
      $materiauxp = addslashes($materiauxp);
      $materiauxp = utf8_decode($materiauxp);
    }

    #Première ligne du tableau (légende)
    echo '<table>';
    echo'<thead>';
    echo'<tr>';
    echo'<th>ID</th>';
    echo'<th>Nom</th>';
    echo'<th>Descriptif</th>';
    echo'<th>Prix</th>';
    echo'<th>Coût</th>';
    echo'<th>Matériaux</th>';
    echo'</tr>';
    echo'</thead>';

    #Seconde ligne du tableau (valeurs initiales)
    echo '<tr>';

    echo '<td>' . $idp . '</td>';
    echo '<td>' . utf8_encode($nomp) . '</td>';
    echo '<td>' . utf8_encode($descriptifp) . '</td>';
    echo '<td>' . $prixp . '</td>';
    echo '<td>' . $coutp . '</td>';
    echo '<td>' . $materiauxp . '</td>';

    echo '</tr>';

    #Troisième ligne du tableau (valeurs à rentrer par l'utilisateur)
    echo '<tr>';

    echo '<form action="update_confirmed_produit.php" method="post">';

    echo '<td><input type="hidden" name="new_idproduit" value=' . $idp . ' >' . $idp . '</td>';
    echo '<td><input type="text" name="new_nomproduit" maxlength="60"></td>';
    echo '<td><input type="text" name="new_descriptifproduit" maxlength="250"></td>';
    echo '<td><input type="text" name="new_prixproduit" maxlength="10"></td>';
    echo '<td><input type="text" name="new_coutproduit" maxlength="10"></td>';
    echo '<td><input type="text" name="new_materiauxproduit" maxlength="200"></td>';

    echo '</tr>';
    echo '</table>';

    echo'<br/>';

    echo '<input type="submit" name="action" value="Modifier"/>';
    echo '</form><br/><br/>';

    echo'<a href="/echomer">Retour à l\'accueil</a>';



} else if ($_POST['action'] == 'Delete') {

  $idc = $_POST['hidden_idproduit'];

  $sqlc = "DELETE FROM produit WHERE id_produit = " . $idc . ";";
  $mysqli->query($sqlc);

  if ($mysqli->error) {
      echo '<p>Erreur durant la suppression du produit. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
      try {
        throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlc", $mysqli->errno);
      } catch(Exception $e ) {
          echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
          echo nl2br($e->getTraceAsString());
        }
  }

  else {
    echo '<h2>Suppression du produit réussie !<h2><br/>';
  }

  include('list_produits.php');



} else {

    echo '<p>Quelque chose s\'est mal déroulé..</p>';
    include('list_produits.php');

}


echo '</body>';
?>

<br/>
<br/>
