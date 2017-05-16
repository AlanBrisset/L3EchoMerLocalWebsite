<head>
  <link rel="stylesheet" href="/echomer/style.css" type="text/css">
  <script type="text/javascript" src="/echomer/js/trieurTableau.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<?php


#envoi_produit.php
#Récupère les données du formulaire add_vente.php et les insère dans la base de données.

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
    $idv = $_POST['hidden_idvente'];
    $nomclientv = $_POST['hidden_nomclientvente'];
    $idproduitv = $_POST['hidden_idproduitvente'];
    $nomproduitv = $_POST['hidden_nomproduitvente'];
    $quantitev = $_POST['hidden_quantitevente'];
    $prixv = $_POST['hidden_prixvente'];
    $moyenachatv = $_POST['hidden_moyenachatvente'];

    #Extraction des valeurs NULL. Si on détecte qu'elles sont vides, on leur donne une valeur vide.

    echo '<h1>Modification de la vente</h1>';

    if(empty($_POST['hidden_idclientvente']))
      $idclientv = "";
    else
      $idclientv = $_POST['hidden_idclientvente'];

    if(empty($_POST['hidden_dateachatvente']))
      $dateachatv = "";
    else
      $dateachatv = $_POST['hidden_dateachatvente'];

    if(empty($_POST['hidden_commentairesvente']))
      $commentairesv = "";
    else
      $commentairesv = $_POST['hidden_commentairesvente'];


    #Première ligne du tableau (légende)
    echo '<table>';
    echo'<tr>';
    echo'<th><a href="#" onclick="sortTable(this,1); return false;">ID vente</th>';
    echo'<th><a href="#" onclick="sortTable(this,2); return false;">ID client</th>';
    echo'<th><a href="#" onclick="sortTable(this,3); return false;">Nom du client</th>';
    echo'<th><a href="#" onclick="sortTable(this,4); return false;">ID produit</th>';
    echo'<th><a href="#" onclick="sortTable(this,5); return false;">Nom du produit</th>';
    echo'<th><a href="#" onclick="sortTable(this,6); return false;">Nb d\'articles achetés</th>';
    echo'<th><a href="#" onclick="sortTable(this,7); return false;">Prix total</th>';
    echo'<th>Date de la vente</th>';
    echo'<th><a href="#" onclick="sortTable(this,9); return false;">Plateforme de la vente</th>';
    echo'<th>Commentaires</th>';

    #Seconde ligne du tableau (valeurs initiales)
    echo '<tr>';

    echo '<td>' . $idv . '</td>';
    echo '<td>' . $idclientv . '</td>';
    echo '<td>' . utf8_encode($nomclientv) . '</td>';
    echo '<td>' . $idproduitv . '</td>';
    echo '<td>' . utf8_encode($nomproduitv) . '</td>';
    echo '<td>' . $quantitev . '</td>';
    echo '<td>' . $prixv . '</td>';
    echo '<td>' . $dateachatv . '</td>';
    echo '<td>' . $moyenachatv . '</td>';
    echo '<td>' .  utf8_encode($commentairesv) . '</td>';

    echo '</tr>';

    #Troisième ligne du tableau (valeurs à rentrer par l'utilisateur)
    echo '<tr>';

    echo '<form action="update_confirmed_vente.php" method="post">';

    echo '<td><input type="hidden" name="new_idvente" value=' . $idv . ' >' . $idv . '</td>';
    echo '<td><input type="hidden" name="new_idclient" value=' . $idclientv . ' >' . $idclientv . '</td>';
    echo '<td><input type="hidden" name="new_nomclient" value=' . $nomclientv . ' >' . $nomclientv . '</td>';
    echo '<td><input type="hidden" name="new_idproduit" value=' . $idproduitv . ' >' . $idproduitv . '</td>';
    echo '<td><input type="hidden" name="new_nomproduit" value=' . $nomproduitv . ' >' . $nomproduitv . '</td>';

    echo '<td><input type="text" name="new_quantitevente" maxlength="60"></td>';
    echo '<td><input type="text" name="new_prixvente" maxlength="60"></td>';
    echo '<td><input type="text" name="new_dateachatvente" maxlength="200"></td>';
    if(stripos($moyenachatv, 'Papier') !== FALSE)
    {
      echo'<td><select name="new_moyenachatvente" size="1">
        <option value="Papier" selected="selected">Papier</option>
        <option value="Internet">Internet</option>
      </select></td>';
    }
    else
    {
      echo'<td><select name="new_moyenachatvente" size="1">
        <option value="Papier">Papier</option>
        <option value="Internet" selected="selected">Internet</option>
      </select></td>';
    }
    echo '<td><input type="text" name="new_commentairesvente" maxlength="250"></td>';

    echo '</tr>';
    echo '</table>';

    echo'<br/>';

    echo '<input type="submit" name="action" value="Modifier"/>';
    echo '</form><br/><br/>';

    echo'<a href="/echomer">Retour à l\'accueil</a>';



} else if ($_POST['action'] == 'Delete') {

  $idv = $_POST['hidden_idvente'];

  $sqlc = "DELETE FROM vente WHERE id_vente = " . $idv . ";";
  $mysqli->query($sqlc);

  if ($mysqli->error) {
      echo '<p>Erreur durant la suppression de la vente. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
      try {
        throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlc", $mysqli->errno);
      } catch(Exception $e ) {
          echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
          echo nl2br($e->getTraceAsString());
        }
  }

  else {
    echo '<h2>Suppression de la vente réussie !<h2><br/>';
  }

  include('list_ventes.php');



} else {

    echo '<p>Quelque chose s\'est mal déroulé..</p>';
    include('list_ventes.php');

}


echo '</body>';
?>

<br/>
<br/>
