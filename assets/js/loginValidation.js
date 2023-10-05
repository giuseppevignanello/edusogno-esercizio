const emailInput = document.getElementById("email_login");
const passwordInput = document.getElementById("password_login");
const formLogin = document.getElementById("formLogin");
const errorEmailLogin = document.getElementById("email_login_error");
const errorPasswordLogin = document.getElementById("password_login_error");

formLogin.addEventListener("submit", function (event) {
  let validator = true;

  const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  //email validator
  if (!emailPattern.test(emailInput.value)) {
    validator = false;
    errorEmailLogin.classList.remove("d_none");
  }

  //password validation
  const passwordPattern =
    /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&+=!?']).{8,}$/;

  if (!passwordPattern.test(passwordInput)) {
    validator = false;
    errorPasswordLogin.classList.remove("d_none");
  }

  if (!validator) {
    event.preventDefault();
  }
});
