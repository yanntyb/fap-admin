<?php

namespace App\Http\Livewire\Event\UserMeeting;

use App\Models\Events\CalendarEvent;
use App\Models\Events\Interface\AbstractEventType;

class UserMeeting extends AbstractEventType
{

    public function __invoke(CalendarEvent $event)
    {
        return $this->getDefaultEventData($event);
    }

    public function color(): string
    {
        return '#edf1f7';
    }

    public function editModalClass(): string
    {
        return UserMeetingEditModal::class;
    }
}
