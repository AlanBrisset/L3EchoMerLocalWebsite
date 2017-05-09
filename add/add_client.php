<!--
Formulaire permettant d'insérer un nouveau client.
Ce formulaire sera envoyé vers envoi_client.php, qui se chargera d'insérer les valeurs dans la base de données.
-->
<link rel="stylesheet" href="/echomer/style.css" type="text/css">

<body class="body">

<form action="envoi_client.php" method="post">
      <p><input type="text" name="nomclient" maxlength="60"> Nom</p>

      <p><input type="text" name="prenomclient" maxlength="60"> Prénom</p>

      <p><input type="text" name="adresseclient" maxlength="200"> Adresse [OPTIONNEL]</p>

      <p><input type="text" name="codepostalclient" maxlength="30"> Code Postal [OPTIONNEL]</p>

      <p><input type="text" name="villeclient" maxlength="30"> Ville [OPTIONNEL]</p>

      <p><input type="text" name="numtelclient" maxlength="30"> Numéro [OPTIONNEL]</p>

      <p><input type="text" name="datenaissanceclient" maxlength="20"> Date de naissance [OPTIONNEL]</p>

      <p><input style="height:100px; width: 200px;" type="text" name="commentairesclient" maxlength="250"> Commentaires [OPTIONNEL]</p>

      <p><input type="submit" value="Valider"></p>

</form>

<br/>
<br/>

<a href="/echomer">Retour à l'accueil</a>

</body>
