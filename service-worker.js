// service-worker.js

self.addEventListener('push', function (event) {
  const options = {
    body: event.data.text(),
    icon: '/public/images/new_icon.png',
  };

  event.waitUntil(
    self.registration.showNotification('제목', options)
  );
});
