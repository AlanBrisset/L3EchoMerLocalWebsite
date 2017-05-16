<!--
Formulaire permettant d'insérer une nouvelle vente.
Ce formulaire sera envoyé vers envoi_vente.php, qui se chargera d'insérer les valeurs dans la base de données.
-->

<link rel="stylesheet" href="/echomer/style.css" type="text/css">

<body class="body">

<form action="envoi_vente.php" method="post">
      <p style="font-family='Comic sans MS;'"><input type="text" name="id_client_vente" maxlength="60"> ID du client [OPTIONNEL]</p>

      <p><input type="text" name="id_produit_vente" maxlength="60"> ID du produit</p>

      <p><input type="text" name="quantitevente" maxlength="200"> Nombre de produits achetés</p>

      <p><input type="number" step="0.01" min="0" name="prixvente" maxlength="200"> Prix total</p>

      <p><select name="moyen_achatvente" size="1">
        <option value="Papier">Papier</option>
        <option value="Internet">Internet</option>
      </select> Moyen d'achat</p>

      <!--<p><input type="text" name="moyen_achatvente" maxlength="20"> Plateforme d'achat</p>-->

      <p><input type="text" name="date_achatvente" maxlength="20"> Date de la vente [OPTIONNEL] Format : dd/mm/yyyy</p>

      <p><input style="height:100px; width: 200px;" type="text" name="commentairesvente" maxlength="250"> Commentaires [OPTIONNEL]</p>

      <p><input  type="submit" value="Valider"></p>

</form>

<br/>
<br/>

<a href="/echomer">Retour à l'accueil</a>

</body>
