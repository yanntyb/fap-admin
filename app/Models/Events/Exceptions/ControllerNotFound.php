<?php

namespace App\Models\Events\Exceptions;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use JetBrains\PhpStorm\Pure;

class ControllerNotFound extends \Exception
{
    /**
     * @param string $class
     */
    #[Pure] public function __construct(string $class = "")
    {
        parent::__construct('La class ' . $class . ' n\'a pas été trouvée');
    }
}
