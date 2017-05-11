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


// ----------- EXTRACTION DES VALEURS DU FORMULAIRE -----------

#On vérifie que les valeurs obligatoires pour l'insertion ont bien été rentrées par l'utilisateur. Sinon, on abandonne directement l'opération.

if ($_POST['action'] == 'Update') {

    extract($_POST);
    #Extraction des valeurs obligatoires (valeurs NON NULL)
    $idc = $_POST['hidden_idclient'];
    $nomc = $_POST['hidden_nomclient'];
    $prenomc = $_POST['hidden_prenomclient'];

    #Extraction des valeurs NULL. Si on détecte qu'elles sont vides, on leur donne une valeur vide.

    echo '<h1>Modification du client</h1>';

    if(empty($_POST['hidden_adresseclient']))
      $adressec = "";
    else
      $adressec = $_POST['hidden_adresseclient'];

    if(empty($_POST['hidden_codepostalclient']))
      $codepostalc = 0;
    else
      $codepostalc = $_POST['hidden_codepostalclient'];

    if(empty($_POST['hidden_villeclient']))
      $villec= "";
    else
      $villec = $_POST['hidden_villeclient'];

    if(empty($_POST['hidden_numtelclient']))
      $numtelc = "";
    else
      $numtelc = $_POST['hidden_numtelclient'];

    if(empty($_POST['hidden_datenaissanceclient']))
      $datenaissancec = "";
    else
      $datenaissancec = $_POST['hidden_datenaissanceclient'];

      if(empty($_POST['hidden_nbachatsclient']))
        $nbachatsc = 0;
      else
        $nbachatsc = $_POST['hidden_nbachatsclient'];

    if(empty($_POST['hidden_commentairesclient']))
      $commentairesc = "";
    else
    {
      $commentairesc = $_POST['hidden_commentairesclient'];
      $commentairesc = addslashes($commentairesc);
      $commentairesc = utf8_decode($commentairesc);
    }





    #Première ligne du tableau (légende)
    echo '<table>';
    echo'<thead>';
    echo'<tr>';
    echo'<th>ID</th>';
    echo'<th>Nom</th>';
    echo'<th>Prénom</th>';
    echo'<th>Adresse</th>';
    echo'<th>Code Postal</th>';
    echo'<th>Ville</th>';
    echo'<th>Num tél</th>';
    echo'<th>Date de naissance</th>';
    echo'<th>Nb achats</th>';
    echo'<th>Commentaires</th>';
    echo'</tr>';
    echo'</thead>';

    #Seconde ligne du tableau (valeurs initiales)
    echo '<tr>';

    echo '<td>' . $idc . '</td>';
    echo '<td>' . utf8_encode($nomc) . '</td>';
    echo '<td>' . utf8_encode($prenomc) . '</td>';
    echo '<td>' . utf8_encode($adressec) . '</td>';
    echo '<td>' .  $codepostalc . '</td>';
    echo '<td>' . $villec . '</td>';
    echo '<td>' .  $numtelc . '</td>';
    echo '<td>' .  $datenaissancec . '</td>';
    echo '<td>' .  $nbachatsc . '</td>';
    echo '<td>' .  utf8_encode($commentairesc) . '</td>';

    echo '</tr>';

    #Troisième ligne du tableau (valeurs à rentrer par l'utilisateur)
    echo '<tr>';

    echo '<td>' . $idc . '</td>';
    echo '<td><input type="text" name="new_nomclient" maxlength="60"></td>';
    echo '<td><input type="text" name="new_prenomclient" maxlength="60"></td>';
    echo '<td><input type="text" name="new_adresseclient" maxlength="200"></td>';
    echo '<td><input type="text" name="new_codepostalclient" maxlength="20"></td>';
    echo '<td><input type="text" name="new_villeclient" maxlength="80"></td>';
    echo '<td><input type="text" name="new_numtelclient" maxlength="20"></td>';
    echo '<td><input type="text" name="new_datenaissanceclient" maxlength="20"></td>';
    echo '<td>' .  $nbachatsc . '</td>';
    echo '<td><input type="text" name="new_commentairesclient" maxlength="250"></td>';

    echo '</tr>';






} else if ($_POST['action'] == 'Delete') {

    //action for delete

} else {

    //invalid action!

}
/*
if(isset($_POST) && !empty($_POST['nomclient']) && !empty($_POST['prenomclient'])) {
  extract($_POST);

  #Extraction des valeurs obligatoires (valeurs NON NULL)
  $nomc = $_POST['nomclient'];
  $prenomc = $_POST['prenomclient'];

  #Extraction des valeurs NULL. Si on détecte qu'elles sont vides, on leur donne une valeur vide.
  if(empty($_POST['adresseclient']))
    $adressec = "";
  else
    $adressec = $_POST['adresseclient'];

  if(empty($_POST['codepostalclient']))
    $codepostalc = 0;
  else
    $codepostalc = $_POST['codepostalclient'];

  if(empty($_POST['villeclient']))
    $villec= "";
  else
    $villec = $_POST['villeclient'];

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
  echo '<p>Insertion effectuée. ' . $nomc . ' ' . $prenomc . ' a été ajouté dans la base de données. </p>';
}


$mysqli->close();

}
else {
  echo '<p>Vous avez oublié de remplir un champ.</p>';
}

include('add_client.php'); // On inclut le formulaire d'identification
exit;*/
?>
