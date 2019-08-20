<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */ 
    function a_last_shift_report_is_available()
    {
        $this->withoutExceptionHandling();
        $this->get('/reports/last')->assertOk();
    }
}
