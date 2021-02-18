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

    <div class="mt-5">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Ultimi Dati
        </h3>
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($latests as $latest)
            <div class="flex flex-col bg-white overflow-hidden shadow rounded-lg">
                <div class="flex-grow px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                            <!-- Heroicon name: outline/users -->
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                {{$latest['sensor']->displayName}}
                            </dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900">
                                    {{$latest['latest']}}
                                </div>

                                <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                    <svg class="self-center flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </dd>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                    <div class="text-sm">
                        <p class="font-medium">Media <span class="font-bold">{{$latest['average']}}</span></p>
                    </div>
                </div>
            </div>
            @endforeach
        </dl>
    </div>

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
