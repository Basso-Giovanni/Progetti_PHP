// script/ricerca.js

function showHint(str) {
    // Se il campo è vuoto, cancella i suggerimenti
    
    if (str.length === 0) {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      
      // Crea un oggetto XMLHttpRequest
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function() {
        // Se la richiesta è completata e OK
          document.getElementById("txtHint").innerHTML = this.responseText;
      };
      // Apri la richiesta GET verso ricercaAjax.php, passando il parametro q
      xmlhttp.open("GET", "ricercaAjax.php?q=" + encodeURIComponent(str), true);
      xmlhttp.send();
    }
  }
