
function check() {
    var id1 = "admin";
    var pass1 = "admin";
    var id2 = document.getElementById("id").value;
    var pass2 = document.getElementById("pass").value;
    // If password not entered
    if (pass1 != pass2 || id1 != id2) {
      document.getElementById("id").value = "";
      document.getElementById("pass").value = "";
      alert("Access Denied");
    } else {
      document.getElementById("id").value = "";
      document.getElementById("pass").value = "";
      flag = true;
      location.href = "home.html";
    }
  }