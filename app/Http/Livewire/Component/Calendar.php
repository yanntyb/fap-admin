<?php

namespace App\Http\Livewire\Component;

use App\Models\CalendarEvent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
            ->map(static fn(CalendarEvent $event) => [
                'title' => $event->title,
                'start' => $event->start->format('Y-m-d'),
                'startTime' => $event->start->format('H:i:s'),
                'end' => $event->end->format('Y-m-d H:i:s'),
                'endTime' => $event->end->format('H:i:s'),
            ])
            ->toArray();
    }

    private function initDate()
    {
        $now = Carbon::now()->startOfWeek();
        $this->start = $now;
        $this->end = $now->clone()->endOfWeek();

    }
}
