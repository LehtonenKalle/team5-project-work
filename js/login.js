function sendUser(form) {
  // Estetään lomakkeen lähettämisen oletustoiminta
  // Eli lomakkeen lähettäminen ei aiheuta tietojen näkymistä url-osoitteessa 
  event.preventDefault();

  // Tehdään user-olio, johon tallennetaan lomakkeelta saadut tiedot muuttujiin
  var user = new Object();
  user.tunnus = form.tunnus.value;
  user.pswd = form.pswd.value;
  var jsonUser = JSON.stringify(user);

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    // Tarkistetaan, onko pyyntö valmis (readyState 4) ja onko vastauksen statuskoodi 200 (OK)
    if (this.readyState == 4 && this.status == 200) {
      // Jos vastauksena saatu merkkijono on "ok", mennään index.php -sivulle
      if (this.responseText == "ok") {
        window.location.assign("../index.php");
      }
      else {
        document.getElementById("result").innerHTML = this.responseText;
      }
    }
  };
  
  // Avataan uusi POST-tyyppinen HTTP-pyyntö määritetylle palvelimelle ja resurssille
  xmlhttp.open("POST", "../php/login.php", true);
  // Asetetaan pyynnön otsikkoon sisällön tyyppi
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // Lähetetään käyttäjätiedot HTTP-pyynnön mukana palvelimelle
  xmlhttp.send("user=" + jsonUser);
}