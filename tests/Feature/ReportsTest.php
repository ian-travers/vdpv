<?php

namespace Tests\Feature;

use App\Shift;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_last_shift_report_is_available()
    {
        $shift = new Shift();

        $this->get(route('reports.last'))
            ->assertOk()
            ->assertSee($shift->getLastShiftStart()->format('d.m.Y H:i'))
            ->assertSee($shift->getLastShiftEnd()->format('d.m.Y H:i'));
    }

    /** @test */
    function a_previous_shift_report_is_available()
    {
        $shift = new Shift();

        $this->get(route('reports.previous'))
            ->assertOk()
            ->assertSee($shift->getPrevShiftStart()->format('d.m.Y H:i'))
            ->assertSee($shift->getPrevShiftEnd()->format('d.m.Y H:i'));
    }

    /** @test */
    function a_custom_period_report_is_available()
    {
        $this->get(route('reports.custom', [
            'start' => '10.08.2019 10:00',
            'end' => '10.08.2019 15:00'
        ]))
            ->assertOk()
            ->assertSee('10.08.2019 10:00')
            ->assertSee('10.08.2019 15:00');
    }

    /** @test */
    function an_at_time_report_is_available()
    {
        $this->get(route('reports.at-time', [
            'time' => '10.08.2019 10:00'
        ]))
            ->assertOk()
            ->assertSee('10:00 10.08.2019');
    }
}
