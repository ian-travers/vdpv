<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Detainer;
use App\Wagon;
use Carbon\Carbon;
use Illuminate\View\View;

class ComposerServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        view()->composer('info.sidebar', function (View $view) {
            $detainers = Detainer::all();
            $curDayDetainedCount = Wagon::where('detained_at', '>=', Carbon::today())->count();
            $curDayReleasedCount = Wagon::where('released_at', '>=', Carbon::today())->count();
            $curDayDepartedCount = Wagon::where('departed_at', '>=', Carbon::today())->count();
            $prevDayDetainedCount = Wagon::whereBetween('detained_at', [Carbon::yesterday(), Carbon::today()])->count();
            $prevDayReleasedCount = Wagon::whereBetween('released_at', [Carbon::yesterday(), Carbon::today()])->count();
            $prevDayDepartedCount = Wagon::whereBetween('departed_at', [Carbon::yesterday(), Carbon::today()])->count();

            return $view->with(compact('detainers',
                'curDayDetainedCount' , 'curDayReleasedCount', 'curDayDepartedCount',
                'prevDayDetainedCount', 'prevDayReleasedCount', 'prevDayDepartedCount'));
        });
    }
}
