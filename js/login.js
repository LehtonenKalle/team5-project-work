function sendUser(form) {
  var user = new Object();
  user.email = form.email.value;
  user.password = form.pswd.value;
  var jsonUser = JSON.stringify(user);

  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "ok") {
        window.location.assign("../index.html");
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