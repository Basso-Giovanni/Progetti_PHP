// script/ricerca.js

function showHint(str, specie, data_da, data_a) {

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
      var url = "ricercaAjax.php?q=" + encodeURIComponent(str) + "&s=" + encodeURIComponent(specie) + "&d=" + encodeURIComponent(data_da) + "&a=" + encodeURIComponent(data_a);
      xmlhttp.open("GET", url, true);
      xmlhttp.send();
    }
  }