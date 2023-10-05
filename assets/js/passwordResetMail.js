document.addEventListener("DOMContentLoaded", function () {
  const formPasswordResetMail = document.getElementById(
    "form_reset_password_mail"
  );
  const emailReset = document.getElementById("email_reset_password");
  const emailError = document.getElementById("mail_error");

  formPasswordResetMail.addEventListener("submit", function (event) {
    let validator = true;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailPattern.test(emailReset.value)) {
      validator = false;
      emailError.classList.remove("d_none");
    }

    if (!validator) {
      event.preventDefault();
    }
  });
});
