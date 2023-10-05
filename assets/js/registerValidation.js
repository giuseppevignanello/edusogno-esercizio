document.addEventListener("DOMContentLoaded", function () {
  //form validation
  const formRegister = document.getElementById("form_register");
  const nameInput = document.getElementById("name_input_register");
  const surnameInput = document.getElementById("surname_input_register");
  const emailInput = document.getElementById("mail_input_register");
  const passwordInput = document.getElementById("password_input_register");
  const nameError = document.getElementById("name_error");
  const surnameError = document.getElementById("surname_error");
  const emailError = document.getElementById("mail_error");
  const passwordError = document.getElementById("password_error");
  const passwordConfirm = document.getElementById("password_confirm");
  const passwordErrorConfirm = document.getElementById(
    "password_error_confirm"
  );

  formRegister.addEventListener("submit", function (event) {
    let validator = true;

    //name validation
    if (nameInput.value.length < 3 || nameInput.value.length > 20) {
      validator = false;
      nameError.classList.remove("d_none");
    }
    //surname validation
    if (surnameInput.value.length < 3 || surnameInput.value.length > 20) {
      validator = false;
      surnameError.classList.remove("d_none");
    }

    //email validation
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailPattern.test(emailInput.value)) {
      validator = false;
      emailError.classList.remove("d_none");
    }

    //password validation
    const passwordPattern =
      /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&+=!?']).{8,}$/;

    if (!passwordPattern.test(passwordInput.value)) {
      validator = false;
      passwordError.classList.remove("d_none");
    }

    if (passwordInput.value != passwordConfirm.value) {
      validator = false;
      passwordErrorConfirm.classList.remove("d_none");
    }

    if (!validator) {
      event.preventDefault();
    }
  });
});
