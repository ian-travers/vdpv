<?php

namespace App\Http\Controllers;

use App\Detainer;
use App\Wagon;
use Carbon\Carbon;

class InfoController extends Controller
{
    protected $wagonsPerPage = 15;

    public function index()
    {
        $wagons = request('term')
            ? Wagon::with('detainer')
                ->filter(request()->only(['term']))
                ->paginate($this->wagonsPerPage)
            : Wagon::with('detainer')
                ->longDetainedFirst()
                ->paginate($this->wagonsPerPage);;

        return view('info.index', compact('wagons'));
    }

    public function showWagon(Wagon $wagon)
    {
        return view('info.show-wagon', compact('wagon'));
    }

    public function detainedBy(Detainer $detainer)
    {
        $wagons = $detainer->wagons()
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

        $wagons = $day == 'today'
            ? Wagon::where($type . '_at', '>', Carbon::today())->paginate($this->wagonsPerPage)
            : $day == 'yesterday'
                ? Wagon::whereBetween($type . '_at', [Carbon::yesterday(), Carbon::today()])->paginate($this->wagonsPerPage)
                : Wagon::whereBetween($type . '_at', [$beforeYesterday, Carbon::yesterday()])->paginate($this->wagonsPerPage);

        $day = $day == 'today'
            ? 'Сегодня'
            : $day == 'yesterday'
                ? 'Вчера'
                : 'Позавчера';

        if ($type == 'detained') {
            $type = 'задержано';
        } elseif ($type == 'released') {
            $type = 'выпущено';
        } elseif ($type == 'departed') {
            $type = 'отправлено';
        }

        return view('info.recent', compact('day', 'type', 'wagons'));
    }
}
