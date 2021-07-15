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
        <x-layout.header :title="__('Dati del Wearable di').' '.$user->name" :breadcrumbs="$breadcrumbs"/>
    </x-slot>
    <x-medical-record.header
        :user="$user"
        :button2="$button2"
    />
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="mt-5">
        <h2 class="text-xs font-medium tracking-wide text-gray-500 uppercase">Pinned Projects</h2>
        <ul class="grid grid-cols-1 gap-5 mt-3 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <li class="flex col-span-1 rounded-md shadow-sm">
                <div
                    class="flex items-center justify-center flex-shrink-0 w-16 text-sm font-medium text-white bg-pink-600 rounded-l-md">
                    GA
                </div>
                <div
                    class="flex items-center justify-between flex-1 truncate bg-white border-t border-b border-r border-gray-200 rounded-r-md">
                    <div class="flex-1 px-4 py-2 text-sm">
                        <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Scegli orario</a>
                        <x-form.text-input id="timepicker"/>
                    </div>
                    <div class="flex-shrink-0 pr-2">
                        <button
                            class="inline-flex items-center justify-center w-8 h-8 text-gray-400 bg-transparent bg-white rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Open options</span>
                            <!-- Heroicon name: solid/dots-vertical -->
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 fill="currentColor" aria-hidden="true">
                                <path
                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </li>

            <li class="flex col-span-1 rounded-md shadow-sm">
                <div
                    class="flex items-center justify-center flex-shrink-0 w-16 text-sm font-medium text-white bg-purple-600 rounded-l-md">
                    CD
                </div>
                <div
                    class="flex items-center justify-between flex-1 truncate bg-white border-t border-b border-r border-gray-200 rounded-r-md">
                    <div class="flex-1 px-4 py-2 text-sm truncate">
                        <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Orario Caricato</a>
                        <p class="text-gray-500" id="time_loaded"></p>
                    </div>
                    <div class="flex-shrink-0 pr-2">
                        <button
                            class="inline-flex items-center justify-center w-8 h-8 text-gray-400 bg-transparent bg-white rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Open options</span>
                            <!-- Heroicon name: solid/dots-vertical -->
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 fill="currentColor" aria-hidden="true">
                                <path
                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </li>

            <li class="flex col-span-1 rounded-md shadow-sm">
                <div
                    class="flex items-center justify-center flex-shrink-0 w-16 text-sm font-medium text-white bg-yellow-500 rounded-l-md">
                    T
                </div>
                <div
                    class="flex items-center justify-between flex-1 truncate bg-white border-t border-b border-r border-gray-200 rounded-r-md">
                    <div class="flex-1 px-4 py-2 text-sm truncate">
                        <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Primo Dato</a>
                        <p class="text-gray-500">{{isset($availablesDate['first']) ? $availablesDate['first']->timezone('Europe/Rome')->toDateTimeString() : ""}}</p>
                    </div>
                    <div class="flex-shrink-0 pr-2">
                        <button
                            class="inline-flex items-center justify-center w-8 h-8 text-gray-400 bg-transparent bg-white rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Open options</span>
                            <!-- Heroicon name: solid/dots-vertical -->
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 fill="currentColor" aria-hidden="true">
                                <path
                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </li>

            <li class="flex col-span-1 rounded-md shadow-sm">
                <div
                    class="flex items-center justify-center flex-shrink-0 w-16 text-sm font-medium text-white bg-green-500 rounded-l-md">
                    RC
                </div>
                <div
                    class="flex items-center justify-between flex-1 truncate bg-white border-t border-b border-r border-gray-200 rounded-r-md">
                    <div class="flex-1 px-4 py-2 text-sm truncate">
                        <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Ultimo Dato</a>
                        <p class="text-gray-500">{{isset($availablesDate['last']) ? $availablesDate['last']->timezone('Europe/Rome')->toDateTimeString() : ""}}</p>
                    </div>
                    <div class="flex-shrink-0 pr-2">
                        <button
                            class="inline-flex items-center justify-center w-8 h-8 text-gray-400 bg-transparent bg-white rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Open options</span>
                            <!-- Heroicon name: solid/dots-vertical -->
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 fill="currentColor" aria-hidden="true">
                                <path
                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="mt-10 -mb-5 text-center">
        <nav class="relative z-0 inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
            @foreach ($pagination as $idx=>$p)
                <span
                   data-date="{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $p->x)->timezone('Europe/Rome')->format('H:i')}}"
                   class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 date-pagination hover:bg-gray-50">
                    {{$idx+1}}
                </span>

            @endforeach

        </nav>
    </div>

    <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-card title="ECG" class="mb-5 h-px-600">
            <div class="w-full highCharts h-96" id="chart_ecg"></div>
        </x-card>
    </div>
    <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-card title="Misurazioni" class="mb-5 h-px-600">
            <div class="flex flex-row-reverse w-full mb-6 -mt-6">
                <button wire:click="editModal" id="calculate" type="button" data-style="expand-right"
                        class="inline-flex justify-center float-right px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm ladda-button basic-ladda-button hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="ladda-label">  Calcola</span></button>
            </div>
            <div id="measures" class="w-full">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="md:grid md:grid-cols-12 md:gap-3">
                    <div class="overflow-hidden bg-white md:col-span-8 sm:rounded-lg sm:shadow">

                        <div class="px-4 py-5 bg-gray-200 border-b border-gray-200 sm:px-6">
                            <div class="flex flex-wrap items-center justify-between -mt-2 -ml-4 sm:flex-nowrap">
                                <div class="mt-2 ml-4">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        Misure
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                                    #
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                                    RR
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                                    QT
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- Odd row -->
                                            <tr class="bg-white" v-for="(measure, index) in measures"
                                                :key="`measure-${index}`">
                                                <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                                                    @{{index + 1}}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
                                                    @{{measure.rr}}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
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
                    <div class="overflow-hidden bg-white md:col-span-4 sm:rounded-lg sm:shadow">

                        <div class="px-4 py-5 bg-gray-200 border-b border-gray-200 sm:px-6">
                            <div class="flex flex-wrap items-center justify-between -mt-2 -ml-4 sm:flex-nowrap">
                                <div class="mt-2 ml-4">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        Media
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                                    RR
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                                    QT
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- Odd row -->
                                            <tr class="bg-white" v-if="average">
                                                <td class="px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
                                                    @{{average.rr}}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
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
    <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <livewire:weareble.comments :date="$date" :user="$user" sensor="6"/>
    </div>
</x-app-layout>


<link rel="stylesheet" href="https://unpkg.com/@dmuy/timepicker@2.0.0/dist/mdtimepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda-themeless.min.css"
      integrity="sha512-EOY99TUZ7AClCNvbnvrhtMXDuWzxUBXV7SFovruHvYf2dbvRB5ya+jgDPk5bOyTtZDbqFH3PTuTWl/D7+7MGsA=="
      crossorigin="anonymous"/>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/spin.min.js"
        integrity="sha512-FzwLmClLNd77zi/Ke+dYlawHiPBAWhk8FzA4pwFV2a6PIR7/VHDLZ0yKm/ekC38HzTc5lo8L8NM98zWNtCDdyg=="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda.min.js"
        integrity="sha512-fK8kfclYYyRUN1KzdZLVJrAc+LmdsZYH+0Fp3TP4MPJzcLUk3FbQpfWSbL/uxh7cmqbuogJ75pMmL62SiNwWeg=="
        crossorigin="anonymous"></script>
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
            average: [],
        },
        methods: {
            calculateMeasures(chart) {
                alert(chart.xAxis[0].min)
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
                        this.measures = response.data.measures;
                        this.average = response.data.averages;

                        chart.annotations.forEach(annotation => annotation.destroy());
                        var pl = [];
                        $.each(chart.yAxis[0].plotLinesAndBands, function (i, v) {
                            pl.push(v.id);
                        });
                        $.each(pl, function (i, v) {
                            chart.yAxis[0].removePlotLine(v);
                        });
                        chart.annotations.length = 0;
                        var cleanSerie = chart.get('clean');
                        if (cleanSerie)
                            cleanSerie.remove();
                        var newAnnotations = {
                            labels: []
                        };
                        var length = response.data.rs.length;
                        for (let i = 0; i < length; i++) {
                            const ii = i + 1;
                            newAnnotations.labels.push({
                                point: {
                                    x: moment(response.data.rs[i].time),
                                    y: response.data.rs[i].value,
                                    yAxis: 0,
                                    xAxis: 0
                                },
                                text: 'R' + ii,
                                id: 'R' + ii,
                            });
                            if (i in response.data.qs) {
                                newAnnotations.labels.push({
                                    point: {
                                        x: moment(response.data.qs[i].time),
                                        y: response.data.qs[i].value,
                                        yAxis: 0,
                                        xAxis: 0
                                    },
                                    text: 'Q' + ii,
                                    id: 'Q' + ii,
                                });
                            }
                            if (i in response.data.ss) {
                                newAnnotations.labels.push({
                                    point: {
                                        x: moment(response.data.ss[i].time),
                                        y: response.data.ss[i].value,
                                        yAxis: 0,
                                        xAxis: 0
                                    },
                                    text: 'S' + ii,
                                    id: 'S' + ii,
                                });
                            }
                            if (i in response.data.ts) {
                                newAnnotations.labels.push({
                                    point: {
                                        x: moment(response.data.ts[i].time),
                                        y: response.data.ts[i].value,
                                        yAxis: 0,
                                        xAxis: 0
                                    },
                                    text: 'T' + ii,
                                    id: 'T' + ii,
                                });
                            }
                            if (i in response.data.ps) {
                                newAnnotations.labels.push({
                                    point: {
                                        x: moment(response.data.ps[i].time),
                                        y: response.data.ps[i].value,
                                        yAxis: 0,
                                        xAxis: 0
                                    },
                                    text: 'P' + ii,
                                    id: 'P' + ii,
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

            cleanMesuares() {
                console.log("cleanig")
            }

        },
        mounted: function () {
            //
        }
    });

</script>
<script>

    appMeasures.$emit("cleanMesuares");
    const timezone = 'Europe/Rome';
    moment.tz.setDefault(timezone);
    const currentDate = moment("{{ $date }}");

    var noData = [];
    var searchTime = currentDate.format('YYYY-MM-DD HH:mm');
    Highcharts.getJSON('/ajax/samples/ecg/per-day?userId={{ $user->id }}&date=' + currentDate.format('x'), function (
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
                type: 'second',
                count: 30,
                text: "@lang('samples.30s')",
            },
            {
                type: 'secopnd',
                count: 60,
                text: "@lang('samples.60s')",
            },

            {
                type: 'all',
                text: "@lang('samples.all')",
            }
            ],
            selected: 1
        }
        ecgChart = Highcharts.stockChart('chart_ecg', {
            chart: {
                zoomType: 'x',
                chart: {
                    events: {
                        redraw: function (event) {
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
            timeChanged: function (data, timepicker) {
                loadNewData(data.value);
            },

        }
    });
    $(".date-pagination").click(function (e) {
        loadNewData($(this).attr("data-date"));
    });

    function loadNewData(time) {
        searchTime = currentDate.format('YYYY-MM-DD') + ' ' + time;
        //const searchTime = utc.format('YYYY-MM-DD HH:mm');

        ecgChart.showLoading("@lang('samples.loading-data-server')")
        Highcharts.getJSON('/ajax/samples/ecg/per-day?sensorId=6&userId={{ $user->id }}&date=' + moment(searchTime)
            .format('x'),
            function (data) {
                showLoadedTime(data.startDate);

                ecgChart.annotations.length = 0;
                var cleanSerie = ecgChart.get('clean');
                if (cleanSerie)
                    cleanSerie.remove();
                ecgChart.series[0].setData(data.data.ECG_Raw);
                console.log(data.data.ECG_Raw);
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

    $("#calculate").click(function (e) {
        var laddaCalcBtn = Ladda.create(e.currentTarget);
        laddaCalcBtn.start();
        appMeasures.getMeasures(ecgChart, laddaCalcBtn);
        //laddaCalcBtn.stop();
    });
    $(".gotosvg").click(function () {
        loadNewData($(this).attr('data-time'));
    });

</script>
