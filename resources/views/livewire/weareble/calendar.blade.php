<div>
    <div class="flex flex-wrap justify-end gap-8">
        <div
            class="flex flex-col flex-wrap content-around justify-center float-right w-1/4 h-24 mb-5 bg-white rounded-md">
            <button type="button" wire:click="showYearView(true)"
                class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Anno
            </button>
            <button type="button"
                wire:click="showYearView(false)"
                class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Mese
            </button>
        </div>
        <div
            class="flex flex-col flex-wrap content-around justify-center float-right w-1/4 h-24 mb-5 bg-white rounded-md">
            <x-form.label class="block text-lg font-bold text-gray-700">Scegli un mese</x-form.label>
            <x-form.masked-date-input format="MM-YYYY" wire:model.debounce.800ms="targetDate" />

        </div>
    </div>
    @if ($viewYear)
    <x-card title="Eventi dell'Anno">
        <h2 class="w-full text-3xl font-bold text-center">{{$this->targetYear}}</h2>
        <div class="container grid gap-8 pt-6 mx-auto sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
            @for ($i=1; $i<13;$i++)
            <x-calendar.month-item :sensors="isset($yearEvents[$i]) ? $yearEvents[$i] : []" month="{{$i}}"/>
            @endfor
        </div>
    </x-card>
    @else
    <x-card title="Eventi del Mese">
        <div wire:ignore id="calendar" class="w-full"></div>
    </x-card>
    @endif






    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.css"><script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/locales-all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"
        integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ=="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
    var calendar;
    Livewire.on('showFullCalendar', (date,events) => {
        var newDate = moment(date),
            month = newDate.month() + 1,
            year = newDate.year();
        var calendarEl = document.getElementById('calendar');

        calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: '',
                center: 'title',
                right: ''
            },
            initialDate: date,
            views: {
                timeGridFourDay: {
                    type: 'timeGrid',
                    duration: {
                        years: 1
                    },
                    dayCount:30,
                    visibleRange: function(currentDate) {
                        return {
                            start: currentDate.clone().startOf('year'),
                            end: currentDate.clone().endOf("year")
                        };
                    },
                    buttonText: '4 day'
                }
            },
            locale: 'it',
            dateClick: function(info) {
                if (IsDateHasEvent(info.date)) {
                    var d = moment(info.date);
                    redirectToSamples(d);
                    //alert(d.format('MM-DD-YYYY'));
                }

            },
            eventClick: function(info) {
                var d = moment(info.event.start);
                redirectToSamples(d);
                //alert(d.format('MM-DD-YYYY'));
            },
            themeSystem: "bootstrap4",

        });
        calendar.render();
        })


        Livewire.on('gotoDate', (date) => {
            var t = moment(date);
            console.log(t);
            // const d =new Date(date);
            calendar.gotoDate(t.format('YYYY-MM-DD'));
        });
        Livewire.on('eventsUpdated', (events) => {
            calendar.removeAllEvents();
            var eventsObj = JSON.parse(events);
            eventsObj.forEach(function(event) {
                calendar.addEvent({
                    title: event.title,
                    start: event.start,
                    color: event.color,
                });
            });
            calendar.refetchEvents();
        })

        function IsDateHasEvent(date) {
            var allEvents = [];
            allEvents = calendar.getEvents();
            var event = $.grep(allEvents, function(v) {
                return +v.start === +date;
            });
            return event.length > 0;
        }

        function redirectToSamples(date) {
            //console.log(date);
            window.location.replace("/wearable/" + {{ $user->id }} + "/samples?date=" + date.format('YYYY-MM-DD'));
        }
    </script>
</div>
