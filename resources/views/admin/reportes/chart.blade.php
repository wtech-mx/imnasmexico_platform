<div class="d-flex justify-content-evenly">
    <div class="row">
    @foreach($data as $label => $value)
        <div class="col-4 mt-2 ">
            {{ $label }} - ${{ number_format($value, 2) }}
            <br>
            <div class="grafica_syle" style="background: {{ $colors[$loop->index] }}">-</div></br>
        </div >
    @endforeach
</div>
</div>
<div class="card-body p-3">
    <div class="chart">
        <canvas id="doughnut-chart" class="chart-canvas" height="300"></canvas>
    </div>
</div>
<script>
    var ctx3 = document.getElementById("doughnut-chart").getContext("2d");
    new Chart(ctx3, {
        type: "doughnut",
        data: {
            datasets: [{
                backgroundColor: @json($colors),
                data: @json(array_values($data))
            }]
        }
    });
</script>
