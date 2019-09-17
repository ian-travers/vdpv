<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;


/**
 * App\Wagon
 *
 * @property int $id
 * @property int $creator_id
 * @property string $inw
 * @property int $returning
 * @property \Illuminate\Support\Carbon|null $arrived_at
 * @property \Illuminate\Support\Carbon|null $detained_at
 * @property \Illuminate\Support\Carbon|null $released_at
 * @property \Illuminate\Support\Carbon|null $departed_at
 * @property \Illuminate\Support\Carbon|null $cargo_operation_finished_at
 * @property \Illuminate\Support\Carbon|null $delivered_at
 * @property \Illuminate\Support\Carbon|null $removed_at
 * @property int $detainer_id
 * @property string|null $reason
 * @property string|null $cargo
 * @property string|null $forwarder
 * @property string|null $ownership
 * @property string|null $departure_station
 * @property string|null $destination_station
 * @property string|null $taken_measure
 * @property string|null $operation
 * @property string|null $park
 * @property string|null $way
 * @property string|null $nplf
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $creator
 * @property-read \App\Detainer $detainer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon filter($filter)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon longDetainedFirst()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon longDetainedOnly(\App\Detainer $detainer = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon sortable($defaultParameters = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereArrivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereCargo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereCargoOperationFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereDeliveredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereDepartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereDepartureStation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereDestinationStation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereDetainedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereDetainerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereForwarder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereInw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereNplf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereOperation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereOwnership($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon wherePark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereReleasedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereRemovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereReturning($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereTakenMeasure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereWay($value)
 * @mixin \Eloquent
 */
class Wagon extends Model
{
    use Sortable;

    protected $guarded = [];

    protected $dates = ['arrived_at', 'detained_at', 'released_at', 'departed_at', 'delivered_at', 'removed_at', 'cargo_operation_finished_at'];

    public function path()
    {
        return "/wagons/{$this->id}";
    }

    public function viewPath()
    {
        return "/view/{$this->id}";
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function detainer()
    {
        return $this->belongsTo(Detainer::class);
    }

    public function isLocal(): bool
    {
        return $this->detainer_id == 7;
    }

    public function isReadyToDepart(Carbon $at = null): bool
    {
        return isset($this->released_at)
            ? $at
                ? $this->released_at < $at
                : $this->released_at < now()
            : false;
    }

    public function isReleased(Carbon $at = null): bool
    {
        return $this->isReadyToDepart($at);
    }

    public function isDeparted(Carbon $at = null): bool
    {
        return isset($this->departed_at)
            ? $at
                ? $this->departed_at < $at
                : $this->departed_at < now()
            : false;
    }

    public function isDetained(Carbon $at = null)
    {
        return $this->getLongIdleFieldName() == 'detained_at'
            ? !($this->isDeparted($at))
            : !($this->isReleased($at)) && !($this->isDeparted($at));
    }

    public function isLongIdle(Carbon $at = null): bool
    {
        if ($this->isDeparted($at)) return false;

        $fn = $this->getLongIdleFieldName();

        $res =  $at
            ? $at->diffInHours($this->$fn) >= 24
            : now()->diffInHours($this->$fn) >= 24;

        return $res;
    }

    public function isDetainedBetween($startsAt, $endsAt)
    {
        return ($this->detained_at >= $startsAt) && ($this->detained_at < $endsAt);
    }

    public function isReleasedBetween($startsAt, $endsAt)
    {
        return ($this->released_at >= $startsAt) && ($this->released_at < $endsAt);
    }

    public function isDepartedBetween($startsAt, $endsAt)
    {
        return ($this->departed_at >= $startsAt) && ($this->departed_at < $endsAt);
    }

    public function detainedInHours()
    {
        if ($this->released_at) {
            return $this->released_at->diffInHours($this->detained_at);
        }

        if ($this->departed_at) {
            return $this->departed_at->diffInHours($this->detained_at);
        }

        return now()->diffInHours($this->detained_at);
    }

    public function detainedInDays()
    {
        return isset($this->released_at) ? $this->released_at->diffInDays($this->detained_at) : now()->diffInDays($this->detained_at);
    }

    public function detainedAfterReleaseInHours()
    {
//        return isset($this->released_at)
//            ? isset($this->departed_at)
//                ? $this->departed_at->diffInHours($this->released_at)
//                : now()->diffInHours($this->released_at)
//            : null;

        $event = $this->getLongIdleFieldName();

        return isset($this->$event)
            ? isset($this->departed_at)
                ? $this->departed_at->diffInHours($this->$event)
                : now()->diffInHours($this->$event)
            : null;
    }

    private function getLongIdleFieldName()
    {
        return $this->detainer->idle_start_event;
    }

    public function linkCssClass()
    {
        if ($this->isDeparted()) return 'text-success';
        if ($this->isLongIdle()) return 'text-danger';
        if ($this->isReadyToDepart()) return 'text-secondary';
        return null;
    }

    public function renderReturning()
    {
        return $this->returning ? '<span class="fa fa-check"></span>' : '';
    }

    public function renderOperation()
    {
        if (isset($this->operation)) {
            if ($this->operation == 'loading') return 'Погрузка';
            if ($this->operation == 'unloading') return 'Выгрузка';
        }

        return null;
    }

    function isHasAnotherDetaining(): bool
    {
        $records = Wagon::where('inw', $this->inw)->get();

        return count($records) > 1;
    }

    function getAnotherDetaining()
    {
        if ($this->isHasAnotherDetaining()) {
            return $wagons = Wagon::where('inw', $this->inw)->whereKeyNot($this->id)->get();
        }

        return null;
    }

//    scopes

    public function scopeLongDetainedFirst(Builder $query)
    {
        return $query
            ->whereNull('departed_at')
            ->orderBy('detained_at');
    }

    public function scopeLongDetainedOnly(Builder $query, Detainer $detainer = null)
    {
        $wagons = $detainer
            ? Wagon::whereNull('departed_at')->where('detainer_id', $detainer->id)->get()
            : Wagon::whereNull('departed_at')->get();

        $ids = [];


        /** @var Wagon $wagon */
        foreach ($wagons as $wagon) {
            if ($wagon->isLongIdle()) {
                $ids[] = $wagon->id;
            }
        }
        return $query
            ->whereIn('id', $ids)
            ->orderBy('detained_at');
    }

    public function scopeFilter(Builder $query, $filter)
    {
        if (isset($filter['term']) && $term = $filter['term']) {
            $query->where(function ($q) use ($term) {
                // search in the model
                $q->orWhere('inw', 'like', "%{$term}%");
                $q->orWhere('ownership', 'like', "%{$term}%");
            });
        }
    }

//     Mutators
    public function setArrivedAtAttribute($value)
    {
        $this->attributes['arrived_at'] = $this->createDatetime($value);
    }

    public function setDetainedAtAttribute($value)
    {
        $this->attributes['detained_at'] = $this->createDatetime($value);
    }

    public function setReleasedAtAttribute($value)
    {
        $this->attributes['released_at'] = $this->createDatetime($value);
    }

    public function setDepartedAtAttribute($value)
    {
        $this->attributes['departed_at'] = $this->createDatetime($value);
    }

    public function setDeliveredAtAttribute($value)
    {
        $this->attributes['delivered_at'] = $this->createDatetime($value);
    }

    public function setCargoOperationFinishedAtAttribute($value)
    {
        $this->attributes['cargo_operation_finished_at'] = $this->createDatetime($value);
    }

    public function setRemovedAtAttribute($value)
    {
        $this->attributes['removed_at'] = $this->createDatetime($value);
    }

    protected function createDatetime($value)
    {
        return is_string($value) ? Carbon::createFromFormat('d.m.Y H:i', $value) : $value;
    }
}
