<?php

namespace App\Models\Events\Type;

use App\Http\Livewire\Event\UserMeeting\UserMeeting as Index;
use App\Models\Events\Classes\AbstractEventAction;

class UserMeeting extends AbstractEventAction
{

    /**
     * @return string
     */
    public function controllerActionClass(): string
    {
        return Index::class;
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
