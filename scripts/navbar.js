document.addEventListener("DOMContentLoaded", function () {
  const navbarToggler = document.querySelector(".navbar-toggler");
  const navbarIcon = navbarToggler.querySelector(".navbar-toggler-icon i");

  navbarToggler.addEventListener("click", function () {
    navbarIcon.classList.toggle("bi-list");
    navbarIcon.classList.toggle("bi-x-lg");
  });
});
