document.addEventListener("DOMContentLoaded", function () {
  const formPasswordReset = document.getElementById("form_reset_password");
  const newPassword = document.getElementById("new_password");
  const passwordError = document.getElementById("password_error");

  formPasswordReset.addEventListener("submit", function (event) {
    let validator = true;
    const passwordPattern =
      /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&+=!?']).{8,}$/;
    if (!passwordPattern.test(newPassword.value)) {
      validator = false;
      passwordError.classList.remove("d_none");
    }

    if (!validator) {
      event.preventDefault();
    }
  });
});
