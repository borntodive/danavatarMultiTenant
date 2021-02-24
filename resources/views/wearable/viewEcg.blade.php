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
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="mt-5">
        <h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">Pinned Projects</h2>
        <ul class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <li class="col-span-1 flex shadow-sm rounded-md">
                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-pink-600 text-white text-sm font-medium rounded-l-md">
                    GA
                </div>
                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                    <div class="flex-1 px-4 py-2 text-sm">
                        <a href="#" class="text-gray-900 font-medium hover:text-gray-600">Scegli orario</a>
                        <x-form.text-input id="timepicker"/>
                    </div>
                    <div class="flex-shrink-0 pr-2">
                        <button class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full bg-transparent hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Open options</span>
                            <!-- Heroicon name: solid/dots-vertical -->
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </li>

            <li class="col-span-1 flex shadow-sm rounded-md">
                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-purple-600 text-white text-sm font-medium rounded-l-md">
                    CD
                </div>
                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                    <div class="flex-1 px-4 py-2 text-sm truncate">
                        <a href="#" class="text-gray-900 font-medium hover:text-gray-600">Orario Caricato</a>
                        <p class="text-gray-500" id="time_loaded"></p>
                    </div>
                    <div class="flex-shrink-0 pr-2">
                        <button class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full bg-transparent hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Open options</span>
                            <!-- Heroicon name: solid/dots-vertical -->
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </li>

            <li class="col-span-1 flex shadow-sm rounded-md">
                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-yellow-500 text-white text-sm font-medium rounded-l-md">
                    T
                </div>
                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                    <div class="flex-1 px-4 py-2 text-sm truncate">
                        <a href="#" class="text-gray-900 font-medium hover:text-gray-600">Primo Dato</a>
                        <p class="text-gray-500">{{isset($availablesDate['first']->time) ? $availablesDate['first']->time->timezone('Europe/Rome')->toDateTimeString() : ""}}</p>
                    </div>
                    <div class="flex-shrink-0 pr-2">
                        <button class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full bg-transparent hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Open options</span>
                            <!-- Heroicon name: solid/dots-vertical -->
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </li>

            <li class="col-span-1 flex shadow-sm rounded-md">
                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-green-500 text-white text-sm font-medium rounded-l-md">
                    RC
                </div>
                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                    <div class="flex-1 px-4 py-2 text-sm truncate">
                        <a href="#" class="text-gray-900 font-medium hover:text-gray-600">Ultimo Dato</a>
                        <p class="text-gray-500">{{isset($availablesDate['last']->time) ? $availablesDate['last']->time->timezone('Europe/Rome')->toDateTimeString() : ""}}</p>
                    </div>
                    <div class="flex-shrink-0 pr-2">
                        <button class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full bg-transparent hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Open options</span>
                            <!-- Heroicon name: solid/dots-vertical -->
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-card title="ECG" class="mb-5 h-px-600">
            <div class="highCharts h-96 w-full" id="chart_ecg" ></div>
        </x-card>
    </div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-card title="Misurazioni" class="mb-5 h-px-600">
            <div class="w-full flex flex-row-reverse -mt-6 mb-6">
                <button wire:click="editModal" id="calculate" type="button" data-style="expand-right" class="ladda-button basic-ladda-button float-right	 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="ladda-label">  Calcola</span></button>
            </div>
            <div id="measures" class="w-full">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="md:grid md:grid-cols-12 md:gap-3">
                    <div class="md:col-span-8 bg-white overflow-hidden sm:rounded-lg sm:shadow">

                        <div class="bg-gray-200 px-4 py-5 border-b border-gray-200 sm:px-6">
                            <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
                                <div class="ml-4 mt-2">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Misure
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    #
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    RR
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    QT
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- Odd row -->
                                            <tr class="bg-white" v-for="(measure, index) in measures" :key="`measure-${index}`">
                                                <td class="text-center px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    @{{index + 1}}
                                                </td>
                                                <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    @{{measure.rr}}
                                                </td>
                                                <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    @{{measure.qt}}
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-4 bg-white overflow-hidden sm:rounded-lg sm:shadow">

                        <div class="bg-gray-200 px-4 py-5 border-b border-gray-200 sm:px-6">
                            <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
                                <div class="ml-4 mt-2">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Media
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    RR
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    QT
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- Odd row -->
                                            <tr class="bg-white"  v-if="average">
                                                <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    @{{average.rr}}
                                                </td>
                                                <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    @{{average.qt}}
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </x-card>
    </div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <livewire:weareble.comments :date="$date" :user="$user" sensor="6"/>
    </div>
</x-app-layout>


<link rel="stylesheet" href="https://unpkg.com/@dmuy/timepicker@2.0.0/dist/mdtimepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda-themeless.min.css" integrity="sha512-EOY99TUZ7AClCNvbnvrhtMXDuWzxUBXV7SFovruHvYf2dbvRB5ya+jgDPk5bOyTtZDbqFH3PTuTWl/D7+7MGsA==" crossorigin="anonymous" /><script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/spin.min.js" integrity="sha512-FzwLmClLNd77zi/Ke+dYlawHiPBAWhk8FzA4pwFV2a6PIR7/VHDLZ0yKm/ekC38HzTc5lo8L8NM98zWNtCDdyg==" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda.min.js" integrity="sha512-fK8kfclYYyRUN1KzdZLVJrAc+LmdsZYH+0Fp3TP4MPJzcLUk3FbQpfWSbL/uxh7cmqbuogJ75pMmL62SiNwWeg==" crossorigin="anonymous"></script><script src="https://code.highcharts.com/stock/highstock.js"></script>
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
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"
        integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ=="
        crossorigin="anonymous"></script>
<script>
    var ecgChart;

    var appMeasures = new Vue({
        el: '#measures',
        data: {
            measures: [],
            average:[],
        },
        methods: {
            calculateMeasures (chart) {
                alert (chart.xAxis[0].min)
            },
            getMeasures(chart, calcBtn) {

                const startTime = chart.xAxis[0].min;
                const endTime = chart.xAxis[0].max;
                axios
                    .get("/ajax/samples/ecg/measures", {
                        params: {
                            userId: "{{ $user->id }}",
                            sensorId: 6,
                            startTime: startTime,
                            endTime: endTime,
                        }
                    })
                    .then(response => {
                        this.measures=response.data.measures;
                        this.average=response.data.averages;

                        chart.annotations.forEach(annotation => annotation.destroy());
                        var pl = [];
                        $.each( chart.yAxis[0].plotLinesAndBands , function( i, v ) { pl.push(v.id); } );
                        $.each( pl , function( i, v ) { chart.yAxis[0].removePlotLine( v ); });
                        chart.annotations.length = 0;
                        var cleanSerie = chart.get('clean');
                        if (cleanSerie)
                            cleanSerie.remove();
                        var newAnnotations = {
                            labels: []
                        };
                        var length = response.data.rs.length;
                        for (let i = 0; i < length; i++) {
                            const ii=i+1;
                            newAnnotations.labels.push({
                                point: {
                                    x: moment(response.data.rs[i].time),
                                    y: response.data.rs[i].value ,
                                    yAxis: 0,
                                    xAxis: 0
                                },
                                text: 'R'+ ii,
                                id: 'R'+ ii,
                            });
                            if (i in response.data.qs) {
                                newAnnotations.labels.push({
                                    point: {
                                        x: moment(response.data.qs[i].time),
                                        y: response.data.qs[i].value ,
                                        yAxis: 0,
                                        xAxis: 0
                                    },
                                    text: 'Q'+ ii,
                                    id: 'Q'+ ii,
                                });
                            }
                            if (i in response.data.ss) {
                                newAnnotations.labels.push({
                                    point: {
                                        x: moment(response.data.ss[i].time),
                                        y: response.data.ss[i].value ,
                                        yAxis: 0,
                                        xAxis: 0
                                    },
                                    text: 'S'+ ii,
                                    id: 'S'+ ii,
                                });
                            }
                            if (i in response.data.ts) {
                                newAnnotations.labels.push({
                                    point: {
                                        x: moment(response.data.ts[i].time),
                                        y: response.data.ts[i].value ,
                                        yAxis: 0,
                                        xAxis: 0
                                    },
                                    text: 'T'+ ii,
                                    id: 'T'+ ii,
                                });
                            }
                            if (i in response.data.ps) {
                                newAnnotations.labels.push({
                                    point: {
                                        x: moment(response.data.ps[i].time),
                                        y: response.data.ps[i].value ,
                                        yAxis: 0,
                                        xAxis: 0
                                    },
                                    text: 'P'+ ii,
                                    id: 'P'+ ii,
                                });
                            }
                        }
                        chart.addAnnotation(newAnnotations);
                        for (var name in response.data.debug) {
                            chart.yAxis[0].addPlotLine({
                                value: response.data.debug[name],
                                color: 'black',
                                width: 2,
                                id: name
                            });
                        }


                        /* chart.addSeries({
                            name: 'Clean',
                            data: response.data.clean,
                            turboThreshold: 0,
                            id: 'clean'
                        }, false); */
                        calcBtn.stop();
                    })
            },

        },
        mounted: function() {
            //
        }
    });

</script>
<script>

    const timezone = 'Europe/Rome';
    moment.tz.setDefault(timezone);
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
                ecgChart.redraw()
                ecgChart.hideLoading();
            });
    }
    function showLoadedTime(startDate) {
        const loadedDate = moment(startDate);
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
    $(".gotosvg").click(function(){
        loadNewData($(this).attr('data-time'));
    });

</script>
