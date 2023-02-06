<div class="container mx-auto">
    <div id='calendar-container' class="w-100 h-screen" wire:ignore>
        <div id='calendar' class="w-full h-100"></div>
    </div>
</div>
@push('js')
{{--    @vite('resources/js/calendar/calendar.ts')--}}
{{--    @dd($events)--}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendar = window.createCalendar('#calendar', {
                events: getEventsFromBackend(),
            });
            calendar.render();
        });

        function getEventsFromBackend()
        {
            let events = [];
            let title = '';
            let start = '';
            let end = '';
            let startTime = '';
            let endTime = '';
            @foreach($events as $event)
                events = [...events, {
                    id: '{{ $event['id'] }}',
                    title: '{{ $event['title'] }}',
                    start: '{{ $event['start'] }}',
                    end: '{{ $event['end'] }}',
                    allDay: false,
                }];
            @endforeach
            return events;
        }
    </script>
@endpush
