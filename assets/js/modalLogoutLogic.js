document.getElementById("logoutButton").addEventListener("click", function () {
  document.getElementById("logoutModal").style.display = "block";
});

document.getElementById("cancelLogout").addEventListener("click", function () {
  document.getElementById("logoutModal").style.display = "none";
});
