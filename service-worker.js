// service-worker.js

self.addEventListener("install", (event) => {
  event.waitUntil(
    caches.open("my-cache").then((cache) => {
      return cache.addAll(["/", "/css/style.css", "/js/main.js"]);
    })
  );
});
