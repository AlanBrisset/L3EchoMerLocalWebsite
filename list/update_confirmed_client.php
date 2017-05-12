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


#On initialise deux booléens, pour vérifier à la fin si tout s'est bien passé.
$erreurUpdate = False;
$aucuneInsertion = True;

// ----------- EXTRACTION DES VALEURS DU FORMULAIRE -----------

#On vérifie que les valeurs obligatoires pour l'insertion ont bien été rentrées par l'utilisateur. Sinon, on abandonne directement l'opération.
if(isset($_POST)) {
  extract($_POST);

  #Mise à jour du nom du client
  if(!empty($_POST['new_nomclient']))
  {
    $aucuneInsertion = False;
    $sqlc = "UPDATE CLIENT SET nom=\"" . $_POST['new_nomclient'] . "\" WHERE id_client = " . $_POST['new_idclient'] . ";";
    $mysqli->query($sqlc);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour du nom du client. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlc", $mysqli->errno);
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
          }
    }
  }


  #Mise à jour du prénom du client
  if(!empty($_POST['new_prenomclient']))
  {
    $aucuneInsertion = False;
    $sqlc = "UPDATE CLIENT SET prenom=\"" . $_POST['new_prenomclient'] . "\" WHERE id_client = " . $_POST['new_idclient'] . ";";
    $mysqli->query($sqlc);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour du prénom du client. Voici l\'erreur, à montrer à un développeur comprenant le SQL : </p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlc", $mysqli->errno);
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
          }
    }
  }

  #Mise à jour de l'adresse du client
  if(!empty($_POST['new_adresseclient']))
  {
    $aucuneInsertion = False;
    $sqlc = "UPDATE CLIENT SET adresse=\"" . $_POST['new_adresseclient'] . "\" WHERE id_client = " . $_POST['new_idclient'] . ";";
    $mysqli->query($sqlc);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour de l\'adresse du client. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlc", $mysqli->errno);
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
          }
    }
  }

  #Mise à jour du code postal du client
  if(!empty($_POST['new_codepostalclient']))
  {
    $aucuneInsertion = False;
    $sqlc = "UPDATE CLIENT SET codepostal=\"" . $_POST['new_codepostalclient'] . "\" WHERE id_client = " . $_POST['new_idclient'] . ";";
    $mysqli->query($sqlc);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour du code postal du client. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlc", $mysqli->errno);
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
          }
    }
  }

  #Mise à jour de la ville du client
  if(!empty($_POST['new_villeclient']))
  {
    $aucuneInsertion = False;
    $sqlc = "UPDATE CLIENT SET ville=\"" . $_POST['new_villeclient'] . "\" WHERE id_client = " . $_POST['new_idclient'] . ";";
    $mysqli->query($sqlc);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour de la ville du client. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlc", $mysqli->errno);
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
          }
    }
  }

  #Mise à jour du nom du client
  if(!empty($_POST['new_numtelclient']))
  {
    $aucuneInsertion = False;
    $sqlc = "UPDATE CLIENT SET num_tel=\"" . $_POST['new_numtelclient'] . "\" WHERE id_client = " . $_POST['new_idclient'] . ";";
    $mysqli->query($sqlc);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour du numéro de téléphone du client. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlc", $mysqli->errno);
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
          }
    }
  }

  #Mise à jour de la date de naissance du client
  if(!empty($_POST['new_datenaissanceclient']))
  {
    $aucuneInsertion = False;
    $sqlc = "UPDATE CLIENT SET date_naissance=\"" . $_POST['new_datenaissanceclient'] . "\" WHERE id_client = " . $_POST['new_idclient'] . ";";
    $mysqli->query($sqlc);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour de la date de naissance du client. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlc", $mysqli->errno);
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
          }
    }
  }

  #Mise à jour des commentaires du client
  if(!empty($_POST['new_commentairesclient']))
  {
    $aucuneInsertion = False;
    $sqlc = "UPDATE CLIENT SET commentaires=\"" . $_POST['new_commentairesclient'] . "\" WHERE id_client = " . $_POST['new_idclient'] . ";";
    $mysqli->query($sqlc);

    if ($mysqli->error) {
        $erreurUpdate = False;
        echo '<p>Erreur durant la mise à jour des commentaires du client. Voici l\'erreur, à montrer à un développeur comprenant le SQL :</p><br/>';
        try {
          throw new Exception("MySQL error $mysqli->error <br> Query:<br> $sqlc", $mysqli->errno);
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
  echo 'La modification du client s\'est bien déroulée.';
}

include('list_clients.php'); // On inclut le formulaire d'identification
exit;
?>
