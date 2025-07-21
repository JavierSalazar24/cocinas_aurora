const btnSwitch = document.querySelector("#switch");
btnSwitch.addEventListener("click", () => {
  document.body.classList.toggle("dark");
  btnSwitch.classList.toggle("active");
  if (document.body.classList.contains("dark")) {
    localStorage.setItem("dark-mode", "true");
  } else {
    localStorage.setItem("dark-mode", "false");
  }
});
if (localStorage.getItem("dark-mode") === "true") {
  document.body.classList.add("dark");
  btnSwitch.classList.add("active");
} else {
  document.body.classList.remove("dark");
  btnSwitch.classList.remove("active");
}
window.addEventListener("touchstart", onTouchStart, { passive: !0 });
function onTouchStart(e) {
  console.log(e.defaultPrevented);
  e.preventDefault();
  console.log(e.defaultPrevented);
}
if (document.getElementById("perfilNav")) {
  let perfilNav = document.getElementById("perfilNav");
  perfilNav.addEventListener("click", (e) => {
    e.preventDefault();
  });
}
