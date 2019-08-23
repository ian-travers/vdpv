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

    public function __construct($hour = 0)
    {
        $hour = ($hour >= 0 && $hour <= 23) ? $hour: 0;

        if ($hour > 8 && $hour <= 20) {
            $this->lastShiftEnd = Carbon::today()->hour(8)->minute(0)->second(0);
            $this->lastShiftStart = Carbon::yesterday()->hour(20)->minute(0)->second(0);
            $this->prevShiftEnd = Carbon::yesterday()->hour(20)->minute(0)->second(0);
            $this->prevShiftStart = Carbon::yesterday()->hour(8)->minute(0)->second(0);
        } elseif ($hour > 20) {
            $this->lastShiftEnd = Carbon::today()->hour(20)->minute(0)->second(0);
            $this->lastShiftStart = Carbon::today()->hour(8)->minute(0)->second(0);
            $this->prevShiftEnd = Carbon::today()->hour(8)->minute(0)->second(0);
            $this->prevShiftStart = Carbon::yesterday()->hour(20)->minute(0)->second(0);
        } else {
            $this->lastShiftEnd = Carbon::yesterday()->hour(20)->minute(0)->second(0);
            $this->lastShiftStart = Carbon::yesterday()->hour(8)->minute(0)->second(0);
            $this->prevShiftEnd = Carbon::yesterday()->hour(8)->minute(0)->second(0);
            $this->prevShiftStart = Carbon::parse('-2 day')->hour(20)->minute(0)->second(0);
        }
    }

    public function getLastShiftStart(): Carbon
    {
        return $this->lastShiftStart;
    }

    public function getLastShiftEnd(): Carbon
    {
        return $this->lastShiftEnd;
    }

    public function getPrevShiftStart(): Carbon
    {
        return $this->prevShiftStart;
    }

    public function getPrevShiftEnd(): Carbon
    {
        return $this->prevShiftEnd;
    }
}
