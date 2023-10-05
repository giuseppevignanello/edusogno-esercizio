const passwordLogin = document.getElementById("password_login");
const passwordRegister = document.getElementById("password_input_register");
const passwordReset = document.getElementById("new_password");
const togglePassword = document.getElementById("toggle_password");

if (passwordLogin != null) {
  togglePasswordFunction(passwordLogin);
}
if (passwordRegister != null) {
  togglePasswordFunction(passwordRegister);
}
if (passwordReset != null) {
  togglePasswordFunction(passwordReset);
}

function togglePasswordFunction(input) {
  togglePassword.addEventListener("click", function () {
    if (input.type === "password") {
      input.type = "text";
    } else {
      input.type = "password";
    }
  });
}
