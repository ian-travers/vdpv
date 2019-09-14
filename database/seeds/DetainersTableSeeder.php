<?php

use Illuminate\Database\Seeder;

class DetainersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('detainers')->truncate();

        DB::table('detainers')->insert([
            [
                'name' => 'Служба вагонного хозяйства',
                'idle_start_event' => 'released_at'
            ],
            [
                'name' => 'Пункт коммерческого осмотра вагонов',
                'idle_start_event' => 'released_at'
            ],
            [
                'name' => 'Таможенная служба',
                'idle_start_event' => 'released_at'
            ],
            [
                'name' => 'Ветеринарный контроль',
                'idle_start_event' => 'released_at'
            ],
            [
                'name' => 'Фитосанитарный контроль',
                'idle_start_event' => 'released_at
                '
            ],
            [
                'name' => 'Пункт передачи вагонов',
                'idle_start_event' => 'released_at'
            ],
            [
                'name' => 'Местные вагоны',
                'idle_start_event' => 'cargo_operation_finished_at'
            ],
            [
                'name' => 'Прочие',
                'idle_start_event' => 'released_at'
            ]
        ]);
    }
}
