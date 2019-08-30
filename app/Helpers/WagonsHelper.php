<?php

use Carbon\Carbon;
use App\Detainer;
use App\Wagon;

/**
 * Returns count detained wagons between two dates
 *
 * @param Detainer|null $detainer
 * @param Carbon $startAt
 * @param Carbon $endAt
 * @return mixed
 */
function detainedPeriodCount(Detainer $detainer = null, Carbon $startAt, Carbon $endAt)
{
    return detainedPeriodQuery($detainer, $startAt, $endAt)->count();
}

/**
 * Returns count detained long wagons between two dates
 *
 * @param Detainer|null $detainer
 * @param Carbon $startAt
 * @param Carbon $endAt
 * @return int
 */
function detainedLongPeriodCount(Detainer $detainer = null, Carbon $startAt, Carbon $endAt)
{
    $wagons = detainedPeriodQuery($detainer, $startAt, $endAt)->get();

    $res = 0;

    /** @var Wagon $wagon */
    foreach ($wagons as $wagon) {
        if ($wagon->isLongIdle()) {
            $res++;
        }
    }

    return $res;
}

function detainedPeriodQuery(Detainer $detainer = null, Carbon $startAt, Carbon $endAt)
{
    return $detainer
        ? $detainer->wagons()->where('detained_at', '>=', $startAt)->where('detained_at', '<', $endAt)
        : Wagon::where('detained_at', '>=', $startAt)->where('detained_at', '<', $endAt);
}

/* ----------------------------- */

/**
 * Returns detained wagons at time
 *
 * @param Detainer|null $detainer
 * @param Carbon|null $datetime
 * @return Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
 */
function detainedAtAll(Detainer $detainer = null, Carbon $datetime = null)
{
    return detainedAtQuery($detainer, $datetime)->get();
}

/**
 * Returns count detained wagons on the certain date (now if date is null)
 *
 * @param Detainer|null $detainer
 * @param Carbon|null $datetime
 * @return int
 */
function detainedAtCount(Detainer $detainer = null, Carbon $datetime = null)
{
    return detainedAtQuery($detainer, $datetime)->count();
}

/**
 * Returns count long detained wagons on the certain date (now if date is null)
 *
 * @param Detainer|null $detainer
 * @param Carbon|null $datetime
 * @return int
 */
function detainedLongAtCount(Detainer $detainer = null, Carbon $datetime = null)
{
    $wagons = detainedAtQuery($detainer, $datetime)->get();

    $res = 0;

    /** @var Wagon $wagon */
    foreach ($wagons as $wagon) {
        if ($wagon->isLongIdle()) {
            $res++;
        }
    }

    return $res;
}

function detainedAtQuery(Detainer $detainer = null, Carbon $datetime = null)
{
    if ($datetime) {
        $query = $detainer
            ? $detainer->wagons()
                ->where('detained_at', '<', $datetime)
                ->where(function ($query) use ($datetime) {
                    $query
                        ->whereNull('departed_at')
                        ->orWhere('departed_at', '>=', $datetime);
                })


            : Wagon::where('detained_at', '<', $datetime)
                ->where(function ($query) use ($datetime) {
                    $query
                        ->whereNull('departed_at')
                        ->orWhere('departed_at', '>=', $datetime);
                });
    } else {
        $query = $detainer
            ? $detainer->wagons()->whereNull('departed_at')
            : Wagon::whereNull('departed_at');
    }

    return $query;
}

/*  ----------------------------- */

/**
 * Return all wagons detained between two dates
 *
 * @param Carbon $startsAt
 * @param Carbon $endsAt
 * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
 */
function wagonsDetainedForPeriod(Carbon $startsAt, Carbon $endsAt)
{
    return Wagon::where('detained_at', '>=', $startsAt)
        ->where('detained_at', '<' , $endsAt)
        ->orderBy('detained_at')
        ->get();
}

function wagonsOperationCountByDay($operation, Carbon $day)
{
    if (!($operation == 'detained' || $operation == 'released' || $operation == 'departed')) {
        return 0;
    }

    $queryOperation = $operation . '_at';

    $start = Carbon::parse($day)->hour(0)->minute(0)->second(0);
    $end = Carbon::parse($day)->hour(23)->minute(59)->second(59);

    $query = Wagon::where($queryOperation, '>=', $start)
        ->where($queryOperation, '<=', $end)
        ->toSql();

    return Wagon::where($queryOperation, '>=', $start)
        ->where($queryOperation, '<=', $end)
        ->count();
}