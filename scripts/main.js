/**
 * Template Name: Yummy
 * Updated: Jan 09 2024 with Bootstrap v5.3.2
 * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */
document.addEventListener("DOMContentLoaded", () => {
  "use strict";

  /**
   * Preloader
   */
  const preloader = document.querySelector("#preloader");
  if (preloader) {
    window.addEventListener("load", () => {
      preloader.remove();
    });
  }

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

  /**
   * Animation on scroll function and init
   */
});
