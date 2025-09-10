// Get modal
var modal = document.getElementById("mail_modal");
// Get button for the modal
var btn = document.getElementById("btn_modal");
// Get the span element of the modal
var span = document.getElementsByClassName("close")[0];
// Open modal
btn.onclick = function () {
  modal.style.display = "block";
};
// Click span
span.onclick = function () {
  modal.style.display = "none";
};
// Click outside the modal
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
