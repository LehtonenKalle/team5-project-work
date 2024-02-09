function sendUser(form) {
  // Estetään lomakkeen lähettämisen oletustoiminta
  // Eli lomakkeen lähettäminen ei aiheuta tietojen näkymistä url-osoitteessa 
  event.preventDefault();

  var user = new Object();
  user.tunnus = form.tunnus.value;
  user.pswd = form.pswd.value;
  var jsonUser = JSON.stringify(user);

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "ok") {
        document.getElementById("result").innerHTML = "Logged in as " + user.tunnus;
      }
      else {
        document.getElementById("result").innerHTML = this.responseText;
      }
    }
  };

  xmlhttp.open("POST", "../php/login.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("user=" + jsonUser);
}