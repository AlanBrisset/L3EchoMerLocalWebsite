<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

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
if(isset($_POST) && !empty($_POST['nomclient']) && !empty($_POST['prenomclient'])) {
  extract($_POST);

  #Extraction des valeurs obligatoires (valeurs NON NULL)
  $nomc2 = $_POST['nomclient'];
  $nomc = addslashes($nomc2);
  $nomc = utf8_decode($nomc);

  $prenomc2 = $_POST['prenomclient'];
  $prenomc = addslashes($prenomc2);
  $prenomc = utf8_decode($prenomc);

  #Extraction des valeurs NULL. Si on détecte qu'elles sont vides, on leur donne une valeur vide.
  if(empty($_POST['adresseclient']))
    $adressec = "";
  else
  {
    $adressec = $_POST['adresseclient'];
    $adressec = utf8_decode($adressec);
  }

  if(empty($_POST['codepostalclient']))
    $codepostalc = 0;
  else
  {
    $codepostalc = $_POST['codepostalclient'];
    $adressec = addslashes($adressec);
    $adressec = utf8_decode($adressec);
  }

  if(empty($_POST['villeclient']))
    $villec= "";
  else
  {
    $villec = $_POST['villeclient'];
    $villec = addslashes($villec);
    $villec = utf8_decode($villec);
  }

  if(empty($_POST['numtelclient']))
    $numtelc = "";
  else
    $numtelc = $_POST['numtelclient'];

  if(empty($_POST['datenaissanceclient']))
    $datenaissancec = "";
  else
    $datenaissancec = $_POST['datenaissanceclient'];

  if(empty($_POST['commentairesclient']))
    $commentairesc = "";
  else
  {
    $commentairesc = $_POST['commentairesclient'];
    $commentairesc = addslashes($commentairesc);
    $commentairesc = utf8_decode($commentairesc);
  }

// ----------- INSERTION DES VALEURS DANS LA BASE DE DONNEES -----------

$sqlc = "INSERT INTO CLIENT (nom, prenom, adresse, codepostal, ville, num_tel, date_naissance, commentaires) VALUES(\"$nomc\", \"$prenomc\", \"$adressec\" , \"$codepostalc\" , \"$villec\" , \"$numtelc\", \"$datenaissancec\", \"$commentairesc\")";

$mysqli->query($sqlc);

if ($mysqli->error) {
    echo '<p>Erreur durant l\'insertion. Le client que vous cherchez à insérer existe peut-être déjà dans la base de données.</p>';
}
else {
  echo '<p>Insertion effectuée. ' . $nomc2 . ' ' . $prenomc2 . ' a été ajouté dans la base de données. </p>';
}


$mysqli->close();

}
else {
  echo '<p>Vous avez oublié de remplir un champ.</p>';
}

include('add_client.php'); // On inclut le formulaire d'identification
exit;
?>
