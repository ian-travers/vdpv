<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Carbon\Carbon;

class LastTenDaysStatisticsChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $labels = [];
        $detainedByDay = [];
        $departedByDay = [];
        for ($i = 10; $i >= 1; $i--) {
            $labels[] = Carbon::parse('-' . $i . ' days')->format('d.m.Y');
            $detainedByDay[] = wagonsOperationCountByDay('detained', Carbon::parse('-' . $i . ' days'));
            $departedByDay[] = wagonsOperationCountByDay('departed', Carbon::parse('-' . $i . ' days'));
        }


        $this->labels = array_values($labels);
        $this->dataset('Задержано', 'line', array_values($detainedByDay))->color('blue')->backgroundcolor('blue');
        $this->dataset('Отправлено', 'line', array_values($departedByDay))->color('green')->backgroundcolor('green');
        $this->options([
            'elements' => [
                'line' => [
                    'fill' => false
                ]
            ],
            'plugins' => '{
                datalabels: {
                    backgroundColor: function(context) {
                        return context.dataset.backgroundColor;
                    },
                    borderRadius: 8,
                    color: "white",
                    font: {
                        weight: "bold"
                    },
                }
            }'
        ]);
    }
}
