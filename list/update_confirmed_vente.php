<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<?php


#envoi_vente.php
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


#On initialise deux booléens, pour vérifier à la fin si tout s'est bien passé.
$erreurUpdate = False;
$aucuneInsertion = True;

// ----------- EXTRACTION DES VALEURS DU FORMULAIRE -----------

#On vérifie que les valeurs obligatoires pour l'insertion ont bien été rentrées par l'utilisateur. Sinon, on abandonne directement l'opération.
if(isset($_POST)) {
  extract($_POST);

  #Mise à jour du nom du vente
  if(!empty($_POST['new_nomvente']))
  {
    $aucuneInsertion = False;
    $sqlp = "UPDATE vente SET quantite=\"" . $_POST['new_quantitevente'] . "\" WHERE id_vente = " . $_POST['new_idvente'] . ";";
    $mysqli->query($sqlp);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour de la quantité de produits achétés dans cette vente. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlp", $mysqli->errno);
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
          }
    }
  }

  #Mise à jour du prix de la vente
  if(!empty($_POST['new_prixvente']))
  {
    $aucuneInsertion = False;
    $sqlp = "UPDATE vente SET prix=\"" . $_POST['new_prixvente'] . "\" WHERE id_vente = " . $_POST['new_idvente'] . ";";
    $mysqli->query($sqlp);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour du prix de la vente. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlp", $mysqli->errno);
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
          }
    }
  }


  #Mise à jour du prix du vente
  if(!empty($_POST['new_dateachatvente']))
  {
    $aucuneInsertion = False;
    $sqlp = "UPDATE vente SET date_achat=" . $_POST['new_dateachatvente'] . " WHERE id_vente = " . $_POST['new_idvente'] . ";";
    $mysqli->query($sqlp);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour de la date de la vente. Voici l\'erreur, à montrer à un développeur comprenant le SQL : </p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlp", $mysqli->errno);
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
          }
    }
  }

  #Mise à jour du coût du vente
  if(!empty($_POST['new_moyenachatvente']))
  {
    $aucuneInsertion = False;
    $sqlp = "UPDATE vente SET moyen_achat=\"" . $_POST['new_moyenachatvente'] . "\" WHERE id_vente = " . $_POST['new_idvente'] . ";";
    $mysqli->query($sqlp);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour de la plateforme de la vente. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlp", $mysqli->errno);
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
          }
    }
  }

  #Mise à jour des matériaux du vente
  if(!empty($_POST['new_commentairesvente']))
  {
    $aucuneInsertion = False;
    $sqlp = "UPDATE vente SET commentaires_vente=\"" . $_POST['new_commentairesvente'] . "\" WHERE id_vente = " . $_POST['new_idvente'] . ";";
    $mysqli->query($sqlp);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour des commentaires de la vente. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
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
  echo 'La modification de la vente s\'est bien déroulée.';
}

include('list_ventes.php'); // On inclut le formulaire d'identification
exit;
?>
