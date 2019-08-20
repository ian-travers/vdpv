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
            $this->lastShiftStart = Carbon::yesterday()->hour(20)->minute(0)->second(0);
            $this->lastShiftEnd = Carbon::today()->hour(8)->minute(0)->second(0);
            $this->prevShiftStart = Carbon::yesterday()->hour(8)->minute(0)->second(0);
            $this->prevShiftEnd = Carbon::yesterday()->hour(20)->minute(0)->second(0);
        } else {
            $this->lastShiftStart = Carbon::today()->hour(8)->minute(0)->second(0);
            $this->lastShiftEnd = Carbon::today()->hour(20)->minute(0)->second(0);
            $this->prevShiftStart = Carbon::yesterday()->hour(20)->minute(0)->second(0);
            $this->prevShiftEnd = Carbon::today()->hour(8)->minute(0)->second(0);
        }
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
