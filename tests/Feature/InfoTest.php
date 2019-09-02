<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\Setup\WagonFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InfoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function show_empty_info()
    {
        $this->assertCount(0, controlledAtAll());
        $this->assertEquals(0, controlledAtCount());
        $this->assertEquals(0, detainedLongAtCount());

        $this->get(route('long-only'))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'departed']))->assertSee('Ничего не найдено');
    }

    /** @test */
    function can_see_detained_long_wagon()
    {
        $wagon = app(WagonFactory::class)->create();

        $wagon->update([
            'detained_at' => Carbon::parse('-26 hours'),
            'released_at' => Carbon::parse('-25 hours'),
        ]);

        $this->assertCount(1, controlledAtAll());
        $this->assertEquals(1, controlledAtCount());
        $this->assertEquals(1, detainedLongAtCount());

        $this->get(route('long-only'))->assertSee($wagon->inw);
//        $this->get(route('recent', ['yesterday', 'detained']))->assertSee($wagon->inw);
    }

    /** @test */
    function can_see_detained_today_wagon()
    {
        $wagon = app(WagonFactory::class)->create();

        $this->assertCount(1, controlledAtAll());
        $this->assertEquals(1, controlledAtCount());
        $this->assertEquals(0, detainedLongAtCount());

        $this->get(route('long-only'))->assertSee('Ничего не найдено');

        $this->get(route('recent', ['today', 'detained']))->assertSee($wagon->inw);
        $this->get(route('recent', ['today', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'departed']))->assertSee('Ничего не найдено');
    }
    
    /** @test */ 
    function can_see_released_today_wagon()
    {
        $wagon = app(WagonFactory::class)->create();

        $wagon->update([
            'released_at' => Carbon::parse('-10 minutes'),
        ]);

        $this->assertCount(1, controlledAtAll());
        $this->assertEquals(1, controlledAtCount());
        $this->assertEquals(0, detainedLongAtCount());

        $this->get(route('recent', ['today', 'detained']))->assertSee($wagon->inw);
        $this->get(route('recent', ['today', 'released']))->assertSee($wagon->inw);
        $this->get(route('recent', ['today', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'departed']))->assertSee('Ничего не найдено');
    }

    /** @test */
    function can_see_departed_today_wagon()
    {
        $wagon = app(WagonFactory::class)->create();

        $wagon->update([
            'released_at' => Carbon::parse('-10 minutes'),
            'departed_at' => Carbon::parse('-5 minutes'),
        ]);

        $this->assertCount(0, controlledAtAll());
        $this->assertEquals(0, controlledAtCount());
        $this->assertEquals(0, detainedLongAtCount());

        $this->get(route('recent', ['today', 'detained']))->assertSee($wagon->inw);
        $this->get(route('recent', ['today', 'released']))->assertSee($wagon->inw);
        $this->get(route('recent', ['today', 'departed']))->assertSee($wagon->inw);
        $this->get(route('recent', ['yesterday', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'departed']))->assertSee('Ничего не найдено');
    }

    /** @test */
    function can_see_detained_yesterday_wagon()
    {
        $wagon = app(WagonFactory::class)->create();

        $wagon->update([
            'detained_at' =>Carbon::parse('-27 hours')
        ]);

        $this->get(route('recent', ['today', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'detained']))->assertSee($wagon->inw);
        $this->get(route('recent', ['yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'departed']))->assertSee('Ничего не найдено');
    }

    /** @test */
    function can_see_released_yesterday_wagon()
    {
        $wagon = app(WagonFactory::class)->create();

        $wagon->update([
            'detained_at' =>Carbon::parse('-27 hours'),
            'released_at' => Carbon::parse('-26 hours')
        ]);

        $this->get(route('recent', ['today', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'detained']))->assertSee($wagon->inw);
        $this->get(route('recent', ['yesterday', 'released']))->assertSee($wagon->inw);
        $this->get(route('recent', ['yesterday', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'departed']))->assertSee('Ничего не найдено');
    }

    /** @test */
    function can_see_departed_yesterday_wagon()
    {
        $wagon = app(WagonFactory::class)->create();

        $wagon->update([
            'detained_at' =>Carbon::parse('-27 hours'),
            'released_at' => Carbon::parse('-26 hours'),
            'departed_at' => Carbon::parse('-25 hours')
        ]);

        $this->get(route('recent', ['today', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'detained']))->assertSee($wagon->inw);
        $this->get(route('recent', ['yesterday', 'released']))->assertSee($wagon->inw);
        $this->get(route('recent', ['yesterday', 'departed']))->assertSee($wagon->inw);
        $this->get(route('recent', ['before-yesterday', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'departed']))->assertSee('Ничего не найдено');
    }

    /** @test */
    function can_see_detained_before_yesterday_wagon()
    {
        $wagon = app(WagonFactory::class)->create();

        $wagon->update([
            'detained_at' =>Carbon::parse('-51 hours')
        ]);

        $this->get(route('recent', ['today', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'detained']))->assertSee($wagon->inw);
        $this->get(route('recent', ['before-yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'departed']))->assertSee('Ничего не найдено');
    }

    /** @test */
    function can_see_released_before_yesterday_wagon()
    {
        $wagon = app(WagonFactory::class)->create();

        $wagon->update([
            'detained_at' =>Carbon::parse('-51 hours'),
            'released_at' => Carbon::parse('-50 hours')
        ]);

        $this->get(route('recent', ['today', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'detained']))->assertSee($wagon->inw);
        $this->get(route('recent', ['before-yesterday', 'released']))->assertSee($wagon->inw);
        $this->get(route('recent', ['before-yesterday', 'departed']))->assertSee('Ничего не найдено');
    }

    /** @test */
    function can_see_departed_before_yesterday_wagon()
    {
        $wagon = app(WagonFactory::class)->create();

        $wagon->update([
            'detained_at' =>Carbon::parse('-51 hours'),
            'released_at' => Carbon::parse('-50 hours'),
            'departed_at' => Carbon::parse('-49 hours')
        ]);

        $this->get(route('recent', ['today', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['today', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'detained']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'released']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['yesterday', 'departed']))->assertSee('Ничего не найдено');
        $this->get(route('recent', ['before-yesterday', 'detained']))->assertSee($wagon->inw);
        $this->get(route('recent', ['before-yesterday', 'released']))->assertSee($wagon->inw);
        $this->get(route('recent', ['before-yesterday', 'departed']))->assertSee($wagon->inw);
    }

    /** @test */
    function ttt()
    {
        $w1 = app(WagonFactory::class)->create();

        $this->assertEquals(1, controlledAtCount());
        $this->assertEquals(1, detainedAtCount());

        $w1->update([
            'released_at' => Carbon::parse('-5 min')
        ]);

        $this->assertEquals(1, controlledAtCount());
        $this->assertEquals(0, detainedAtCount());
    }
}
