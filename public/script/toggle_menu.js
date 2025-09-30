function toggle_menu() {
  let nav = document.getElementById("nav_links");
  if (nav.style.display === "block") {
    nav.style.display = "none";
  } else {
    nav.style.display = "block";
  }
}
