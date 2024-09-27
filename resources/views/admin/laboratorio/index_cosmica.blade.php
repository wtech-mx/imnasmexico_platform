@extends('layouts.app_admin')

@section('template_title')
    Laboratorio Cosmica
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">

                    <h3 class="mb-3">Laboratorio Cosmica</h3>

                    <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como fucniona?
                    </a>
                </div>
            </div>



          </div>
        </div>
      </div>
</div>
@endsection

@section('datatable')

<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>



</script>
@endsection
