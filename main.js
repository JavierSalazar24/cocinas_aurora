if (navigator.serviceWorker) {
  navigator.serviceWorker.register("./sw.js");

  Notification.requestPermission(function (result) {
    if (result === "granted") {
      navigator.serviceWorker.ready.then(function (registration) {
        registration.update();
      });
    }
  });
}
