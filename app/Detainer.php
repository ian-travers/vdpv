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
    protected $guarded = [];

    public $timestamps = false;

    public function wagons()
    {
        return $this->hasMany(Wagon::class);
    }

    public function isDeletable()
    {
        return !$this->wagons->count();
    }
}
