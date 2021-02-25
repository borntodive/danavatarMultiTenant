@php
    $breadcrumbs=[
        'Dashboard'=>route('dashboard'),
        'Wearable'=>route('wearable.calendar',[$user])
    ];
    $button2['label']='Live ECG';
    $button2['href']=route('wearable.ecg.live',['user'=>$user->id]);
@endphp

    <x-app-layout>
        <x-slot name="header">
            <x-layout.header :title="__('Dati del Wearable di').' '.$user->name" :breadcrumbs="$breadcrumbs" />
        </x-slot>
        <x-medical-record.header
            :user="$user"
            :button2="$button2"
        />
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-card title="ECG" class="mb-5 h-px-600">
                <div class="highCharts h-96 w-full" id="chart_ecg" style="height: 500px;"></div>
            </x-card>
        </div>

    </x-app-layout>
<link rel="stylesheet" href="https://unpkg.com/@dmuy/timepicker@2.0.0/dist/mdtimepicker.css">
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/data.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"
    integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ=="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.32/moment-timezone-with-data-10-year-range.js"
    integrity="sha512-uXecwcw6BVqSCG1YCgnrnvGIijYyX2LlGOtA5sydZeQARKXs/IkHK0y9amhoOg0sgNFIVRNXWFaiMOLKKvdIxQ=="
    crossorigin="anonymous"></script>

<script>
    var ecgChart;
    const timezone = 'Europe/Rome';
    Highcharts.setOptions({
            time: {
                timezone: timezone
            }
        });
        const start = moment();
        var end = start.clone();
        end = end.add(5, 'm');
        const xAxis = {
            // gridLineWidth: 1,
            tickInterval: 200,
            minorTicks: true,
            minorTickInterval: 40,
            gridLineWidth: 1,
            minorGridLineColor: 'red',
            minorGridLineDashStyle: 'dot',
            gridLineColor: 'red',
            type: 'datetime',
            min: start,
            max: end,
            //minRange: 2000,
            //maxRange: 2000,
        }
        const yAxis = {
            opposite: false,
            tickInterval: 0.5,
            minorTicks: true,
            minorTickInterval: 0.1,
            gridLineWidth: 1,
            minorGridLineColor: 'red',
            minorGridLineDashStyle: 'dot',
            gridLineColor: 'red',
            title: {
                text: 'mV',
            },
        }
        const rangeSelector = {
            inputEnabled: false,
            buttons: [{
                type: 'second',
                count: 1,
                text: "@lang('samples.1s')",
            }, {
                type: 'second',
                count: 2,
                text: "@lang('samples.2s')",
            },
            {
                type: 'second',
                count: 3,
                text: "@lang('samples.3s')",
            },
            {
                type: 'all',
                text: "@lang('samples.all')",
            }],
            //selected: 1
        }
        ecgChart = Highcharts.stockChart('chart_ecg', {
            chart: {
                zoomType: 'x',
            },
            xAxis: xAxis,
            yAxis: yAxis,
            navigator: {},
            legend: {
                enabled: false,
            },
            plotOptions:{
                series:{
                    turboThreshold:0,
                    animation: false
                }
            },
            rangeSelector: rangeSelector,
            /* series: [{
                type: 'line',
                name: data.sensor.displayName,
                turboThreshold: 0,
                color: data.sensor.color,
                data: data.data,
            }], */
            series: [{
                data: []
            }]
        });

    var ecgData =[];
    var first=true;
    Echo.channel('ecg-data.'+"{{$user->id}}")
        .listen('NewEcgData', (e) => {

            const points= JSON.parse(e.data)
            ecgData= ecgData.concat(points);
            ecgChart.series[0].setData(ecgData);
            const series = ecgChart.series[0];
            // if (first) {
            //    newStart = series.xData[ (series.xData.length-400) ],
            //    newEnd = series.xData[ (series.xData.length-1) ];
            //    ecgChart.xAxis[0].setExtremes(newStart,newEnd);
            // }
            // first=false;
            // add the point
            //console.log(points);
            /* points.forEach(function(point) {
                const series = ecgChart.series[0],
                shift = series.data.length > 20; // shift if the series is longer than 20
                ecgChart.series[0].addPoint(point, true, shift);
            }); */

        });

</script>
