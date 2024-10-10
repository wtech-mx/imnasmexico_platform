<div class="row">
    @foreach ($product as $item)
    <div class="card">


        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Informacion</button>
            </li>

            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Modificaciones</button>
            </li>

            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Ventas</button>
            </li>

          </ul>

          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <div class="row">
                    <div class="col-12 col-md-3 col-lg-2">
                        <img src="{{ $item->imagenes }}" class="w-100" style="width: 100px">
                    </div>

                    <div class="col-8 col-md-9 col-lg-7 my-auto">
                        <h3>{{ $item->nombre }}</h3>
                        <p class="text-dark">
                            <strong  class="text-dark">Categoria: </strong> {{ $item->categoria }} <br>
                            <strong  class="text-dark">Subcategoria: </strong> {{ $item->subcategoria }} <br>
                            <strong  class="text-dark">Precio: </strong> ${{ $item->precio_normal }} .0<br>
                        </p>
                    </div>

                    <div class="col-4 col-md-12 col-lg-3 my-auto">
                        <p class="text-dark">
                            <strong>SKU:</strong> {{ $item->sku }} <br>
                            <strong class="text-dark">Stock Castilla:</strong> {{ $item->stock }} pza <br>
                            @if(empty($item->stock_nas) == null)
                                <strong class="text-dark">Lab Stock :</strong> {{ $item->stock_nas }} pza <br>
                            @else
                            @endif
                            @if(empty($item->stock_cosmica) == null)
                                <strong class="text-dark">Lab Stock :</strong> {{ $item->stock_cosmica }} pza <br>
                            @else
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">

            </div>

            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">

            </div>
          </div>

    </div>

    @endforeach
</div>
