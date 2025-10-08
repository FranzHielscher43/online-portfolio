function toggle_menu() {
  const nav = document.getElementById("nav_links");
  nav.classList.toggle("open");
}

document.addEventListener("DOMContentLoaded", () => {
  const nav = document.getElementById("nav_links");
  const links = nav.querySelectorAll("a");

  links.forEach((link) => {
    link.addEventListener("click", () => {
      if (window.innerWidth <= 900) {
        nav.classList.remove("open");
      }
    });
  });
});
