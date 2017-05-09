 <?php

#index.php
#C'est la 1re page que nous atteignons. Si tout se passe bien, on est automatiquement redirigés vers la page accueil.php



// ----------- Fonction permettant de rediriger vers une autre page. -----------
 function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    exit();
}

// ----------- Connexion à la base de données -----------
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "echomer";

$mysqli = new mysqli($servername, $username, $password, $databasename);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error . "\n");
}

// ----------- Si la connexion réussit, on va sur la page accueil.php -----------
Redirect('accueil.php', false);
?>
