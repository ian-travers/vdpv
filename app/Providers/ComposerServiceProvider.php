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

            $todayDetainedCount = Wagon::where('detained_at', '>=', Carbon::today())->count();
            $todayReleasedCount = Wagon::where('released_at', '>=', Carbon::today())->count();
            $todayDepartedCount = Wagon::where('departed_at', '>=', Carbon::today())->count();

            $yesterdayDetainedCount = Wagon::whereBetween('detained_at', [Carbon::yesterday(), Carbon::today()])->count();
            $yesterdayReleasedCount = Wagon::whereBetween('released_at', [Carbon::yesterday(), Carbon::today()])->count();
            $yesterdayDepartedCount = Wagon::whereBetween('departed_at', [Carbon::yesterday(), Carbon::today()])->count();

            $beforeYesterday = Carbon::parse('-2 day')->hour(0)->minute(0)->second(0);

            $beforeYesterdayDetainedCount = Wagon::whereBetween('detained_at', [$beforeYesterday, Carbon::yesterday()])->count();
            $beforeYesterdayReleasedCount = Wagon::whereBetween('released_at', [$beforeYesterday, Carbon::yesterday()])->count();
            $beforeYesterdayDepartedCount = Wagon::whereBetween('departed_at', [$beforeYesterday, Carbon::yesterday()])->count();

            return $view->with(compact('detainers',
                'todayDetainedCount' , 'todayReleasedCount', 'todayDepartedCount',
                'yesterdayDetainedCount', 'yesterdayReleasedCount', 'yesterdayDepartedCount',
                'beforeYesterdayDetainedCount', 'beforeYesterdayReleasedCount', 'beforeYesterdayDepartedCount'));
        });
    }
}
