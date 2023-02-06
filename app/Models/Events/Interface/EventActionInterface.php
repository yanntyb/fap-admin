<?php

namespace App\Models\Events\Interface;

interface EventActionInterface
{
    /**
     * @return string
     */
    public function controllerActionClass(): string;

    /**
     * @return array
     */
    public function eventDataKeysToInvokeController(): array;

}
