<?php
declare(strict_types=1);

namespace App\Models\Events;

use App\Models\Events\Interface\Eventable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;

/**
 * @property string $title
 * @property Collection $datas
 * @property Carbon $start
 * @property Carbon $end
 * @property Eventable $eventable
 */
class CalendarEvent extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'datas' => AsCollection::class
    ];

    /**
     * @return MorphTo
     */
    public function eventable(): MorphTo
    {
        return $this->morphTo();
    }
}
