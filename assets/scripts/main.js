document.addEventListener("DOMContentLoaded", () => {
  "use strict";

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: ".glightbox",
  });

  /**
   * Initiate pURE cOUNTER
   */
  new PureCounter();

  // AOS
  AOS.init();
});
