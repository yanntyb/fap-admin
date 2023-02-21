<?php

namespace App\Http\Livewire\Component;

use App\Models\Events\CalendarEvent;
use App\Models\Events\Classes\AbstractEventAction;
use App\Service\CalendarService;
use Carbon\Carbon;
use Livewire\Component;

class Calendar extends Component
{
    public string $start;
    public string $end;
    public bool $showEditModal = false;
    public string|null $modalClass = null;
    public int|null $modalEventId = null;

    public array $creationEventComponent = [];


    protected $listeners = ['show-calendar-edit-modal' => 'showEventEditModal', 'closeModal' => 'closeModal'];

    public function mount(): void
    {
        $this->initDate();
        $this->setAllEventableClass();

//        dd($this->creationEventComponent);
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

    /**
     * @param $modalClass
     * @param $eventId
     * @return void
     */
    public function showEventEditModal($modalClass, $eventId): void
    {
        $this->showEditModal = true;
        $this->modalClass = $modalClass;
        $this->modalEventId = $eventId;
    }

    /**
     * @return void
     */
    public function closeModal(): void
    {
        $this->showEditModal = false;
        $this->modalClass = null;
    }

    /**
     * @return void
     */
    public function setAllEventableClass(): void
    {
        $events = CalendarService::getEventableClasses();
        $this->creationEventComponent = $events
            ->map(fn(AbstractEventAction $event) => [$event->title => $event->creationClass()])
            ->toArray()[0]
        ;
    }

    /**
     * @param AbstractEventAction $class
     * @return string
     */
    public function getCreationModalClass(AbstractEventAction $class): string
    {
        return $class->creationClass();
    }
}
