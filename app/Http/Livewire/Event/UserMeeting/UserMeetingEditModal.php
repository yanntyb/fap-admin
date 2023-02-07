<?php

namespace App\Http\Livewire\Event\UserMeeting;

use App\Models\Events\CalendarEvent;
use Illuminate\Support\Collection;
use Livewire\Component;

class UserMeetingEditModal extends Component
{
    public string $title;
    public bool $showModal;
    public Collection $eventData;

    protected $listeners = ['closeModal' => 'closeModal'];

    public function mount(CalendarEvent $event)
    {
        $class = $this->getRealEventClass($event->event);
        $this->eventData = $class::getEventActionRelatedData($event);
        $this->title = 'test';
        $this->showModal = true;
    }

    public function render()
    {
        dd($this->eventData);
        return view('livewire.event.userMeeting.edit-modal');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->emitUp('closeModal');
    }

    /**
     * @param string $eventClass
     * @return string
     */
    public function getRealEventClass(string $eventClass): string
    {
        if(\Str::contains($eventClass, 'App')){
            return $eventClass;
        }
        return 'App\\Models\\Events\\Type\\' . $eventClass;
    }
}
