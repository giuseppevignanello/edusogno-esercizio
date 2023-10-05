document.addEventListener("DOMContentLoaded", function () {
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
