function registerNewUser() {
  var modal = document.getElementById("registerModal");
  modal.style.display = "block";

  // Get the button that opens the modal
  var btn = document.getElementById("registerButton");

  // Get the <span> element that closes the modal
  var close = document.getElementById("closeMe");

  close.onclick = function () {
    modal.style.display = "none";
  };

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
}

function loginUser() {
  var modal = document.getElementById("loginModal");
  modal.style.display = "block";

  var btn = document.getElementById("loginButton");

  var close = document.getElementById("closeLogin");

  close.onclick = function () {
    modal.style.display = "none";
  };

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
}
