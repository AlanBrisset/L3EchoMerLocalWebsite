<head>
  <link rel="stylesheet" href="/echomer/style.css" type="text/css">
  <script type="text/javascript" src="/echomer/js/trieurTableau.js"></script>
</head>

<?php

#envoi_vente.php
#Récupère les données du formulaire add_vente.php et les insère dans la base de données.

// ----------- CONNEXION A LA BASE DE DONNEES -----------

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "echomer";

$mysqli = new mysqli($servername, $username, $password, $databasename);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error . "\n");
}


// ----------- EXTRACTION DES VALEURS DU FORMULAIRE -----------

#On vérifie que les valeurs obligatoires pour l'insertion ont bien été rentrées par l'utilisateur. Sinon, on abandonne directement l'opération.
if(isset($_POST) && (!empty($_POST['nomclient']) || !empty($_POST['numtelclient']) )) {

  extract($_POST);

  if(empty($_POST['nomclient']))
  {
    $numtelclient = $_POST['numtelclient'];
    $nomclient = NULL;
  }
  else {
    $nomclient = $_POST['nomclient'];
    $numtelclient = NULL;
  }


if($nomclient != NULL)
  $sqlv = "SELECT * FROM CLIENT WHERE nom = '" . $nomclient . "' ;";
else
  $sqlv = "SELECT * FROM CLIENT WHERE num_tel = " . $numtelclient . " ;";

$result = $mysqli->query($sqlv);

if ($result->num_rows > 0) {

    #On crée la table qui contiendra tous les clients

    echo '<table>';
    echo'<thead>';
    echo'<tr>';
    echo'<th><a href="#" onclick="sortTable(this,0); return false;">ID</a></th>';
    echo'<th><a href="#" onclick="sortTable(this,1); return false;">Nom</a></th>';
    echo'<th><a href="#" onclick="sortTable(this,2); return false;">Prénom</a></th>';
    echo'<th>Adresse</th>';
    echo'<th><a href="#" onclick="sortTable(this,4); return false;">Code Postal</a></th>';
    echo'<th><a href="#" onclick="sortTable(this,5); return false;">Ville</a></th>';
    echo'<th>Num tél</th>';
    echo'<th>Date de naissance</th>';
    echo'<th><a href="#" onclick="sortTable(this,8); return false;">Nb achats</a></th>';
    echo'<th>Commentaires</th>';
    echo'</tr>';
    echo'</thead>';


    #On traite ensuite ligne par ligne (client par client)
    #$row contiendra tous les clients un par un

    while($row = $result->fetch_assoc()) {
        echo '<tr>';

        echo '<td>' . $row["id_client"] . '</td>';
        echo '<td>' . $row["nom"] . '</td>';
        echo '<td>' . $row["prenom"] . '</td>';
        echo '<td>' . $row["adresse"] . '</td>';
        echo '<td>' . $row["codepostal"] . '</td>';
        echo '<td>' . $row["ville"] . '</td>';
        echo '<td>' . $row["num_tel"] . '</td>';
        echo '<td>' . $row["date_naissance"] . '</td>';
        echo '<td>' . $row["nb_achats"] . '</td>';
        echo '<td>' . $row["commentaires"] . '</td>';

        echo '</tr>';
    }

    echo '</table>';
}

else{
  echo '<p>Aucun client n\'a été trouvé.</p>';
}

$mysqli->close();

}
else {
  echo '<p>Il faut remplir l\'un des deux champs.</p>';
}

include('find_client_name.php'); // On inclut le formulaire d'identification
exit;
?>
