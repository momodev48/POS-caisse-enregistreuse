importScripts('https://www.gstatic.com/firebasejs/7.17.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.17.1/firebase-messaging.js');
/*Update this config*/
var config = {
   apiKey: "AIzaSyAmQ43V5XgOtd9Yd_wo-FROpkQ3tWLqcX0",
    authDomain: "my-apps-project-9ba31.firebaseapp.com",
    databaseURL: "https://my-apps-project-9ba31.firebaseio.com",
    projectId: "my-apps-project-9ba31",
    storageBucket: "my-apps-project-9ba31.appspot.com",
    messagingSenderId: "562824560989",
    appId: "1:562824560989:web:7f068c5adbf5436210e8b4"
  };
  firebase.initializeApp(config);

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = payload.data.title;
  const notificationOptions = {
    body: payload.data.body,
	icon: 'http://localhost/gcm-push/img/icon.png',
	image: 'http://localhost/gcm-push/img/d.png'
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});
// [END background_handler]