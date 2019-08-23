<?php

namespace Tests\Unit;

use App\Shift;
use Carbon\Carbon;
use Tests\TestCase;

class ShiftTest extends TestCase
{
    /** @test */
    function check_shift_times_between_8_20()
    {
        $shift = new Shift(9);

        $this->assertEquals(Carbon::today()->hour(8)->minute(0)->second(0), $shift->getLastShiftEnd());
        $this->assertEquals(Carbon::yesterday()->hour(20)->minute(0)->second(0), $shift->getLastShiftStart());
        $this->assertEquals(Carbon::yesterday()->hour(20)->minute(0)->second(0), $shift->getPrevShiftEnd());
        $this->assertEquals(Carbon::yesterday()->hour(8)->minute(0)->second(0), $shift->getPrevShiftStart());
    }

    /** @test */
    function check_shift_times_between_20_23()
    {
        $shift = new Shift(21);

        $this->assertEquals(Carbon::today()->hour(20)->minute(0)->second(0), $shift->getLastShiftEnd());
        $this->assertEquals(Carbon::today()->hour(8)->minute(0)->second(0), $shift->getLastShiftStart());
        $this->assertEquals(Carbon::today()->hour(8)->minute(0)->second(0), $shift->getPrevShiftEnd());
        $this->assertEquals(Carbon::yesterday()->hour(20)->minute(0)->second(0), $shift->getPrevShiftStart());
    }

    /** @test */
    function check_shift_times_between_0_7()
    {
        $shift = new Shift(2);

        $this->assertEquals(Carbon::yesterday()->hour(20)->minute(0)->second(0), $shift->getLastShiftEnd());
        $this->assertEquals(Carbon::yesterday()->hour(8)->minute(0)->second(0), $shift->getLastShiftStart());
        $this->assertEquals(Carbon::yesterday()->hour(8)->minute(0)->second(0), $shift->getPrevShiftEnd());
        $this->assertEquals(0, $shift->getPrevShiftStart()->diffInMinutes(Carbon::parse('-2 day')->hour(20)->minute(0)->second(0)));
    }
}
