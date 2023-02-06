<?php

namespace App\Models\Events\Type;

use App\Http\Livewire\Event\UserMeeting\EditUserMeetingModal;
use App\Models\Events\Classes\AbstractEventAction;

class UserMeeting extends AbstractEventAction
{

    /**
     * @return string
     */
    public function controllerActionClass(): string
    {
        return EditUserMeetingModal::class;
    }

    /**
     * @return array
     */
    public function eventDataKeysToInvokeController(): array
    {
        return [
            'users_id',
            'subject',
        ];
    }
}
