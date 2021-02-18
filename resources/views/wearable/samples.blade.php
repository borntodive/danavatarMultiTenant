@php
    $breadcrumbs=[
        'Dashboard'=>route('dashboard'),
        'Wearable'=>route('wearable.calendar',[$user])
    ];
    $button2=null;
    if ($ecg) {
        $button2['label']='ECG';
        $button2['href']=route('wearable.ecg.day',[$user,"date"=>$date]);
    }
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
        @foreach ($sensors as $sensor)
            <x-card title="{{ $sensor->displayName }}" class="mb-5 h-px-600">
                <div class="highCharts h-96 w-full" id="chart_{{$sensor->name}}" sensor-id="{{$sensor->id}}"></div>

            </x-card>

        @endforeach
    </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/data.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/timeline.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"
        integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ=="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.32/moment-timezone-with-data-10-year-range.js" integrity="sha512-uXecwcw6BVqSCG1YCgnrnvGIijYyX2LlGOtA5sydZeQARKXs/IkHK0y9amhoOg0sgNFIVRNXWFaiMOLKKvdIxQ==" crossorigin="anonymous"></script>


<script>


    $( ".highCharts" ).each(function() {
        var that=this;
        var sensor_id=$(this).attr('sensor-id');
        const timezone='Europe/Rome';

        Highcharts.getJSON('/ajax/samples/per-day?sensorId='+sensor_id+'&userId={{$user->id}}&date={{$date}}', function (data) {
            // Create the chart
            Highcharts.setOptions({
                time: {
                    timezone: timezone
                }
            });
            if (data.sensor.name!='Position') {
                const xAxis = {
                    // gridLineWidth: 1,
                    type: 'datetime',
                    events: {
                        afterSetExtremes: afterSetExtremes,
                    },
                }
                const yAxis = {
                    opposite: false,
                    title: {
                        text: data.sensor.displayName,
                    },
                }
                const rangeSelector = {
                    inputEnabled: false,
                    buttons: [{
                        type: 'minute',
                        count: 5,
                        text: "5m",
                    }, {
                        type: 'minute',
                        count: 30,
                        text: "30m",
                    }, {
                        type: 'hour',
                        count: 1,
                        text: "1h",
                    }, {
                        type: 'hour',
                        count: 12,
                        text: "12h",
                    }, {
                        type: 'all',
                        text: "Tutti",
                    }],
                }
                Highcharts.stockChart(that.id, {
                    chart: {
                        zoomType: 'x',
                    },
                    xAxis: xAxis,
                    yAxis: yAxis,
                    navigator: {
                        adaptToUpdatedData: false,
                        series: {
                            data: data.data,
                        },
                    },
                    legend: {
                        enabled: false,
                    },
                    rangeSelector: rangeSelector,
                    series: [{
                        type: 'line',
                        name: data.sensor.displayName,
                        turboThreshold: 0,
                        color: data.sensor.color,
                        data: data.data,
                    }],
                });
            }
            else {
                Highcharts.chart(that.id, {
                    chart: {
                        zoomType: 'x',
                        type: 'timeline'
                    },
                    xAxis: {
                        type: 'datetime',
                        visible: false
                    },
                    yAxis: {
                        visible:false
                    },
                    legend: {
                        enabled: false
                    },
                    tooltip: {
                        style: {
                            width: 300
                        },
                    },
                    plotOptions: {
                        series: {
                            turboThreshold: 0 // Comment out this code to display error
                        }
                    },
                    series: [{
                        dataLabels: {
                            allowOverlap: false,
                            format: '<span style="color:{point.color}">● </span><span style="font-weight: bold;" > ' +
                                '{point.x:%H:%M}</span><br/>{point.label}'
                        },
                        marker: {
                            symbol: 'circle'
                        },
                        cropThreshold: 9e9,
                        data: data.data
                    }]
                });
            }
        });
    });

    function afterSetExtremes(e) {
        const { chart } = e.target;
        const sensorId = e.target.chart.renderTo.getAttribute('sensor-id');
        const startTime = Math.round(e.min);
        const endTime = Math.round(e.max);
        chart.showLoading("@lang('samples.loading-data-server')")
        Highcharts.getJSON('/ajax/samples/per-day?sensorId='+sensorId+'&userId={{$user->id}}&startTime='+startTime+'&endTime='+endTime, function (data) {
            chart.series[0].setData(data.data);
            chart.hideLoading();
        });

    }
</script>
