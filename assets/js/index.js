const tbody = document.getElementById("tbodyTable");
tbody.addEventListener("click", function (e) {
  const value = e.target.getAttribute("value");
  const inputDelete = document.getElementById("inputDelete");
  inputDelete.setAttribute("value", value);
});
