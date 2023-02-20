<?php

namespace App\Service;

use File;
use Illuminate\Support\Collection;

class CalendarService
{
    public static function getEventableClassInstance(): Collection
    {
        $eventsFiles = Collection::wrap(File::files( storage_path('eventType')));
        return $eventsFiles->map(static function(\SplFileInfo $fileInfo){
            $className = 'App\\Models\\Events\\Type\\' . explode('.php',$fileInfo->getFilename())[0];
            return new $className;
        });
    }
}
