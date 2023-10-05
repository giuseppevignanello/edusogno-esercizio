const passwordLogin = document.getElementById("password_login");
const passwordRegister = document.getElementById("password_input_register");
const passwordReset = document.getElementById("new_password");
const passwordConfirm = document.getElementById("password_confirm");
const togglePassword = document.getElementById("toggle_password");
const togglePasswordConfirm = document.getElementById(
  "toggle_password_confirm"
);

if (passwordLogin != null) {
  togglePasswordFunction(passwordLogin);
}
if (passwordRegister != null) {
  togglePasswordFunction(passwordRegister, passwordConfirm);
}
if (passwordReset != null) {
  togglePasswordFunction(passwordReset, passwordConfirm);
}

function togglePasswordFunction(input, inputConfirm) {
  togglePassword.addEventListener("click", function () {
    if (input.type === "password") {
      input.type = "text";
    } else {
      input.type = "password";
    }
  });

  if (togglePasswordConfirm != null) {
    togglePasswordConfirm.addEventListener("click", function () {
      if (inputConfirm.type === "password") {
        inputConfirm.type = "text";
      } else {
        inputConfirm.type = "password";
      }
    });
  }
}
