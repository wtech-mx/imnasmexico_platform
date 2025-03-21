function isIos() {

    if (ios) {
       console.log('ios');
      $(document).ready(function() {
         $("#modal-ios").modal("show");
      });

    }
}

const userAgent = window.navigator.userAgent.toLowerCase();
const ios = (/iphone|ipad|ipod/.test(userAgent));


window.addEventListener('ios', isIos );

isIos();
