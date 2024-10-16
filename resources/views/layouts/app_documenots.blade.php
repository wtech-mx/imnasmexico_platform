<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/'. $configuracion->favicon) }}"> --}}
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/'. $configuracion->favicon) }}">

  <link rel="shortcut icon" href="{{asset('assets/user/logotipos/favicon.png')}}" type="image/png">

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>

  <link href="{{asset('assets/user/custom/documentos.css')}}" rel="stylesheet" />
<title>
  @yield('template_title') - {{$configuracion->nombre_sistema}}
</title>

  @yield('css_custom')

</head>
<body>

	<div class="section over-hide">
		<div class="container">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
					<div class="section text-center py-5 py-md-0">

			          	<input class="pricing" type="checkbox" id="pricing" name="pricing"/>

			          	<label for="pricing">
                            <span class="block-diff">Frontal
                                <span class="float-right">Posterior</span>
                            </span>
                        </label>

						<div class="card-3d-wrap mx-auto">

							<div class="card-3d-wrapper">

                                @yield('content_documentos')

			      			</div>
			      		</div>
			      	</div>
		      	</div>
	      	</div>
	    </div>
	</div>

</body>
</html>
