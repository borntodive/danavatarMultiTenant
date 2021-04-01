<div>
    <div class="flex flex-wrap justify-end">
        <div class="w-1/4 h-24 bg-white rounded-md flex flex-col flex-wrap content-around justify-center float-right mb-5">
           <x-form.label class="block text-lg font-bold text-gray-700">Scegli un mese</x-form.label>
            <x-form.masked-date-input format="MM-YYYY" wire:model.debounce.800ms="targetDate"/>

        </div>
    </div>

    <x-card title="Eventi del Mese">
        <div wire:ignore id="calendar" class="w-full"></div>
    </x-card>





<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/locales-all.min.js">

</script><script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script>
<script type="text/javascript">

    var newDate = moment(),
        month = newDate.month()+1,
        year = newDate.year();
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: '',
            center: 'title',
            right: ''
        },
        locale:'it',
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
        datesRender: function (test) {
          console.log(test);
        },
        themeSystem: "bootstrap4",
        eventLimit: true,

        events: {!! $events !!}
    });
    calendar.render();

    Livewire.on('gotoDate', (date) => {
        var t = moment(date);
        console.log(t);
        // const d =new Date(date);
        calendar.gotoDate(t.format('YYYY-MM-DD'));
    });
    Livewire.on('eventsUpdated', (events) => {
        calendar.removeAllEvents();
        var eventsObj = JSON.parse(events);
        eventsObj.forEach(function (event) {
            calendar.addEvent({
                title: event.title,
                start: event.start,
                color:event.color,
            });
        });
        calendar.refetchEvents();
    })

    function IsDateHasEvent(date) {
        var allEvents = [];
        allEvents = calendar.getEvents();
        var event = $.grep(allEvents, function (v) {
            return +v.start === +date;
        });
        return event.length > 0;
    }

    function redirectToSamples (date){
        window.location.replace("/wearable/"+ {{$user->id}}+"/samples?date="+date.format('YYYY-MM-DD'));
    }
</script>
</div>
