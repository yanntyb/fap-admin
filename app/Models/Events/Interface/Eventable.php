<?php

namespace App\Models\Events\Interface;

use App\Models\Events\CalendarEvent;
use App\Models\Events\Classes\EventActions;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Eventable
{
    /**
     * @return EventActions
     */
    public function eventActions(): EventActions;

    /**
     * @return MorphMany
     */
    public function events(): MorphMany;

    /**
     * @param string $eventClass
     * @param CalendarEvent $event
     * @return void
     */
    public function invokeEventAction(string $eventClass, CalendarEvent $event): void;

}
