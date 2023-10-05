const passwordRegister = document.getElementById("password_input_register");
const togglePassword = document.getElementById("toggle_password");

togglePassword.addEventListener("click", function () {
  if (passwordRegister.type === "password") {
    passwordRegister.type = "text";
  } else {
    passwordRegister.type = "password";
  }
});
