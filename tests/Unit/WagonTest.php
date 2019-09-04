<?php

namespace Tests\Unit;

use App\Detainer;
use App\User;
use App\Wagon;
use Carbon\Carbon;
use Tests\Setup\WagonFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WagonTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_has_a_path()
    {
        $wagon = app(WagonFactory::class)->create();

        $this->assertEquals("/wagons/{$wagon->id}", $wagon->path());
    }

    /** @test */
    function it_belongs_to_an_creator()
    {
        $wagon = app(WagonFactory::class)->create();

        $this->assertInstanceOf(User::class, $wagon->creator);
    }

    /** @test */
    function it_belongs_to_detainer()
    {
        $wagon = app(WagonFactory::class)->create();

        $detainer = Detainer::find($wagon->detainer_id);

        $this->assertInstanceOf(Detainer::class, $detainer);
    }

    /** @test */
    function check_arrived_at_setter()
    {
        $wagon = app(WagonFactory::class)->create();

        $d = Carbon::parse('+20 min');

        $wagon->setAttribute('arrived_at', $d);

        $this->assertEquals($wagon->arrived_at, $d);

        $this->expectException(\InvalidArgumentException::class);
        $wagon->setAttribute('arrived_at', '01.01.2019 12:55:00');
    }

    /** @test */
    function check_detained_time()
    {
        $wagon = app(WagonFactory::class)->create();

        $wagon->update([
            'detainer_id' => 1,
            'detained_at' => Carbon::parse('-11 hours')
        ]);

        $this->assertEquals(11, $wagon->detainedInHours());

        $wagon->update([
            'departed_at' => Carbon::parse('-2 hours')
        ]);

        $this->assertEquals(9, $wagon->detainedInHours());

    }

    /** @test */
    function check_is_detained_long_time_the_local_wagons()
    {
        $this->artisan('db:seed --class=DetainersTableSeeder');

        $wagon = app(WagonFactory::class)->create();

        $this->assertFalse($wagon->isLongIdle());

        $wagon->update([
            'detainer_id' => 7,
            'detained_at' => Carbon::parse('-45 hours'),
            'released_at' => Carbon::parse('-45 hours')
        ]);

        $this->assertTrue($wagon->fresh()->isLongIdle());

        $wagon->update([
            'departed_at' => Carbon::parse('-5 hours'),
        ]);

        $this->assertFalse($wagon->fresh()->isLongIdle());
    }

    /** @test */
    function it_has_a_view_path()
    {
        $wagon = app(WagonFactory::class)->create();

        $this->assertEquals("/view/{$wagon->id}", $wagon->viewPath());
    }

    /** @test */
    function check_wagon_link_css_class()
    {
        $this->artisan('db:seed --class=DetainersTableSeeder');

        $wagon = app(WagonFactory::class)->create();

        $this->assertNull($wagon->linkCssClass());

        $wagon->update(['departed_at' => Carbon::now()]);

        $this->assertEquals('text-success', $wagon->linkCssClass());

        $wagon->update(['released_at' => Carbon::now()]);

        $this->assertEquals('text-success', $wagon->linkCssClass());

        $wagon->update(['departed_at' => null]);

        $this->assertEquals('text-secondary', $wagon->linkCssClass());

        $wagon->update(['detained_at' => Carbon::parse('-25 hours')]);

        $this->assertEquals('text-secondary', $wagon->linkCssClass());

        $wagon->update(['detainer_id' => 2]);

        $this->assertEquals('text-danger', $wagon->fresh()->linkCssClass());
    }

    /** @test */
    function check_returning_render()
    {
        $wagon = app(WagonFactory::class)->create();

        $this->assertEmpty($wagon->renderReturning());

        $wagon->update(['returning' => true]);

        $this->assertEquals('<span class="fa fa-check"></span>', $wagon->renderReturning());
    }

    /** @test */
    function it_has_not_another_detaining_after_creating()
    {
        $wagon = app(WagonFactory::class)->create();

        $this->assertFalse($wagon->isHasAnotherDetaining());
        $this->assertNull($wagon->getAnotherDetaining());
    }

    /** @test */
    function it_may_has_another_detaining()
    {
        $wagon = app(WagonFactory::class)->create();

        factory(Wagon::class)->create(['inw' => $wagon->inw]);

        $this->assertTrue($wagon->isHasAnotherDetaining());
        $this->assertCount(1, $wagon->getAnotherDetaining());
    }
}
