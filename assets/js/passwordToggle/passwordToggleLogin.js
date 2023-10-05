const passwordLogin = document.getElementById("password_login");
const togglePassword = document.getElementById("toggle_password");

togglePassword.addEventListener("click", function () {
  if (passwordLogin.type === "password") {
    passwordLogin.type = "text";
  } else {
    passwordLogin.type = "password";
  }
});
