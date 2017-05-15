<head>
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


#On initialise deux booléens, pour vérifier à la fin si tout s'est bien passé.
$erreurUpdate = False;
$aucuneInsertion = True;

// ----------- EXTRACTION DES VALEURS DU FORMULAIRE -----------

#On vérifie que les valeurs obligatoires pour l'insertion ont bien été rentrées par l'utilisateur. Sinon, on abandonne directement l'opération.
if(isset($_POST)) {
  extract($_POST);

  #Mise à jour du nom du produit
  if(!empty($_POST['new_nomproduit']))
  {
    $aucuneInsertion = False;
    $sqlp = "UPDATE produit SET nom=\"" . $_POST['new_nomproduit'] . "\" WHERE id_produit = " . $_POST['new_idproduit'] . ";";
    $mysqli->query($sqlp);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour du nom du produit. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlp", $mysqli->errno);
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
          }
    }
  }


  #Mise à jour du prix du produit
  if(!empty($_POST['new_prixproduit']))
  {
    $aucuneInsertion = False;
    $sqlp = "UPDATE produit SET prix=\"" . $_POST['new_prixproduit'] . "\" WHERE id_produit = " . $_POST['new_idproduit'] . ";";
    $mysqli->query($sqlp);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour du prix du produit. Voici l\'erreur, à montrer à un développeur comprenant le SQL : </p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlp", $mysqli->errno);
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
          }
    }
  }

  #Mise à jour du coût du produit
  if(!empty($_POST['new_coutproduit']))
  {
    $aucuneInsertion = False;
    $sqlp = "UPDATE produit SET cout=\"" . $_POST['new_coutproduit'] . "\" WHERE id_produit = " . $_POST['new_idproduit'] . ";";
    $mysqli->query($sqlp);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour du coût du produit. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlp", $mysqli->errno);
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
          }
    }
  }

  #Mise à jour des matériaux du produit
  if(!empty($_POST['new_materiauxproduit']))
  {
    $aucuneInsertion = False;
    $sqlp = "UPDATE produit SET materiaux=\"" . $_POST['new_materiauxproduit'] . "\" WHERE id_produit = " . $_POST['new_idproduit'] . ";";
    $mysqli->query($sqlp);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour des matériaux du produit. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlp", $mysqli->errno);
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
          }
    }
  }

$mysqli->close();

}
else {
  echo '<p>Les champs n\ont pas été correctement remplis.</p>';
}

if($aucuneInsertion == FALSE && $erreurUpdate == FALSE)
{
  echo 'La modification du produit s\'est bien déroulée.';
}

include('list_produits.php'); // On inclut le formulaire d'identification
exit;
?>
