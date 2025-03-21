    // Detectar cambios de conexión
    function isOnline() {

        if (!navigator.onLine ) {
             console.log('Offline');

          $(document).ready(function() {
             $("#modal_offline").modal("show");
          });

            $('#modal_offline').fadeIn();
              setTimeout(function() {
                   $("#modal_offline").fadeOut();
              },100000);

        }
    }
    window.addEventListener('online', isOnline );
    window.addEventListener('offline', isOnline );
    isOnline();
