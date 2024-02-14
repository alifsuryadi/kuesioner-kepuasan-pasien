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

    update();

    // // Halaman
    // if (currentActive === 2) {
    //   localStorage.setItem("currentActive", currentActive);
    //   window.location.href = "";
    // } else if (currentActive === 3) {
    //   localStorage.setItem("currentActive", currentActive);
    //   window.location.href = "pertanyaan.php";
    //   // } else if (currentActive === 4) {
    //   //   localStorage.setItem("currentActive", currentActive);
    //   //   window.location.href = "";
    // }
  });

  prev.addEventListener("click", () => {
    currentActive--;

    if (currentActive < 1) {
      currentActive = 1;
    }

    update();

    // // Kembali ke halaman sebelumnya
    // if (currentActive === 1) {
    //   localStorage.setItem("currentActive", currentActive);
    //   window.history.back();
    // } else if (currentActive === 2) {
    //   localStorage.setItem("currentActive", currentActive);
    //   window.location.href = "cara-pengisian.php";
    // } else if (currentActive === 3) {
    //   localStorage.setItem("currentActive", currentActive);
    //   window.location.href = "pertanyaan.php";
    // }
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

    if (currentActive === 1) {
      prev.disabled = true;
    } else if (currentActive === circles.length) {
      next.disabled = true;
    } else {
      prev.disabled = false;
      next.disabled = false;
    }
  }
});
