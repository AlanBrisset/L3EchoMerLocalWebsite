<!--
list_clients.php
Permet de lister l'ensemble des produits enregistrés dans la base de données.
-->

<head>
  <link rel="stylesheet" href="/echomer/style.css" type="text/css">
  <script type="text/javascript" src="/echomer/js/trieurTableau.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<?php

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


// ----------- RECUPERATION DES VALEURS -----------

?>

<body class="body">

<?php

$sql = "SELECT * FROM CLIENT ORDER BY id_client";

$result = $mysqli->query($sql);

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
    echo'<th>Modifier</th>';
    echo'<th>Supprimer</th>';
    echo'</tr>';
    echo'</thead>';


    #On traite ensuite ligne par ligne (client par client)
    #$row contiendra tous les clients un par un

    #On veut envoyer avec un $_POST les valeurs de chaque ligne vers update_delete_client.php
    #Cependant, on ne peut pas envoyer les valeurs contenues dans des <td> par un $_POST
    #On ajoute alors un champ de texte caché, qui contiendra la valeur du <td>.
    #Ce champ de texte caché peut alors être envoyé par $_POST.

    while($row = $result->fetch_assoc()) {
        echo '<tr>';

        echo '<form action="update_delete_client.php" method="post">';

        echo '<td><input type="hidden" name="hidden_idclient" value=' . $row["id_client"] . ' > '  . $row["id_client"] . '</td>';
        echo '<td><input type="hidden" name="hidden_nomclient" value=' . utf8_encode($row["nom"]) . ' > '  . utf8_encode($row["nom"]) . '</td>';
        echo '<td><input type="hidden" name="hidden_prenomclient" value=' . utf8_encode($row["prenom"]) . ' > '  . utf8_encode($row["prenom"]) . '</td>';
        echo '<td><input type="hidden" name="hidden_adresseclient" value=' . utf8_encode($row["adresse"]) . ' > '  . utf8_encode($row["adresse"]) . '</td>';
        echo '<td><input type="hidden" name="hidden_codepostalclient" value=' .  $row["codepostal"] . ' > '  .  $row["codepostal"] . '</td>';
        echo '<td><input type="hidden" name="hidden_villeclient" value=' . utf8_encode($row["ville"]) . ' > '  . utf8_encode($row["ville"]) . '</td>';
        echo '<td><input type="hidden" name="hidden_numtelclient" value=' .  $row["num_tel"] . ' > '  .  $row["num_tel"] . '</td>';
        echo '<td><input type="hidden" name="hidden_datenaissanceclient" value=' .  $row["date_naissance"] . ' > '  .  $row["date_naissance"] . '</td>';
        echo '<td><input type="hidden" name="hidden_nbachatsclient" value=' .  $row["nb_achats"] . ' > '  .  $row["nb_achats"] . '</td>';
        echo '<td><input type="hidden" name="hidden_commentairesclient" value=' .  utf8_encode($row["commentaires"]) . ' > '  .  utf8_encode($row["commentaires"]) . '</td>';
        echo '<td><input type="submit" name="action" value="Update" /></td>';
        echo '<td><input type="submit" name="action" value="Delete" /></td>';

        echo '</form>';

        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "Pas de client trouvé dans la base de données.";
}

?>

<br/>
<br/>

<a href="/echomer">Retour à l'accueil</a>

</body>
