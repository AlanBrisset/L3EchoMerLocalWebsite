<!--
list_ventes.php
Permet de lister l'ensemble des ventes enregistréss dans la base de données.

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

$sqlv = "SELECT * FROM VENTE ORDER BY id_vente";

$result = $mysqli->query($sqlv);

if ($result->num_rows > 0) {

    #On crée la table qui contiendra tous les produits

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

    #On traite ensuite ligne par ligne (vente par vente)
    #$row contiendra toutes les ventes une par une

    while($row = $result->fetch_assoc()) {
        echo '<tr>';

        echo '<form action="update_delete_vente.php" method="post">';

        echo '<td><input type="hidden" name="hidden_idvente" value=' . $row["id_vente"] . ' >' . $row["id_vente"] . '</td>';
        echo '<td><input type="hidden" name="hidden_idclientvente" value=' . $row["id_client"] . ' >' . $row["id_client"] . '</td>';

        #On souhaite afficher le nom du client. Cependant, il n'est pas présent dans le formulaire.
        #Par conséquent, il faut effectuer une requête SQL sur la table CLIENT, à l'aide de l'attribut id_client, afin de récupérer son nom.
        # ---
        $id_clientv = $row["id_client"];
        $sqlv2 = "SELECT * FROM CLIENT WHERE id_client =" . $id_clientv .";";
        $result2 = $mysqli->query($sqlv2);
        if ($result2->num_rows > 0) {

          $row2 = $result2->fetch_assoc();
          echo '<td><input type="hidden" name="hidden_nomclientvente" value=' . $row["nom"] . ' >' . $row2["nom"] . '</td>';
        }
        else {
          echo '<td><input type="hidden" name="hidden_nomclientvente" value="null" >(erreur)</td>';
        }
        # ---

        echo '<td><input type="hidden" name="hidden_idproduitvente" value=' . $row["id_produit"] . ' >' . $row["id_produit"] . '</td>';

        #Comme précédemment, on souhaite obtenir le nom du produit, qui n'est pas présent dans le formulaire.
        #On effectue une requête sur la table PRODUIT, à l'aide de l'attribut id_produit.
        # ---
        $id_produitv = $row["id_produit"];
        $sqlv3 = "SELECT * FROM PRODUIT WHERE id_produit =" . $id_produitv .";";
        $result3 = $mysqli->query($sqlv3);
        if ($result3->num_rows > 0) {

          $row3 = $result3->fetch_assoc();
          echo '<td>' . $row3["nom"] . '</td>';
        }
        else {
          echo '<td>(erreur)</td>';
        }
        # ---

        echo '<td><input type="hidden" name="hidden_quantitevente" value=' . $row["quantite"] . ' >' . $row["quantite"] . '</td>';
        echo '<td><input type="hidden" name="hidden_prixvente" value=' . $row["prix"] . ' >' . $row["prix"] . '</td>';
        echo '<td><input type="hidden" name="hidden_dateachatvente" value=' . $row["date_achat"] . ' >' . $row["date_achat"] . '</td>';
        echo '<td><input type="hidden" name="hidden_moyenachatvente" value=' . $row["moyen_achat"] . ' >' . $row["moyen_achat"] . '</td>';
        echo '<td><input type="hidden" name="hidden_commentairesvente" value=' . $row["commentaires_vente"] . ' >' . $row["commentaires_vente"] . '</td>';

        echo '<td><input type="submit" name="action" value="Update" /></td>';
        echo '<td><input type="submit" name="action" value="Delete" onclick="return confirm(\'Voulez-vous vraiment supprimer ce produit? Cela supprimera également toutes les ventes dans lesquelles il apparaît.\')" /></td>';

        echo '</form>';

        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "0 results";
}
$mysqli->close();

?>

<br/>
<br/>

<a href="/echomer">Retour à l'accueil</a>

</body>
