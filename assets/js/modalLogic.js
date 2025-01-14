document.addEventListener("DOMContentLoaded", function () {
  //modal logic

  const deleteButtons = document.querySelectorAll(".delete");

  deleteButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      const eventId = button.value;
      const deleteModal = document.getElementById("deleteModal");
      deleteModal.style.display = "block";

      const confirmDelete = document.getElementById("confirmDelete");
      const cancelDelete = document.getElementById("cancelDelete");

      confirmDelete.value = eventId;
      console.log(confirmDelete);

      cancelDelete.addEventListener("click", function () {
        deleteModal.style.display = "none";
      });
    });
  });
});
