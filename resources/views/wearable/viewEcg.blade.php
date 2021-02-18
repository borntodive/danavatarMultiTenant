@php
    $breadcrumbs=[
        'Dashboard'=>route('dashboard'),
        'Wearable'=>route('wearable.calendar',[$user])
    ];
    $button2['label']='Live ECG';
    $button2['href']='#';
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
            <div class="highCharts h-96 w-full" id="chart_ecg" ></div>

        </x-card>
    </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/spin.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/ladda.js')}}"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/data.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/annotations.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"
        integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ=="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.32/moment-timezone-with-data-10-year-range.js"
        integrity="sha512-uXecwcw6BVqSCG1YCgnrnvGIijYyX2LlGOtA5sydZeQARKXs/IkHK0y9amhoOg0sgNFIVRNXWFaiMOLKKvdIxQ=="
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/@dmuy/timepicker@2.0.0/dist/mdtimepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"
        integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ=="
        crossorigin="anonymous"></script>
<script>
    var ecgChart;

    const timezone = 'Europe/Rome';
    const currentDate = moment("{{ $date }}");

    var noData=[];
    var searchTime = currentDate.format('YYYY-MM-DD HH:mm');
    Highcharts.getJSON('/ajax/samples/ecg/per-day?userId={{ $user->id }}&date=' + currentDate.format('x'), function(
        data) {
        // Create the chart
        Highcharts.setOptions({
            time: {
                timezone: timezone
            }
        });
        console.log(data);
        showLoadedTime(data.startDate);
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
            events: {
                afterSetExtremes: afterSetExtremes
            },
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
            selected: 1
        }
        ecgChart = Highcharts.stockChart('chart_ecg', {
            chart: {
                zoomType: 'x',
                chart: {
                    events: {
                        redraw: function(event) {
                            afterSetExtremes(event);
                        }
                    }
                },
            },
            xAxis: xAxis,
            yAxis: yAxis,
            navigator: {},
            legend: {
                enabled: true,
            },
            rangeSelector: rangeSelector,
            series: [{
                type: 'line',
                name: data.sensor.displayName,
                turboThreshold: 0,
                color: data.sensor.color,
                data: data.data.ECG_Raw,
            },
                /* {
                    type: 'line',
                    name: 'Moving Average Filter',
                    turboThreshold: 0,
                    color: 'black',
                    data: data.data.Moving_Average_Filter,
                } */
            ],
        });

    });
    mdtimepicker('#timepicker', {
        theme: 'dark',
        clearBtn: true,
        is24hour: true,
        events: {
            // Callback function on time selection
            timeChanged: function(data, timepicker) {
                loadNewData(data.value);
            },

        }
    });
    $( ".date-pagination" ).click(function(e) {
        loadNewData($(this).attr("data-date"));
    });
    function loadNewData(time) {
        searchTime = currentDate.format('YYYY-MM-DD') + ' ' + time;
        //const searchTime = utc.format('YYYY-MM-DD HH:mm');

        ecgChart.showLoading("@lang('samples.loading-data-server')")
        Highcharts.getJSON('/ajax/samples/ecg/per-day?sensorId=6&userId={{ $user->id }}&date=' + moment(searchTime)
            .format('x'),
            function(data) {
                showLoadedTime(data.startDate);

                ecgChart.annotations.length = 0;
                var cleanSerie = ecgChart.get('clean');
                if (cleanSerie)
                    cleanSerie.remove();
                ecgChart.series[0].setData(data.data.ECG_Raw);
                console.log(data.data);
                ecgChart.redraw()
                ecgChart.hideLoading();
            });
    }

    function showLoadedTime(startDate) {
        const loadedDate = moment(startDate + 'Z');
        if (loadedDate.format('YYYY-MM-DD HH:mm') != searchTime)
            $('#time_loaded_card').addClass('background-red');
        else
            $('#time_loaded_card').removeClass('background-red');
        $('#time_loaded').html(loadedDate.format('HH:mm'));

    }

    function afterSetExtremes(e) {
        //appMeasures.getMeasures(e);

    }

    $( "#calculate" ).click(function(e) {
        var laddaCalcBtn = Ladda.create(e.currentTarget);
        laddaCalcBtn.start();
        appMeasures.getMeasures(ecgChart,laddaCalcBtn );
        //laddaCalcBtn.stop();
    });

</script>
