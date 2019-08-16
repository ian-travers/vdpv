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
        $wagons = Wagon::with('detainer')
            ->longDetainedFirst()
            ->filter(request()->only(['term']))
            ->paginate($this->wagonsPerPage);

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

    public function longOnly()
    {
        $wagons = Wagon::with('detainer')
            ->longDetainedOnly()
            ->paginate($this->wagonsPerPage);

        return view('info.long-only', compact('wagons'));
    }

    public function recent($day, $type)
    {
        $wagons = $day == 'today'
            ? Wagon::where($type . '_at', '>', Carbon::today())->paginate($this->wagonsPerPage)
            : Wagon::whereBetween($type . '_at', [Carbon::yesterday(), Carbon::today()])->paginate($this->wagonsPerPage);

//        dd($wagons->items());

        $day = $day == 'today' ? 'Сегодня' : 'Вчера';

        if ($type == 'detained') {
            $type = 'задержано';
        } elseif ($type == 'released') {
            $type = 'выпущен';
        } elseif ($type == 'departed') {
            $type = 'отправлено';
        }

        return view('info.recent', compact('day', 'type', 'wagons'));
    }
}
