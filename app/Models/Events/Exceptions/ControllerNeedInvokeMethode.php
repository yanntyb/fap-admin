<?php

namespace App\Models\Events\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;

class ControllerNeedInvokeMethode extends Exception
{
    /**
     * @param string $class
     */
    #[Pure] public function __construct(string $class)
    {
        parent::__construct($class . ' doit implementer la methode __invoke');
    }
}
