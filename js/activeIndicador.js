const secciones = document.querySelectorAll(".seccion");
const menuItems = document.querySelectorAll(".menu_item");
const funcionObserver = (entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      const itemActual = Array.from(menuItems).find(
        (item) => item.dataset.url === entry.target.id
      );
      itemActual.classList.add("active");
      for (const item of menuItems) {
        if (item != itemActual) {
          item.classList.remove("active");
        }
      }
    }
  });
};
const observer = new IntersectionObserver(funcionObserver, {
  root: null,
  rootMargin: "-100px",
  threshold: 1,
});
secciones.forEach((seccion) => observer.observe(seccion));
const progressbar = document.querySelector(".progressbar");
function ScrollProgressBar() {
  const scrollTop = document.documentElement.scrollTop;
  const scrollHeight = document.documentElement.scrollHeight;
  const clientHeight = document.documentElement.clientHeight;
  const windowHeight = scrollHeight - clientHeight;
  const porcentaje = (scrollTop / windowHeight) * 100;
  progressbar.style.width = porcentaje + "%";
}
window.addEventListener("scroll", ScrollProgressBar);
