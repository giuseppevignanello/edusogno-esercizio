const passwordReset = document.getElementById("new_password");
const togglePassword = document.getElementById("toggle_password");

togglePassword.addEventListener("click", function () {
  if (passwordReset.type === "password") {
    passwordReset.type = "text";
  } else {
    passwordReset.type = "password";
  }
});
