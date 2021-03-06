<!--
/*
Script téléchargé du Coin Web de QuentinC
http://www.quentinc.net/

Nom du script : Tri dynamique de tableau HTML avec le DOM

Catégorie : Divers
Date de dernière modification : Lundi 23 janvier 2006 15:30
URL exact : /javascript/script56-tri-dynamique-de-tableau-html-avec-le-dom/

Vous trouverez d'autres scripts à l'adresse :
http://www.quentinc.net/javascript/

© 2002-2006, QuentinC
Vous pouvez utiliser, modifier et redistribuer ce script, à condition de laisser les présents commentaires intacts, et de ne pas l'utiliser à des fins commerciales.
*/
function sortTable (tb, n) {

  var iter = 0;

  while (!tb.tagName || tb.tagName.toLowerCase()  != "table") {
    if (!tb.parentNode)
      return;

    tb = tb.parentNode;
  }


  if (tb.tBodies && tb.tBodies[0])
    tb = tb.tBodies[0];

  /* Tri par sélection  */
  var reg = /^\d+(\.\d+)?$/g;
  var index = 0, value = null, minvalue = null;

  for (var i= tb.rows.length -1; i >= 0; i -= 1) {
    minvalue = value = null;
    index = -1;

    for (var j=i; j >= 0; j -= 1) {
      value = tb.rows[j].cells[n].firstChild.nodeValue;

      if (!isNaN(value))
        value = parseFloat(value);
      if(minvalue == null || value < minvalue) {
        index = j;
        minvalue = value;
      }
    }


    if (index != -1) {
      var row = tb.rows[index];
      if (row) {
        tb.removeChild(row);
        tb.appendChild(row);
      }}

    }
    //fin

  }
