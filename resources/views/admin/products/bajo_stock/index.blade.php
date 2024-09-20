@extends('layouts.app_admin')

@section('template_title')
    Products
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>

                    <h3 class="mb-3">Products stock</h3>

                    <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como fucniona?
                    </a>

                   <!-- <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button class="btn btn-success">Importar Products</button>
                    </form>-->
                    @can('productos-create')
                        <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_product" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            <i class="fa fa-fw fa-edit"></i> Crear
                        </a>
                    @endcan
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="container mt-4">
                        <h4>Carrito de pedido</h4>
                        <ul id="cartItems" class="list-group"></ul>
                        <button id="saveCartBtn" class="btn btn-primary mt-3">Guardar pedido</button>
                    </div>
                </div>

                <div class="col-8">
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-search">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio Normal</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            @foreach ($products as $product)
                                <tr class="product-row" data-product='@json($product)'>
                                    <td>
                                        <img id="blah" src="{{$product->imagenes}}" alt="Imagen" class="w-10 ms-3"/>
                                        <h6 class="ms-3 my-auto">{{ $product->nombre }}</h6>
                                    </td>
                                    <td>${{ number_format($product->precio_normal, 0, '.', ',') }}</td>
                                    <td>{{ $product->stock }}</td>
                                </tr>
                                @include('admin.products.bajo_stock.modal')
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>

          </div>
        </div>
      </div>
</div>
@include('admin.products.modal_create')
@endsection

@section('datatable')

<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>

<script>

    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });

    $(document).ready(function() {
    let cart = [];

    // Delegar el evento de clic en las filas de productos (.product-row)
    document.addEventListener('click', function(event) {
        // Verificar si el clic fue en una fila de producto
        if (event.target.closest('.product-row')) {
            let row = event.target.closest('.product-row');
            let product = JSON.parse(row.dataset.product);

            // Rellenar los detalles en el offcanvas
            document.getElementById('productImage').src = product.imagenes;
            document.getElementById('productName').innerText = product.nombre;
            document.getElementById('productPrice').innerText = product.precio_normal.toLocaleString();
            document.getElementById('productStock').innerText = product.stock;
            document.getElementById('cantidad').value = 1; // Valor por defecto en cantidad

            // Guardar el producto en el botón de agregar al carrito
            document.getElementById('addToCartBtn').dataset.product = JSON.stringify(product);

            // Abrir el offcanvas
            let offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasProduct'));
            offcanvas.show();
        }
    });

    // Función para agregar el producto al carrito
    document.getElementById('addToCartBtn').addEventListener('click', function() {
        let product = JSON.parse(this.dataset.product);
        let cantidad = parseInt(document.getElementById('cantidad').value);

        // Crear un objeto con los detalles del producto
        let cartItem = {
            id: product.id,
            nombre: product.nombre,
            stock: product.stock,
            cantidad: cantidad,
        };

        // Verificar si el producto ya está en el carrito
        let existingItem = cart.find(item => item.id === product.id);

        if (existingItem) {
            // Si ya está, solo actualiza la cantidad
            existingItem.cantidad += cantidad;
        } else {
            // Si no está, agregar al carrito
            cart.push(cartItem);
        }

        // Actualizar la vista del carrito
        updateCartView();

        // Cerrar el offcanvas
        let offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasProduct'));
        offcanvas.hide();
    });

    // Función para actualizar la vista del carrito
    function updateCartView() {
        let cartItemsContainer = document.getElementById('cartItems');
        cartItemsContainer.innerHTML = ''; // Limpiar la lista actual

        cart.forEach(function(item, index) {
            let li = document.createElement('li');
            li.classList.add('list-group-item');
            li.innerHTML = `
                <strong>${item.nombre}</strong> - Cantidad: ${item.cantidad}
                <button class="btn btn-danger btn-sm float-end" onclick="removeCartItem(${index})">Eliminar</button>
            `;
            cartItemsContainer.appendChild(li);
        });
    }

    // Función para eliminar un producto del carrito
    window.removeCartItem = function(index) {
        cart.splice(index, 1); // Eliminar el producto del carrito
        updateCartView(); // Actualizar la vista del carrito
    };

    // Evento al hacer clic en el botón "Guardar Carrito"
    $('#saveCartBtn').click(function() {
        if (cart.length === 0) {
            alert('El carrito está vacío');
            return;
        }

        // Realizar una petición AJAX para enviar los datos al servidor
        $.ajax({
            url: '/admin/productos/guardar-carrito', // Ruta que definiremos en Laravel
            method: 'POST',
            data: {
                cart: cart, // Enviar el carrito
                _token: '{{ csrf_token() }}' // Token CSRF para seguridad
            },
            success: function(response) {
                // Mostrar un mensaje de éxito
                alert('Carrito guardado exitosamente');

                // Redirigir a la página proporcionada en la respuesta
                if (response.redirect_url) {
                    window.location.href = response.redirect_url;
                }
            },
            error: function(xhr, status, error) {
                // Manejo de errores
                alert('Hubo un error al guardar el carrito');
            }
        });
    });
});



</script>
@endsection
