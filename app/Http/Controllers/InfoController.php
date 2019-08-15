<?php

namespace App\Http\Controllers;

use App\Detainer;
use App\Wagon;
use Carbon\Carbon;

class InfoController extends Controller
{
    private $detainers;

    protected $wagonsPerPage = 10;

    private $curDayDetainedCount;
    private $curDayReleasedCount;
    private $curDayDepartedCount;
    private $prevDayDetainedCount;
    private $prevDayReleasedCount;
    private $prevDayDepartedCount;

    public function __construct()
    {
        $this->detainers = Detainer::all();
        $this->curDayDetainedCount = Wagon::where('detained_at', '>=', Carbon::today())->count();
        $this->curDayReleasedCount = Wagon::where('released_at', '>=', Carbon::today())->count();
        $this->curDayDepartedCount = Wagon::where('departed_at', '>=', Carbon::today())->count();
        $this->prevDayDetainedCount = Wagon::whereBetween('detained_at', [Carbon::yesterday(), Carbon::today()])->count();
        $this->prevDayReleasedCount = Wagon::whereBetween('released_at', [Carbon::yesterday(), Carbon::today()])->count();
        $this->prevDayDepartedCount = Wagon::whereBetween('departed_at', [Carbon::yesterday(), Carbon::today()])->count();
    }

    public function index()
    {
        $detainers = $this->detainers;

        $wagons = Wagon::with('detainer')
            ->longDetainedFirst()
            ->filter(request()->only(['term']))
            ->paginate($this->wagonsPerPage);

        $curDayDetainedCount = $this->curDayDetainedCount;
        $curDayReleasedCount = $this->curDayReleasedCount;
        $curDayDepartedCount = $this->curDayDepartedCount;
        $prevDayDetainedCount = $this->prevDayDetainedCount;
        $prevDayReleasedCount = $this->prevDayReleasedCount;
        $prevDayDepartedCount = $this->prevDayDepartedCount;

        return view('info.index', compact('detainers', 'wagons',
            'curDayDetainedCount', 'curDayReleasedCount', 'curDayDepartedCount',
            'prevDayDetainedCount', 'prevDayReleasedCount', 'prevDayDepartedCount'
            ));
    }

    public function showWagon(Wagon $wagon)
    {
        $detainers = Detainer::all();

        $curDayDetainedCount = $this->curDayDetainedCount;
        $curDayReleasedCount = $this->curDayReleasedCount;
        $curDayDepartedCount = $this->curDayDepartedCount;
        $prevDayDetainedCount = $this->prevDayDetainedCount;
        $prevDayReleasedCount = $this->prevDayReleasedCount;
        $prevDayDepartedCount = $this->prevDayDepartedCount;

        return view('info.show-wagon', compact('detainers', 'wagon',
            'curDayDetainedCount', 'curDayReleasedCount', 'curDayDepartedCount',
            'prevDayDetainedCount', 'prevDayReleasedCount', 'prevDayDepartedCount'
            ));
    }

    public function detainedBy(Detainer $detainer)
    {
        $detainers = Detainer::all();

        $wagons = $detainer->wagons()
            ->longDetainedFirst()
            ->paginate($this->wagonsPerPage);

        $curDayDetainedCount = $this->curDayDetainedCount;
        $curDayReleasedCount = $this->curDayReleasedCount;
        $curDayDepartedCount = $this->curDayDepartedCount;
        $prevDayDetainedCount = $this->prevDayDetainedCount;
        $prevDayReleasedCount = $this->prevDayReleasedCount;
        $prevDayDepartedCount = $this->prevDayDepartedCount;

        return view('info.detained-by', compact('detainers', 'detainer', 'wagons',
            'curDayDetainedCount', 'curDayReleasedCount', 'curDayDepartedCount',
            'prevDayDetainedCount', 'prevDayReleasedCount', 'prevDayDepartedCount'
            ));
    }

    public function longOnly()
    {
        $detainers = $this->detainers;

        $wagons = Wagon::with('detainer')
            ->longDetainedOnly()
            ->paginate($this->wagonsPerPage);

        $curDayDetainedCount = $this->curDayDetainedCount;
        $curDayReleasedCount = $this->curDayReleasedCount;
        $curDayDepartedCount = $this->curDayDepartedCount;
        $prevDayDetainedCount = $this->prevDayDetainedCount;
        $prevDayReleasedCount = $this->prevDayReleasedCount;
        $prevDayDepartedCount = $this->prevDayDepartedCount;

        return view('info.long-only', compact('detainers', 'wagons',
            'curDayDetainedCount', 'curDayReleasedCount', 'curDayDepartedCount',
            'prevDayDetainedCount', 'prevDayReleasedCount', 'prevDayDepartedCount'
        ));
    }
}
