document.addEventListener("DOMContentLoaded", function () {
  const sliders = document.querySelectorAll(".answer-question");

  sliders.forEach(function (slider) {
    const span = slider
      .closest(".question-container")
      .querySelector(".answer span");

    if (slider && span) {
      // Saat halaman dimuat, atur nilai awal span sesuai dengan nilai slider
      span.textContent = slider.value;

      // Saat slider diubah, perbarui nilai span
      slider.addEventListener("input", function () {
        span.textContent = slider.value;
      });
    } else {
      console.error("Slider or its associated span not found.");
    }
  });
});
