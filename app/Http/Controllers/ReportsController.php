<?php

namespace App\Http\Controllers;

use App\Detainer;
use App\Shift;
use App\Wagon;

class ReportsController extends Controller
{
    /**
     * @var Shift
     */
    private $shift;

    public function __construct(Shift $shift)
    {
        $this->shift = $shift;
    }

    public function showLast()
    {
        $detainers = Detainer::all();

        $shiftStartsAt = $this->shift->getLastShiftStart();
        $shiftEndsAt = $this->shift->getLastShiftEnd();

        $wagons = Wagon::wagonsChangedForPeriod($shiftStartsAt, $shiftEndsAt);

        return view('reports.period', compact('detainers', 'wagons', 'shiftStartsAt', 'shiftEndsAt'));
    }

    public function showPrevious()
    {
        $detainers = Detainer::all();

        $shiftStartsAt = $this->shift->getPrevShiftStart();
        $shiftEndsAt = $this->shift->getPrevShiftEnd();

        $wagons = Wagon::wagonsChangedForPeriod($shiftStartsAt, $shiftEndsAt);

        return view('reports.period', compact('detainers', 'wagons', 'shiftStartsAt', 'shiftEndsAt'));
    }
}
