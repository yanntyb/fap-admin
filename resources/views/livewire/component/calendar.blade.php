<div>
    <div id="creationList">
        @foreach($creationEventComponent as $title => $eventClass)
            <<div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                <div class='fc-event-main'>
                    {{ $title }}
                </div>
            </div>
        @endforeach
    </div>
    <div class="container mx-auto">
        <div id='calendar-container' class="w-100 h-screen" wire:ignore>
            <div id='calendar' class="w-full h-100"></div>
        </div>
    </div>
    @if($showEditModal)
        <livewire:dynamic-component :component="$modalClass" :event="$modalEventId" class="mt-4" :show="false" />
    @endif
</div>


@push('js')
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
            @foreach($events as $event)
                events = [...events, window.getCalendarEventData({
                    id: '{{ $event['id'] }}',
                    title: '{{ $event['title'] }}',
                    start: '{{ $event['start'] }}',
                    end: '{{ $event['end'] }}',
                    allDay: false,
                    backgroundColor : '{{ $event['color'] }}',
                    url: '{{ $event['editModalClass'] }}',
                })];
            @endforeach
            return events;
        }
    </script>
@endpush
