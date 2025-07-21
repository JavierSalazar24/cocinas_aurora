let notificacionCerramosEn30 = false;
let notificacionCerramosEn10 = false;
let notificacionCerramosEn5 = false;
let notificacionYaCerramos = false;
let notificacionAbrimosEn10 = false;
let notificacionYaAbrimos = false;

let dia = new Date();
if (dia.getDay() >= 1 && dia.getDay() <= 5) {
  setInterval(funciones, 20000);
}

function funciones() {
  let date = new Date();
  let hora = `${date.getHours()}${date.getMinutes()}`;
  if (hora == 160 && notificacionCerramosEn30 == false) CerramosEn30();
  else if (hora == 1620 && notificacionCerramosEn10 == false) CerramosEn10();
  else if (hora == 1625 && notificacionCerramosEn5 == false) CerramosEn5();
  else if (hora == 1630 && notificacionYaCerramos == false) YaCerramos();
  else if (hora == 850 && notificacionAbrimosEn10 == false) AbrimosEn10();
  else if (hora == 90 && notificacionYaAbrimos == false) YaAbrimos();
}

function CerramosEn30() {
  const titulo = "Cocinas Aurora";
  const opciones = {
    body: "Cerramos en 30 minutos",
    icon: "images/corazon.png",
  };
  self.registration.showNotification(titulo, opciones);
  notificacionCerramosEn30 = true;
}

function CerramosEn10() {
  const titulo = "Cocinas Aurora";
  const opciones = {
    body: "Cerramos en 10 minutos",
    icon: "images/corazon.png",
  };
  self.registration.showNotification(titulo, opciones);
  notificacionCerramosEn10 = true;
}

function CerramosEn5() {
  const titulo = "Cocinas Aurora";
  const opciones = {
    body: "Cerramos en 5 minutos",
    icon: "images/corazon.png",
  };
  self.registration.showNotification(titulo, opciones);
  notificacionCerramosEn5 = true;
}

function YaCerramos() {
  const titulo = "Cocinas Aurora";
  const opciones = {
    body: "Ya cerramos, mañana abrimos a las 9",
    icon: "images/corazon.png",
  };
  self.registration.showNotification(titulo, opciones);
  notificacionYaCerramos = true;
}

function AbrimosEn10() {
  const titulo = "Cocinas Aurora";
  const opciones = {
    body: "Abrimos en 10 minutos",
    icon: "images/corazon.png",
  };
  self.registration.showNotification(titulo, opciones);
  notificacionAbrimosEn10 = true;
}

function YaAbrimos() {
  const titulo = "Cocinas Aurora";
  const opciones = {
    body: "Ya abrimos, puedes venir al negocio",
    icon: "images/corazon.png",
  };
  self.registration.showNotification(titulo, opciones);
  notificacionYaAbrimos = true;
}
