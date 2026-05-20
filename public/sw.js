// const CACHE_NAME = 'v1';
// const urlsToCache = [
//   '/'
// ];

// // Install event - cache initial resources
// self.addEventListener('install', (event) => {
//   event.waitUntil(
//     caches.open(CACHE_NAME).then((cache) => {
//       return cache.addAll(urlsToCache);
//     })
//   );
// });

// // Fetch event - cache new requests dynamically
// self.addEventListener('fetch', (event) => {
//   event.respondWith(
//     caches.match(event.request).then((response) => {
//       // Return cached response if available, otherwise fetch from network
//       return response || fetch(event.request).then((fetchResponse) => {
//         return caches.open(CACHE_NAME).then((cache) => {
//           // Cache the new resource dynamically
//           cache.put(event.request, fetchResponse.clone());
//           return fetchResponse;
//         });
//       });
//     })
//   );
// });

// // Activate event - clean up old caches
// self.addEventListener('activate', (event) => {
//   const cacheWhitelist = [CACHE_NAME];
//   event.waitUntil(
//     caches.keys().then((cacheNames) => {
//       return Promise.all(
//         cacheNames.map((cacheName) => {
//           if (!cacheWhitelist.includes(cacheName)) {
//             return caches.delete(cacheName);
//           }
//         })
//       );
//     })
//   );
// });


self.addEventListener('push', function (e) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        // Les notifications ne sont pas supportées ou la permission n'est pas accordée
        return;
    }

    if (e.data) {
        var msg = e.data.json();
        console.log(msg);
        e.waitUntil(
            self.registration.showNotification(msg.title, {
                body: msg.body,
                icon: msg.icon,
                actions: msg.actions,
                data: {
                    url: msg.data.url // Inclure l'URL dans les données de la notification
                }
            })
        );
    }
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close(); // Ferme la notification

    // Vérifie l'action cliquée
    if (event.action === 'open_url') {
        clients.openWindow(event.notification.data.url); // Ouvre l'URL
    } else {
        // Gestion des clics sur la notification sans action spécifique
        clients.openWindow(event.notification.data.url);
    }
});
