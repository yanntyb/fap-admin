<?php

namespace App\Models\Events\Classes;

use App\Models\Events\Interface\EventActionInterface;
use ArrayAccess;
use Exception;
use Illuminate\Support\Collection;
use ReturnTypeWillChange;

class EventActions implements ArrayAccess
{
    private array $actions = [];

    /**
     * @param Collection|array<int,EventActionInterface> $events
     * @throws Exception
     */
    public function __construct(Collection|array $events)
    {
        Collection::wrap($events)->each(
        /**
         * @throws Exception
         */
        fn(string $actionClass) => $this->offsetSet(count($this->actions),$actionClass));
    }

    #[ReturnTypeWillChange] public function offsetExists($offset): bool
    {
        return isset($this->actions[$offset]);
    }

    #[ReturnTypeWillChange] public function offsetUnset($offset)
    {
        unset($this->actions[$offset]);
    }

    #[ReturnTypeWillChange] public function offsetGet($offset)
    {
        return $this->actions[$offset] ?? null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @return void
     * @throws Exception
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!new $value instanceof AbstractEventAction) {
            throw new Exception('value must be an instance of EventAction');
        }

        if (is_null($offset)) {
            $this->actions[] = $value;
        } else {
            $this->actions[$offset] = $value;
        }
    }
}
