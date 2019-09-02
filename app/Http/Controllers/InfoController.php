<?php

namespace App\Http\Controllers;

use App\Charts\LastTenDaysStatisticsChart;
use App\Detainer;
use App\Wagon;
use Carbon\Carbon;

class InfoController extends Controller
{
    protected $wagonsPerPage = 20;

    public function index()
    {
        $detainers = Detainer::all();

        $wagons = request('term')
            ? Wagon::with('detainer')
                ->filter(request()->only(['term']))
                ->paginate($this->wagonsPerPage)
            : [];

        $lastTenDaysChart = new LastTenDaysStatisticsChart();

        return view('info.index', compact('detainers', 'wagons', 'lastTenDaysChart'));
    }

    public function showWagon(Wagon $wagon)
    {
        return view('info.show-wagon', compact('wagon'));
    }

    public function controlled()
    {
        $detainers = Detainer::all();

        $wagons = controlledAtQuery()
            ->longDetainedFirst()
            ->paginate($this->wagonsPerPage);

        return view('info.controlled', compact('detainers', 'wagons'));
    }

    public function detained()
    {
        $detainers = Detainer::all();

        $wagons = detainedAtQuery()
            ->longDetainedFirst()
            ->paginate($this->wagonsPerPage);

        return view('info.detained', compact('detainers', 'wagons'));
    }

    public function controlledBy(Detainer $detainer)
    {
        $wagons = controlledAtQuery($detainer)
            ->longDetainedFirst()
            ->paginate($this->wagonsPerPage);

        return view('info.controlled-by', compact('detainer', 'wagons'));
    }

    public function detainedBy(Detainer $detainer)
    {
        $wagons = detainedAtQuery($detainer)
            ->longDetainedFirst()
            ->paginate($this->wagonsPerPage);

        return view('info.detained-by', compact('detainer', 'wagons'));
    }

    public function detainedByLong(Detainer $detainer)
    {
        $wagons = $detainer->wagons()
            ->longDetainedOnly($detainer)
            ->paginate($this->wagonsPerPage);

        return view('info.detained-by-long', compact('detainer', 'wagons'));
    }

    public function longOnly()
    {
        $wagons = Wagon::with('detainer')
            ->longDetainedOnly()
            ->paginate($this->wagonsPerPage);

        return view('info.long-only', compact('wagons'));
    }

    public function recent($day, $type)
    {
        $beforeYesterday = Carbon::parse('-2 day')->hour(0)->minute(0)->second(0);

        if ($day == 'today') {
            $wagons = Wagon::where($type . '_at', '>', Carbon::today())->paginate($this->wagonsPerPage);
            $day = 'Сегодня';
        } elseif ($day == 'yesterday') {
            $wagons = Wagon::whereBetween($type . '_at', [Carbon::yesterday(), Carbon::today()])->paginate($this->wagonsPerPage);
            $day = 'Вчера';
        } else {
            $wagons = Wagon::whereBetween($type . '_at', [$beforeYesterday, Carbon::yesterday()])->paginate($this->wagonsPerPage);
            $day = 'Позавчера';
        }

        if ($type == 'detained') {
            $type = 'задержано';
        } elseif ($type == 'released') {
            $type = 'выпущено';
        } elseif ($type == 'departed') {
            $type = 'отправлено';
        }

        $arr = $wagons->total();

        return view('info.recent', compact('day', 'type', 'wagons'));
    }
}
