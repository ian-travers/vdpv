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

        $this->withoutExceptionHandling();
        $this->get('/reports/last')
            ->assertOk()
            ->assertSee($shift->getLastShiftStart()->format('d.m.Y H:i'));
    }
}
