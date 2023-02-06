<?php

namespace App\Models\Events\Classes;

use App\Models\Events\CalendarEvent;
use App\Models\Events\Exceptions\ControllerNeedInvokeMethode;
use App\Models\Events\Interface\EventActionInterface;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;

abstract class AbstractEventAction implements EventActionInterface
{
    /**
     * @return string
     */
    abstract public function controllerActionClass(): string;

    /**
     * @return array
     */
    abstract public function eventDataKeysToInvokeController(): array;

    /**
     * @throws ControllerNeedInvokeMethode
     */
    public function invokeController(CalendarEvent $event)
    {
        if(!class_exists($this->controllerActionClass())){
            throw new ControllerNeedInvokeMethode($this->controllerActionClass());
        }
        if(!method_exists($this->controllerActionClass(),'__invoke')){
            throw new ControllerNeedInvokeMethode($this->controllerActionClass());
        }
        $class = $this->controllerActionClass();
        $instance = new $class;
        $instance($event,...$this->getEventActionRelatedData($event));
    }

    /**
     * @return static
     */
    #[Pure] public static function getInstance(): static
    {
        return new static;
    }

    /**
     * @param CalendarEvent $event
     * @return array
     */
    protected function getEventActionRelatedData(CalendarEvent $event): array
    {
        $datas = [];
        Collection::wrap($this->eventDataKeysToInvokeController())->each(function($key) use (&$datas, $event){
            $datas[$key] = $event->datas[$key] ?? null;
        });
        return $datas;
    }


}
