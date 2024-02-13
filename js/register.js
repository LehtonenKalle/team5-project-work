// Määrittelee JavaScript-funktion lahetaRekisterointi, joka saa parametrinaan lomakkeen (form-elementin), 
// josta käyttäjän tiedot haetaan.
function lahetaRekisterointi(lomake) {
// Luo uuden JavaScript-objektin nimeltä user, johon tallennetaan käyttäjän syöttämät tiedot 
// (sähköposti, käyttäjätunnus, salasana).
var user = {
  email: lomake.email.value,
  tunnus: lomake.tunnus.value,
  salasana: lomake.salasana.value
};
// Muunnetaan käyttäjäobjekti JSON-muotoon
var jsonUser = JSON.stringify(user);

// Luodaan uusi XMLHttpRequest-objekti, jolla tehdään HTTP-pyyntö
xmlhttp = new XMLHttpRequest();
// Määrittelee funktion, joka suoritetaan aina, kun XMLHttpRequest-objektin tila muuttuu. 
// Tämä funktio käsittelee vastauksen palvelimelta.
xmlhttp.onreadystatechange = function() {
  // Tarkistetaan, onko pyyntö valmis (readyState 4) ja onko vastauksen statuskoodi 200 (OK)
  if (this.readyState == 4 && this.status == 200) {
    if (this.responseText.trim() === "Success") { 
      // Ohjataan rekisteröitynyt asiakas login-sivulle
      window.location.href = "../pages/login.php";
    } else {
      // Asetetaan vastauksen teksti elementtiin, jonka id on "result", 
      document.getElementById("result").innerHTML = this.responseText;
    }
  }
  
};

// Avataan uusi POST-tyyppinen HTTP-pyyntö määritetylle palvelimelle ja resurssille, jolla käyttäjän tiedot lähetetään.
xmlhttp.open("POST", "../php/register.php", true);
// Asetetaan pyynnön otsikkoon sisällön tyyppi
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// Lähetetään käyttäjätiedot HTTP-pyynnön mukana palvelimelle
xmlhttp.send("user=" + jsonUser);
}