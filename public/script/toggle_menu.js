function toggle_menu() {
  const nav = document.getElementById("nav_links");
  nav.classList.toggle("open");

  // Debug: optional, um zu prüfen ob die Klasse gesetzt wird
  console.log("Menu toggled:", nav.classList.contains("open"));
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
