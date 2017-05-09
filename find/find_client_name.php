<!--
Formulaire permettant de rechercher l'identifiant d'un client.
Ce formulaire sera envoyé vers clientfinder.php, qui se chargera de récupérer l'identifiant du client.
-->
<link rel="stylesheet" href="/echomer/style.css" type="text/css">

<body class="body">

<h1>Recherche de l'identifiant d'un client</h1>

<h2>Rentrez le nom du client et/ou son numéro de téléphone</h2>

<form action="clientfinder.php" method="post">
      <p><input type="text" name="nomclient" maxlength="60"> Nom</p>

      <p><input type="text" name="numtelclient" maxlength="30"> Numéro de téléphone</p>

      <p><input type="submit" value="Valider"></p>

</form>

<br/>
<br/>

<a href="/echomer">Retour à l'accueil</a>

</body>
