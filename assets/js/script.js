document.addEventListener("DOMContentLoaded", function () {
  //modal logic

  const deleteButtons = document.querySelectorAll(".delete");

  deleteButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      const eventId = button.value;
      console.log(eventId);
      const deleteModal = document.getElementById("deleteModal");
      deleteModal.style.display = "block";

      const confirmDelete = document.getElementById("confirmDelete");
      const cancelDelete = document.getElementById("cancelDelete");

      confirmDelete.value = eventId;

      cancelDelete.addEventListener("click", function () {
        deleteModal.style.display = "none";
      });
    });
  });

  //message background color logic

  const messageElement = document.getElementById("message_header");

  const messageContent = messageElement.textContent.trim();
  if (messageContent != "") {
    messageElement.classList.remove("d_none");
    if (messageContent.includes("!")) {
      messageElement.style.backgroundColor = "green";
    } else if (messageContent.includes("...")) {
      messageElement.style.backgroundColor = "red";
    }
  }

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

  formRegister.addEventListener("submit", function (event) {
    let validator = true;

    //name validation
    if (nameInput.value.length < 3 || nameInput.value.length > 15) {
      validator = false;
      nameError.classList.remove("d_none");

      //surname validation
    }
    if (surnameInput.value.length < 3 || surnameInput.value.length > 15) {
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

    console.log(passwordInput.value);

    if (!validator) {
      event.preventDefault();
    }
  });
});
