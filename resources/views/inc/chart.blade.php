<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
{{--<link rel="stylesheet" href="{{asset('css/chartist.min.css')}}">--}}


<canvas id="lineChart" width="400" height="400"></canvas>

<script>
    $(function () {
        displayLineChart();
    })

    var labels = @json($labels);
    var sheets = @json($sheets);


    function displayLineChart() {
        var data = {
            labels: labels,
            datasets: sheets
        };

        var ctx = document.getElementById("lineChart").getContext("2d");
        var options = {};
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    }

</script>



