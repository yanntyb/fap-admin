<div>
    <div id='calendar-container' wire:ignore>
        <div id='calendar'></div>
    </div>
</div>
@push('js')
{{--    @vite('resources/js/calendar/calendar.ts')--}}
    <script>
        document.addEventListener('livewire:load', function () {
            const calendar = window.createCalendar('#calendar', {
                events: {{ \Illuminate\Support\JS::from($events) }}
            });
            calendar.render();
        });
    </script>
@endpush
