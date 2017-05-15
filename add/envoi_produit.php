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



// ----------- EXTRACTION DES VALEURS DU FORMULAIRE -----------

#On vérifie que les valeurs obligatoires pour l'insertion ont bien été rentrées par l'utilisateur. Sinon, on abandonne directement l'opération.
if(isset($_POST) && !empty($_POST['nomproduit']) && !empty($_POST['prixproduit'])) {
  extract($_POST);

  #Extraction des valeurs obligatoires (valeurs NON NULL)
  $nomp = $_POST['nomproduit'];
  $prixp = $_POST['prixproduit'];

  #Extraction des valeurs NULL. Si on détecte qu'elles sont vides, on leur donne la valeur NULL.
  if(empty($_POST['descriptifproduit']))
    $descriptifp = "";
  else
  {
    $descriptifp = $_POST['descriptifproduit'];
    $descriptifp = addslashes($descriptifp);
  }

  if(empty($_POST['coutproduit']))
    $coutp = 0;
  else
    $coutp = $_POST['coutproduit'];

  if(empty($_POST['materiauxproduit']))
    $materiauxp = "";
  else
    $materiauxp = $_POST['materiauxproduit'];


// ----------- INSERTION DES VALEURS DANS LA BASE DE DONNEES -----------

$sqlp = "INSERT INTO PRODUIT (nom, descriptif, prix, cout, materiaux) VALUES(\"$nomp\", \"$descriptifp\",
  \"$prixp\", \"$coutp\", \"$materiauxp\");";

$mysqli->query($sqlp);


echo '<p>Insertion effectuée. ' . $nomp . ' a été ajouté dans la base de données. </p>';


$mysqli->close();





}
else {
  echo '<p>Vous avez oublié de remplir un champ.</p>';
}

include('add_produit.php'); // On inclut le formulaire d'identification
exit;
?>
