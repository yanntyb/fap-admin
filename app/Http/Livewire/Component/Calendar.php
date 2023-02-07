<?php

namespace App\Http\Livewire\Component;

use App\Models\Events\CalendarEvent;
use Carbon\Carbon;
use Livewire\Component;

class Calendar extends Component
{
    public string $start;
    public string $end;
    public bool $showEditModal = false;
    public string|null $modalClass = null;
    public int|null $modalEventId = null;

    protected $listeners = ['show-calendar-edit-modal' => 'showEventEditModal', 'closeModal' => 'closeModal'];

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
        return $event->eventable->invokeEventAction($event->event, $event);
    }

    public function showEventEditModal($modalClass, $eventId)
    {
        $this->showEditModal = true;
        $this->modalClass = $modalClass;
        $this->modalEventId = $eventId;
    }

    public function closeModal()
    {
        $this->showEditModal = false;
        $this->modalClass = null;
    }
}
