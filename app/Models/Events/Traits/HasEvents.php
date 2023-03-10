<?php

namespace App\Models\Events\Traits;

use App\Models\Events\CalendarEvent;
use App\Models\Events\Classes\AbstractEventAction;
use App\Models\Events\Classes\EventActions;
use Exception;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

trait HasEvents
{
    /**
     * @return MorphMany
     */
    public function events(): MorphMany
    {
        return $this->morphMany(CalendarEvent::class,'eventable');
    }

    /**
     * @param Collection|array $events
     * @return EventActions
     * @throws Exception
     */
    private function makeEventActions(Collection|array $events): EventActions
    {
        return new EventActions($events);
    }

    /**
     * @throws Exception
     */
    public function invokeEventAction(string $eventClass, CalendarEvent $event): mixed
    {
        $eventClass = $this->getRealEventClass($eventClass);
        if(!$this->eventIsAssociatedToModel($eventClass)){
            return null;
        }
        $eventActionClass = $this->getEventAssociatedToModelRealArray()[0];
        /**
         * @var AbstractEventAction $eventActionInstance
         */
        $eventActionInstance = $eventActionClass::getInstance();
        return $eventActionInstance->invokeController(
            $event,
        );
    }

    /**
     * @throws Exception
     */
    protected function eventIsAssociatedToModel(string $eventClass): bool
    {
        return in_array($eventClass, $this->getEventAssociatedToModelRealArray());
    }

    /**
     * @throws Exception
     */
    protected function getEventAssociatedToModelRealArray()
    {
        $array = (array)$this->eventActions();
        return $array[array_keys($array)[0]];
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
