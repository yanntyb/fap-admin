<?php

namespace App\Models\Events\Interface;

use App\Models\Events\CalendarEvent;
use Illuminate\Support\Js;
use JetBrains\PhpStorm\ArrayShape;
use Str;

abstract class AbstractEventType
{
    public CalendarEvent $event;

    /**
     * background color de l'event en hex
     * @return string
     */
    abstract public function color(): string;

    abstract public function editModalClass(): string;

    /**
     * @param CalendarEvent $event
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'title' => "string", 'start' => "\Carbon\Carbon", 'end' => "\Carbon\Carbon"])]
    public function getDefaultEventData(CalendarEvent $event): array
    {
        return [
            'id' => $event->id,
            'title' => $event->title,
            'start' => $event->start,
            'end' => $event->end,
            'color' => $this->color(),
            'editModalClass' => Str::replace('\\','\\\\',$this->editModalClass()),
        ];
    }
}
