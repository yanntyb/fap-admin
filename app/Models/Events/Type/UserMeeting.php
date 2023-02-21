<?php

namespace App\Models\Events\Type;

use App\Http\Livewire\Event\UserMeeting\UserMeeting as Index;
use App\Http\Livewire\Event\UserMeeting\UserMeetingCreationModal;
use App\Models\Events\Classes\AbstractEventAction;

class UserMeeting extends AbstractEventAction
{

    public string $title = 'Réunion Utilisateurs';

    /**
     * @return string
     */
    public function controllerActionClass(): string
    {
        return Index::class;
    }

    public function creationClass(): string
    {
        return UserMeetingCreationModal::class;
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
