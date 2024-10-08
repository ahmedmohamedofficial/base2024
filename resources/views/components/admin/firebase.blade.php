<!-- FireBase -->
<!-- The core Firebase JS SDK is always required and must be listed first -->
{{-- <script src="https://www.gstatic.com/firebasejs/7.6.1/firebase.js"></script> --}}
<script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-firestore.js"></script>
<script src="{{ asset('dashboard/assets/js/ui-toasts.js') }}"></script>


<script>
    // Your web app's Firebase configuration
    const firebaseConfig = {
        apiKey: "AIzaSyBlGBbw1KXNxDSwoxAI1r4k4l08Vd_GA20",
        authDomain: "direct-685ca.firebaseapp.com",
        projectId: "direct-685ca",
        storageBucket: "direct-685ca.appspot.com",
        messagingSenderId: "143897896410",
        appId: "1:143897896410:web:cffcfb85c3766bbb370ce3",
        measurementId: "G-CZRG5NYJNH"
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    //firebase.analytics();

    const messaging = firebase.messaging();
    window.fcmMessageing = messaging;

    //messaging.usePublicVapidKey("");

    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {

        } else {

        }
    });

    messaging.getToken().then((currentToken) => {
        if (currentToken){

            // console.log(currentToken)
            function setDevice(guardType){
                let options                 =   {
                    url: '{{ route('setDevice') }}',
                    method:"POST",
                    data:{
                        _token:'{{ csrf_token() }}',
                        device_id:currentToken,
                        device_type:'web',
                        guard:guardType,
                    },
                };
                $.ajax(options);
            }

            let sessionAdmin            =   '{{ session()->get('admin_device_id') }}';
            if ('{{ auth()->guard('admin')->check() }}' && sessionAdmin === ''){
                setDevice('admin');
            }
        }
    }).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
    });

    @if($authType == 'admin')
        messaging.onMessage(function(payload) {
            console.log(payload)
            let countNotify = $('#countNotify');
            countNotify.text(parseInt(countNotify.text()) + 1);
            let x = document.getElementById("soundNotify");
            x.play();

            let totsId = 'tots-' +  payload['fcmMessageId'];
            let createdAt = payload['data']['created_at'];

            let delay = 3000;

            let divNotify = ` <div
                class="bs-toast toast my-2 ${totsId} animate__animated my-2"
                style="width: 100% !important; margin-bottom: 0 !important; padding: 0 !important;"
                role="alert"
                aria-live="assertive"
                aria-atomic="true"
                id="${totsId}"
                data-bs-delay="${delay}">
                <div class="toast-header">
                  <i class="ti ti-bell ti-xs me-2"></i>
                  <div class="me-auto fw-medium">${payload['notification']['title']}</div>
                  <small class="text-muted">${createdAt}</small>
                  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <a href="{{ route('admin.admins.notifications') }}"><div class="toast-body">${payload['notification']['body']}</div></a>
              </div>`;
        $('#toast-container').prepend(divNotify);

        let toastAnimation;
        let toastAnimationExample = document.querySelector('.' + totsId);
            toastAnimationExample.classList.add('animate__flash');
            toastAnimationExample.querySelector('.ti').classList.add('text-primary');
            toastAnimation = new bootstrap.Toast(toastAnimationExample);
            toastAnimation.show();

        });
    @endif
</script>
