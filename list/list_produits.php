<!--
list_produits.php
Permet de lister l'ensemble des produits enregistrés dans la base de données.
-->

<head>
  <link rel="stylesheet" href="/echomer/style.css" type="text/css">
  <script type="text/javascript" src="/echomer/js/trieurTableau.js"></script>
</head>

<body class="body">

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

$sql = "SELECT * FROM PRODUIT ORDER BY id_produit";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {

    #On crée la table qui contiendra tous les produits

    echo '<table>';
    echo'<thead>';
    echo'<tr>';
    echo'<th><a href="#" onclick="sortTable(this,0); return false;">ID</a></th>';
    echo'<th><a href="#" onclick="sortTable(this,1); return false;">Nom</a></th>';
    echo'<th>Descriptif</th>';
    echo'<th><a href="#" onclick="sortTable(this,3); return false;">Prix</a></th>';
    echo'<th><a href="#" onclick="sortTable(this,4); return false;">Coût</a></th>';
    echo'<th>Matériaux</th>';
    echo'<th>Modifier</th>';
    echo'<th>Supprimer</th>';
    echo '</tr>';
    echo'</thead>';

    #On traite ensuite ligne par ligne (produit par produit)
    #$row contiendra tous les produits un par un
    while($row = $result->fetch_assoc()) {
        echo '<tr>';

        echo '<form action="update_delete_produit.php" method="post">';

        echo '<td><input type="hidden" name="hidden_idproduit" value=' . $row["id_produit"] . ' >' . $row["id_produit"] . '</td>';
        echo '<td><input type="hidden" name="hidden_nomproduit" value=' . $row["nom"] . ' >' . $row["nom"] . '</td>';
        echo '<td><input type="hidden" name="hidden_descriptifproduit" value=' . $row["descriptif"] . ' >' . $row["descriptif"] . '</td>';
        echo '<td><input type="hidden" name="hidden_prixproduit" value=' . $row["prix"] . ' >' . $row["prix"] . '</td>';
        echo '<td><input type="hidden" name="hidden_coutproduit" value=' . $row["cout"] . ' >' . $row["cout"] . '</td>';
        echo '<td><input type="hidden" name="hidden_materiauxproduit" value=' . $row["materiaux"] . ' >' . $row["materiaux"] . '</td>';
        echo '<td><input type="submit" name="action" value="Update" /></td>';
        echo '<td><input type="submit" name="action" value="Delete" onclick="return confirm(\'Voulez-vous vraiment supprimer ce produit? Cela supprimera également toutes les ventes dans lesquelles il apparaît.\')" /></td>';

        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "Pas de produit trouvé dans la base de données.";
}
$mysqli->close();

?>

<br/>
<br/>

<a href="/echomer">Retour à l'accueil</a>

</body>
