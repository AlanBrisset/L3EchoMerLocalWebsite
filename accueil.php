 <?php

#accueil.php
#Page principale. C'est à partir de cette page que nous atteindrons toutes les pages "fonctionnelles" du site.

// ----------- Connexion à la base de données -----------
#La connexion n'est pas forcément utile, mais elle permet de vérifier si la connexion avec la base de données est stable.
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "echomer";

$mysqli = new mysqli($servername, $username, $password, $databasename);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error . "\n");
}

?>

<head>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<!-- Liste des liens renvoyant vers les pages "utiles" du site -->
<body class="body">

  <h1>Clients, produits et ventes</h1>


<div>
	<ul>
		<li><a href="add/add_client.php">Ajouter un client</a><br/></li>
		<li><a href="add/add_produit.php">Ajouter un produit</a><br/></li>
		<li><a href="add/add_vente.php">Ajouter une vente</a><br/></li>
	</ul>
</div>

<br/>

<div>
	<ul>
		<li><a href="list/list_clients.php">Liste des clients</a><br/></li>
		<li><a href="list/list_produits.php">Liste des produits</a><br/></li>
		<li><a href="list/list_ventes.php">Liste des ventes</a><br/></li>
	</ul>
</div>

<br/>

<div>
	<ul>
		<li><a href="find/find_client_name.php">Chercher ID client</a><br/></li>
	</ul>
</div>

</body>
