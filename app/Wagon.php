<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


/**
 * App\Wagon
 *
 * @property int $id
 * @property int $creator_id
 * @property string $inw
 * @property \Illuminate\Support\Carbon|null $arrived_at
 * @property \Illuminate\Support\Carbon|null $detained_at
 * @property \Illuminate\Support\Carbon|null $released_at
 * @property \Illuminate\Support\Carbon|null $departed_at
 * @property int $detainer_id
 * @property string $reason
 * @property string $cargo
 * @property string|null $forwarder
 * @property string|null $ownership
 * @property string $departure_station
 * @property string $destination_station
 * @property string|null $taken_measure
 * @property string|null $operation
 * @property string|null $park
 * @property string|null $way
 * @property string|null $nplf
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $creator
 * @property-read \App\Detainer $detainer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon detainedNow()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon filter($filter)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon latestFirst()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereArrivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereCargo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereCreatorId($value)
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereTakenMeasure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wagon whereWay($value)
 * @mixin \Eloquent
 */
class Wagon extends Model
{
    protected $guarded = [];

    protected $dates = ['arrived_at', 'detained_at', 'released_at', 'departed_at'];

    protected $casts = [
        'is_empty' => 'boolean'
    ];

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

    public function isReadyToDepart()
    {
        return $this->released_at > Carbon::now();
    }

    public function isDetainedLong(): bool
    {
        return ($this->detainedLongInHours() > 0);
    }

    public function detainedInHours()
    {
        return isset($this->departed_at) ? $this->departed_at->diffInHours($this->detained_at) : now()->diffInHours($this->detained_at);
    }

    public function detainedLongInHours()
    {
        $fn = $this->getLongDetainFieldName();

        $res = isset($this->departed_at) ? $this->departed_at->diffInHours($this->$fn) : now()->diffInHours($this->$fn);

        $res -= 24;

        return ($res > 0) ? $res : 0;
    }

    private function getLongDetainFieldName()
    {
        return $this->detainer->long_detain_event;
    }

//     helper functions
    public static function detainedCount(Detainer $detainer = null)
    {
        return $detainer ? $detainer->wagons()->whereNull('departed_at')->count() : Wagon::whereNull('departed_at')->get()->count();
    }

    public static function detainedLongCount(Detainer $detainer = null)
    {
        $wagons = $detainer ? Wagon::whereNull('departed_at')->where('detainer_id', $detainer->id)->get() : Wagon::whereNull('departed_at')->get();

        $res = 0;
        foreach ($wagons as $wagon) {
            if ($wagon->isDetainedLong()) {
                $res++;
            }
        }

        return $res;
    }

//    scopes
    public function scopeLatestFirst(Builder $query)
    {
        return $query
            ->whereNull('departed_at')
            ->orWhere('departed_at', '<', Carbon::parse('-48 hours'))
            ->orderBy('detained_at', 'desc');
    }

    public function scopeLongDetainedFirst(Builder $query)
    {
        return $query
            ->whereNull('departed_at')
            ->orWhere('departed_at', '<', Carbon::parse('-48 hours'))
            ->orderBy('detained_at');
    }

    public function scopeLongDetainedOnly(Builder $query)
    {
        $wagons = Wagon::whereNull('departed_at')->get();

        $ids = [];

        foreach ($wagons as $wagon) {
            if ($wagon->isDetainedLong()) {
                $ids[] = $wagon->id;
            }
        }
        return $query
            ->whereIn('id',$ids)
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

    protected function createDatetime($value)
    {
        return is_string($value) ? Carbon::createFromFormat('d.m.Y H:i', $value) : $value;
    }
}
