<?php

namespace App\Http\Livewire\Component;

use App\Models\CalendarEvent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Calendar extends Component
{
    public string $start;
    public string $end;

    public function mount(): void
    {
        $this->initDate();
    }

    public function render()
    {
        return view('livewire.component.calendar', [
            'events' => $this->getEvents(),
        ]);
    }

    private function getEvents(): array
    {
        return CalendarEvent::query()
            ->whereDate('start', '>=', $this->start)
            ->whereDate('end', '<=', $this->end)
            ->get()
            ->map(fn(CalendarEvent $event) => $this->getEventableData($event))
            ->toArray();
    }

    private function initDate()
    {
        $now = Carbon::now()->startOfWeek();
        $this->start = $now;
        $this->end = $now->clone()->endOfWeek();
    }

    private function getEventableData(CalendarEvent $event)
    {
        dd($event->eventable->getCalendarData());
        return [
            'id' => $event->id,
            'title' => $event->title,
            'start' => $event->start->toDateTimeLocalString(),
            'end' => $event->end->toDateTimeLocalString(),
        ];
    }
}
