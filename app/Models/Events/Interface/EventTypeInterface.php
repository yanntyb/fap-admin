<?php

namespace App\Models\Events\Interface;

interface EventTypeInterface
{
    /**
     * Event color dans le calendrier
     * @return string
     */
    public function color(): string;
}
