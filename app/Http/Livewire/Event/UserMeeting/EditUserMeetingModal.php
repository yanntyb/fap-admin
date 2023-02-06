<?php

namespace App\Http\Livewire\Event\UserMeeting;

use App\Models\Events\CalendarEvent;

class EditUserMeetingModal
{
    public function __invoke(CalendarEvent $event, array $users_id, string $subject)
    {
        ds($event, $users_id, $subject);
    }
}
