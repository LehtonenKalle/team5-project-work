// Funktio, joka lähettää käyttäjätiedot palvelimelle lomakkeen avulla
function sendChanges(form, id) {

  event.preventDefault;


  // Luodaan uusi käyttäjäobjekti
  var user = {
    email: form.email.value,
    tunnus: form.tunnus.value,
    id: id
  };
  // Muunnetaan käyttäjäobjekti JSON-muotoon
  var jsonUser = JSON.stringify(user);

  // Luodaan uusi XMLHttpRequest-objekti, jolla tehdään HTTP-pyyntö
  xmlhttp = new XMLHttpRequest();
    // Määritetään funktio, joka suoritetaan aina, kun XMLHttpRequest-objektin tila muuttuu
  xmlhttp.onreadystatechange = function() {
    // Tarkistetaan, onko pyyntö valmis (readyState 4) ja onko vastauksen statuskoodi 200 (OK)
    if (this.readyState == 4 && this.status == 200) {
      window.location.assign("../pages/profile.php");
    } 
  };
  // Avataan uusi POST-tyyppinen HTTP-pyyntö määritetylle palvelimelle ja resurssille
  xmlhttp.open("POST", "../php/edit.php", true);
  // Asetetaan pyynnön otsikkoon sisällön tyyppi
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // Lähetetään käyttäjätiedot HTTP-pyynnön mukana palvelimelle
  xmlhttp.send("user=" + jsonUser);
}