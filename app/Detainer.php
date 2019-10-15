<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Detainer
 *
 * @property int $id
 * @property string $name
 * @property string $idle_start_event
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Wagon[] $wagons
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Detainer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Detainer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Detainer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Detainer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Detainer whereIdleStartEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Detainer whereName($value)
 * @mixin \Eloquent
 */
class Detainer extends Model
{
    public const EVENT_ARRIVED_AT = 'arrived_at';
    public const EVENT_DETAINED_AT = 'detained_at';
    public const EVENT_RELEASED_AT = 'released_at';
    public const EVENT_DELIVERED_AT = 'delivered_at';
    public const EVENT_CARGO_OPERATION_FINISHED_AT = 'cargo_operation_finished_at';
    public const EVENT_REMOVED_AT = 'removed_at';
    public const EVENT_DEPARTED_AT = 'departed_at';

    protected $guarded = [];

    public $timestamps = false;

    public static function eventsList(): array
    {
        return [
            self::EVENT_ARRIVED_AT => 'Прибытие',
            self::EVENT_DETAINED_AT => 'Задержание',
            self::EVENT_RELEASED_AT => 'Выпуск (освобождение)',
            self::EVENT_DELIVERED_AT => 'Подача на грузовой фронт',
            self::EVENT_CARGO_OPERATION_FINISHED_AT => 'Окончание грузовой операции',
            self::EVENT_REMOVED_AT => 'Уборка с грузового фронта',
            self::EVENT_DEPARTED_AT => 'Отправление',
        ];
    }

    public function getIdleEvent()
    {
        return self::eventsList()[$this->idle_start_event];
    }

    public function wagons()
    {
        return $this->hasMany(Wagon::class);
    }

    public function isDeletable()
    {
        return !$this->wagons->count();
    }
}
