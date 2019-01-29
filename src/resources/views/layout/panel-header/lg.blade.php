<div class="panel-header panel-header-lg">
    <canvas id="bigDashboardChart"></canvas>
</div>

{{--@push('script')--}}
    {{--<script>--}}
        {{--var ctx = document.getElementById('bigDashboardChart').getContext("2d");--}}
        {{--var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);--}}
        {{--gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");--}}
        {{--gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");--}}
        {{--var chartColor = '#FFFFFF';--}}
        {{--var data_default = {--}}
            {{--label: "Data",--}}
            {{--borderColor: chartColor,--}}
            {{--pointBorderColor: chartColor,--}}
            {{--pointBackgroundColor: "#1e3d60",--}}
            {{--pointHoverBackgroundColor: "#1e3d60",--}}
            {{--pointHoverBorderColor: chartColor,--}}
            {{--pointBorderWidth: 1,--}}
            {{--pointHoverRadius: 7,--}}
            {{--pointHoverBorderWidth: 2,--}}
            {{--pointRadius: 5,--}}
            {{--fill: true,--}}
            {{--backgroundColor: gradientFill,--}}
            {{--borderWidth: 2,--}}
            {{--data: [50, 150, 100, 190, 130, 90, 150, 160, 120, 140, 190, 95]--}}
        {{--};--}}

        {{--var myChart = new Chart(ctx, {--}}
            {{--type: 'line',--}}
            {{--data: {--}}
                {{--labels: ["ЯНВ", "ФЕВ", "МАР", "АПР", "МАЙ", "ИЮН", "ИЮЛ", "АВГ", "СЕН", "ОКТ", "НОЯ", "ДЕК"],--}}
                {{--datasets: [data_default]--}}
            {{--},--}}
            {{--options: {--}}
                {{--layout: {--}}
                    {{--padding: {--}}
                        {{--left: 20,--}}
                        {{--right: 20,--}}
                        {{--top: 0,--}}
                        {{--bottom: 0--}}
                    {{--}--}}
                {{--},--}}
                {{--maintainAspectRatio: false,--}}
                {{--tooltips: {--}}
                    {{--backgroundColor: '#fff',--}}
                    {{--titleFontColor: '#333',--}}
                    {{--bodyFontColor: '#666',--}}
                    {{--bodySpacing: 4,--}}
                    {{--xPadding: 12,--}}
                    {{--mode: "nearest",--}}
                    {{--intersect: 0,--}}
                    {{--position: "nearest"--}}
                {{--},--}}
                {{--legend: {--}}
                    {{--position: "bottom",--}}
                    {{--fillStyle: "#FFF",--}}
                    {{--display: true--}}
                {{--},--}}
                {{--scales: {--}}
                    {{--yAxes: [{--}}
                        {{--ticks: {--}}
                            {{--fontColor: "rgba(255,255,255,0.4)",--}}
                            {{--fontStyle: "bold",--}}
                            {{--beginAtZero: true,--}}
                            {{--maxTicksLimit: 5,--}}
                            {{--padding: 10--}}
                        {{--},--}}
                        {{--gridLines: {--}}
                            {{--drawTicks: true,--}}
                            {{--drawBorder: false,--}}
                            {{--display: true,--}}
                            {{--color: "rgba(255,255,255,0.1)",--}}
                            {{--zeroLineColor: "transparent"--}}
                        {{--}--}}

                    {{--}],--}}
                    {{--xAxes: [{--}}
                        {{--gridLines: {--}}
                            {{--zeroLineColor: "transparent",--}}
                            {{--display: false,--}}

                        {{--},--}}
                        {{--ticks: {--}}
                            {{--padding: 10,--}}
                            {{--fontColor: "rgba(255,255,255,0.4)",--}}
                            {{--fontStyle: "bold"--}}
                        {{--}--}}
                    {{--}]--}}
                {{--}--}}
            {{--}--}}
        {{--});--}}
    {{--</script>--}}
{{--@endpush--}}
