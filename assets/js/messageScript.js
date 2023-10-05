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
});
