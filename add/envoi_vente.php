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
if(isset($_POST) && !empty($_POST['id_client_vente']) && !empty($_POST['id_produit_vente'] && !empty($_POST['quantitevente'] && !empty($_POST['prixvente'])))) {

  extract($_POST);

#Extraction des valeurs obligatoires (valeurs NON NULL)
  $id_clientv = $_POST['id_client_vente'];
  $id_produitv = $_POST['id_produit_vente'];
  $quantitev = $_POST['quantitevente'];
  $prixv = $_POST['prixvente'];

#Extraction des valeurs NULL. Si on détecte qu'elles sont vides, on leur donne la valeur NULL.
  if(empty($_POST['date_achatvente']))
    $date_achatv = "";
  else
  {
    #On formate la date dans le modèle anglais, seul modèle accepté par PHPMyAdmin.
    $date_achatvFr = $_POST['date_achatvente'];
    $date_achatv = substr($date_achatvFr, 6, 4).'-'.substr($date_achatvFr, 3, 2).'-'.substr($date_achatvFr, 0, 2);
  }

  if(empty($_POST['moyen_payementvente']))
    $moyen_payementv = "";
  else
    $moyen_payementv = $_POST['moyen_payementvente'];

  if(empty($_POST['commentairesvente']))
    $commentairesv = "";
  else
  {
    #Si le commentaire contient des apostrophes ou des guillemets non-échappés, le code plantera.
    #Par conséquent, il faut ajouter un backslash devant chaque apostrophe ou guillemet.
    #On encode le texte en UTF8, afin de pouvoir lire les accents.
    $commentairesv = $_POST['commentairesvente'];
    $commentairesv = addslashes($commentairesv);
    $commentairesv = utf8_decode($commentairesv);
  }


// ----------- INSERTION DES VALEURS DANS LA BASE DE DONNEES -----------
#Bug dû au formatage de la date (impossible de la définir en tant que NULL).
#Si aucune date n'a été rentrée, alors on effectue l'insertion sans même la spécifier dans la requête.

if($date_achatv != NULL)
  $sqlv = "INSERT INTO VENTE (id_client, id_produit, quantite, prix, date_achat, moyen_payement, commentaires_vente)
  VALUES(\"$id_clientv\", \"$id_produitv\",  \"$quantitev\", \"$prixv\", \"$date_achatv\", \"$moyen_payementv\", \"$commentairesv\");";
else {
  $sqlv = "INSERT INTO VENTE (id_client, id_produit, quantite, prix, moyen_payement, commentaires_vente)
  VALUES(\"$id_clientv\", \"$id_produitv\",  \"$quantitev\", \"$prixv\", \"$moyen_payementv\", \"$commentairesv\");";
}

$mysqli->query($sqlv);


// ----------- RECUPERATION DE L'ID DE LA VENTE -----------
#Si l'utilisateur a rentré une date de vente, on s'en sert afin d'identifier la vente.
#Sinon, on utilise le nombre d'articles achetés ainsi que le prix final, en espérant tomber sur la bonne vente.
if($date_achatv != NULL)
  $sqlv = "SELECT * FROM VENTE WHERE id_client =" . $id_clientv . " AND id_produit =" . $id_produitv . " AND date_achat = '" . $date_achatv . "' ;";
else
  $sqlv = "SELECT * FROM VENTE WHERE id_client =" . $id_clientv . " AND id_produit =" . $id_produitv . " AND quantite =" . $quantitev . " AND prix =" . $prixv;

$result2 = $mysqli->query($sqlv);

if ($result2->num_rows > 0) {
  $row = $result2->fetch_assoc();
  $id_vente = $row["id_vente"];


echo '<p>Insertion effectuée. La vente #' . $id_vente . ' a été ajoutée dans la base de données. </p>';
}

else{
  echo '<p>L\'insertion s\'est mal déroulée.';
}

$mysqli->close();

}
else {
  echo '<p>Vous avez oublié de remplir un champ.</p>';
}

include('add_vente.php'); // On inclut le formulaire d'identification
exit;
?>
