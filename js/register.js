// Funktio, joka lähettää käyttäjätiedot palvelimelle lomakkeen avulla
function lahetaRekisterointi(lomake) {
// Luodaan uusi käyttäjäobjekti
var user = {
  email: lomake.email.value,
  tunnus: lomake.tunnus.value,
  salasana: lomake.salasana.value
};
// Muunnetaan käyttäjäobjekti JSON-muotoon
var jsonUser = JSON.stringify(user);

// Luodaan uusi XMLHttpRequest-objekti, jolla tehdään HTTP-pyyntö
xmlhttp = new XMLHttpRequest();
// Määritetään funktio, joka suoritetaan aina, kun XMLHttpRequest-objektin tila muuttuu
xmlhttp.onreadystatechange = function() {
  // Tarkistetaan, onko pyyntö valmis (readyState 4) ja onko vastauksen statuskoodi 200 (OK)
  if (this.readyState == 4 && this.status == 200) {
    if (this.responseText.trim() === "Success") { 
      // Ohjataan rekisteröitynyt asiakas login-sivulle
      window.location.href = "login.php";
    } else {
      // Asetetaan vastauksen teksti elementtiin, jonka id on "result", 
      document.getElementById("result").innerHTML = this.responseText;
    }
  }
  
};

// Avataan uusi POST-tyyppinen HTTP-pyyntö määritetylle palvelimelle ja resurssille
xmlhttp.open("POST", "../php/register.php", true);
// Asetetaan pyynnön otsikkoon sisällön tyyppi
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// Lähetetään käyttäjätiedot HTTP-pyynnön mukana palvelimelle
xmlhttp.send("user=" + jsonUser);
}