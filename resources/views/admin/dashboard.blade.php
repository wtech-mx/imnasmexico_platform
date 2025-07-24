@extends('layouts.app_admin')

@section('template_title')
    Dashboard
@endsection
@php
    use Carbon\Carbon;
    use Carbon\CarbonInterface;
@endphp

@section('content')
    <div class="container-fluid py-0 py-lg-4">
        @can('dashboard-cursos')
            @include('admin.dashboard_admin')
        @endcan

        @can('dashboard-users')
            @include('admin.dashboard_users')
        @endcan

        @can('dashboard-cam')
        @endcan
        <div class="container">
            <h3>Avisos del sistema</h3>
            <ul class="list-group">
                @foreach($avisos as $aviso)
                    @php
                        if($aviso->tipo_prioridad == 'Urgente'){
                            $icon = asset('assets/cam/change.png');
                        } elseif ($aviso->tipo_prioridad == 'Importante') {
                            $icon = asset('assets/cam/checked.png');
                        } else {
                            $icon = asset('assets/cam/heart.png');
                        }
                    @endphp
                <li class="list-group-item d-flex justify-content-between align-items-start"
                    data-id="{{ $aviso->id }}">
                    <div class="ms-2 me-auto">

                        <div class="fw-bold">{{ $aviso->titulo }} <img src="{{ $icon }}" class="mt-2" width="20px"></div>
                        <p class="fw-bold">{{ $aviso->fecha_programada }}</p>
                        @if($aviso->descripcion)
                            {!! Str::limit($aviso->descripcion, 100) !!}
                        @endif
                        @if($aviso->url)
                            <br>
                            <a href="{{ $aviso->url }}" target="_blank" class="ver-video">Ver video</a>
                        @endif
                    </div>
                    <button class="btn btn-sm btn-primary btn-aviso-ver">Confirmar</button>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@include('admin.profesores.modal_prof_create')
@include('admin.marketing.modal_cupon_create')

@endsection

@section('js_custom')

  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");
    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: {!! json_encode($meses) !!},
        datasets: [{
          label: "Total Ventas",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: {!! json_encode($datachart) !!},
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script>
document.addEventListener('DOMContentLoaded', function(){
  document.querySelectorAll('.btn-aviso-ver').forEach(btn=>{
    btn.addEventListener('click', function(){
      const li     = this.closest('li[data-id]');
      const avisoId= li.dataset.id;

      fetch(`/avisos/${avisoId}/clic`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      }).then(r=>r.json())
        .then(json=>{
          if(json.ok) {
            this.textContent = 'Leído ✓';
            this.disabled = true;
          }
        });
    });
  });
});
</script>
@endsection
