document.getElementById("reason").addEventListener("click", function (e) {
  const inlateEarly = document.getElementById("extend-inlate-early");
  const absence = document.getElementById("extend-absence");
  if (e.target.getAttribute("id") == "3") {
    if (inlateEarly.getAttribute("class").includes("d-none")) {
      inlateEarly.classList.remove("d-none");
      absence.classList.add("d-none");
    }

    if (!absence.getAttribute("class").includes("d-none")) {
      inlateEarly.classList.add("d-none");
      absence.classList.remove("d-none");
    }
  }

  if (e.target.getAttribute("id") == "1") {
    if (!inlateEarly.getAttribute("class").includes("d-none")) {
      inlateEarly.classList.add("d-none");
    }
    if (!absence.getAttribute("class").includes("d-none")) {
      absence.classList.add("d-none");
    }
  }

  if (e.target.getAttribute("id") == "2") {
    if (!inlateEarly.getAttribute("class").includes("d-none")) {
      inlateEarly.classList.remove("d-none");
      absence.classList.add("d-none");
    }

    if (absence.getAttribute("class").includes("d-none")) {
      inlateEarly.classList.add("d-none");
      absence.classList.remove("d-none");
    }
  }
});
