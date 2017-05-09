<!--
Formulaire permettant d'insérer un nouveau produit.
Ce formulaire sera envoyé vers envoi_produit.php, qui se chargera d'insérer les valeurs dans la base de données.
-->

<link rel="stylesheet" href="/echomer/style.css" type="text/css">

<body class="body">

<form action="envoi_produit.php" method="post">
      <p><input type="text" name="nomproduit" maxlength="60"> Nom</p>

      <p><input style="height:100px; width: 200px;" type="text" name="descriptifproduit" maxlength="250"> Descriptif [OPTIONNEL]</p>

      <p><input type="number" step="0.01" min="0" name="prixproduit" maxlength="200"> Prix</p>

      <p><input type="number" step="0.01" min="0" name="coutproduit" maxlength="200"> Coût [OPTIONNEL]</p>

      <p><input type="text" name="materiauxproduit" maxlength="200"> Matériaux [OPTIONNEL]</p>

      <p><input type="submit" value="Valider"></p>

</form>

<br/>
<br/>

<a href="/echomer">Retour à l'accueil</a>

</body>
