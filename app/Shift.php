<?php

namespace App;

use Carbon\Carbon;

class Shift
{
    /**
     * @var Carbon
     */
    protected $lastShiftStart;

    /**
     * @var Carbon
     */
    protected $lastShiftEnd;

    /**
     * @var Carbon
     */
    protected $prevShiftStart;

    /**
     * @var Carbon
     */
    protected $prevShiftEnd;

    public function __construct()
    {
        if (Carbon::now()->hour <= 20) {
            $this->lastShiftStart = Carbon::yesterday()->hour(20)->minute(0)->second(1);
            $this->lastShiftEnd = Carbon::today()->hour(8)->minute(0)->second(0);
        } else {
            $this->lastShiftStart = Carbon::today()->hour(8)->minute(0)->second(1);
            $this->lastShiftEnd = Carbon::today()->hour(20)->minute(0)->second(0);
        }

        $this->prevShiftStart = $this->lastShiftStart->parse('-12 hours');
        $this->prevShiftEnd = $this->lastShiftEnd->parse('-12 hours');
    }

    public function getLastShiftStart()
    {
        return $this->lastShiftStart;
    }

    public function getLastShiftEnd()
    {
        return $this->lastShiftEnd;
    }

    public function getPrevShiftStart()
    {
        return $this->prevShiftStart;
    }

    public function getPrevShiftEnd()
    {
        return $this->prevShiftEnd;
    }
}
