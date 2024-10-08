// importScripts('https://www.gstatic.com/firebasejs/4.9.1/firebase.js');

importScripts("https://www.gstatic.com/firebasejs/7.6.1/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/7.6.1/firebase-messaging.js");
importScripts("https://www.gstatic.com/firebasejs/7.6.1/firebase-analytics.js");
importScripts("https://www.gstatic.com/firebasejs/7.6.1/firebase-auth.js");
importScripts("https://www.gstatic.com/firebasejs/7.6.1/firebase-firestore.js");

// Initialize Firebase
firebase.initializeApp({
    apiKey: "AIzaSyBlGBbw1KXNxDSwoxAI1r4k4l08Vd_GA20",
    authDomain: "direct-685ca.firebaseapp.com",
    projectId: "direct-685ca",
    storageBucket: "direct-685ca.appspot.com",
    messagingSenderId: "143897896410",
    appId: "1:143897896410:web:cffcfb85c3766bbb370ce3",
    measurementId: "G-CZRG5NYJNH"
});

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    const notificationTitle = payload.data.title;
    const notificationOptions = {
        title: payload.data.title,
        body: payload.data.body_ar,
    };

    return self.registration.showNotification(notificationTitle,
        notificationOptions);
});
