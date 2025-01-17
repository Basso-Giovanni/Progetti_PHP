function Search() 
{
    const criteria = 
    {
        marca: document.getElementById('marca').value,
        modello: document.getElementById('modello').value,
        annoDa: document.getElementById('annoDa').value,
        annoA: document.getElementById('annoA').value,
        prezzoMin: document.getElementById('prezzoMin').value,
        prezzoMax: document.getElementById('prezzoMax').value,
    };

    const queryString = new URLSearchParams(criteria).toString();

    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) 
        {
            document.getElementById('results').innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "../config/gethint.php?" + queryString, true);
    xmlhttp.send();
}