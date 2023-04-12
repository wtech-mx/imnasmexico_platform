@if (Session::has('modal_checkout'))
<script>
document.addEventListener('DOMContentLoaded', function() {
        var addedToCartModal = document.querySelector('#checkout_modal');
        var bootstrapModal = new bootstrap.Modal(addedToCartModal);
        bootstrapModal.show();
    });
</script>
@endif

@if (Session::has('login_error'))
<script>
document.addEventListener('DOMContentLoaded', function() {
        var addedToCartModal = document.querySelector('#login_modal');
        var bootstrapModal = new bootstrap.Modal(addedToCartModal);
        bootstrapModal.show();
    });
</script>
@endif


@if (Session::has('success'))
<script>
    Swal.fire({
        title: 'Exito!!',
        html: 'Se ha <b>agragado</b> </br> ',
        imageUrl: '{{ asset('img/icon/checked.png') }}',
        background: '#fff',
        imageWidth: 150,
        imageHeight: 150,
    })

</script>
@endif

@if (Session::has('edit'))
<script>
    Swal.fire({
        title: 'Exito!!',
        html: 'Se ha <b>editado</b> </br>',
        imageUrl: '{{ asset('img/icon/edit.png') }}',
        background: '#fff',
        imageWidth: 150,
        imageHeight: 150,
    })

</script>
@endif

@if (Session::has('delete'))
<script>
    Swal.fire({
        title: 'Exito!!',
        html: 'Se ha <b>eliminado</b> </br>',
        imageUrl: '{{ asset('img/icon/delete.png') }}',
        background: '#fff',
        imageWidth: 150,
        imageHeight: 150,
    })

</script>
@endif
