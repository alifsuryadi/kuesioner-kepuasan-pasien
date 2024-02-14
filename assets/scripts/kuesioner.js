document.addEventListener("DOMContentLoaded", function () {
  const progress = document.getElementById("progress");
  const prev = document.getElementById("prev");
  const next = document.getElementById("next");
  const circles = document.querySelectorAll(".circle");

  let currentActive = localStorage.getItem("currentActive") || 1;

  update();

  next.addEventListener("click", () => {
    currentActive++;

    if (currentActive > circles.length) {
      currentActive = circles.length;
    }

    localStorage.setItem("currentActive", currentActive);

    update();
  });

  prev.addEventListener("click", () => {
    currentActive--;

    if (currentActive < 1) {
      currentActive = 1;
    }

    localStorage.setItem("currentActive", currentActive);

    update();
  });

  function update() {
    circles.forEach((circle, idx) => {
      if (idx < currentActive) {
        circle.classList.add("active");
      } else {
        circle.classList.remove("active");
      }
    });

    const actives = document.querySelectorAll(".active");

    progress.style.width =
      ((actives.length - 1) / (circles.length - 1)) * 100 + "%";
  }
});
