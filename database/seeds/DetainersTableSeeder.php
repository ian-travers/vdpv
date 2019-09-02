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
                'long_detain_event' => 'released_at'
            ],
            [
                'name' => 'Служба грузовой и внешнеэкономической деятельности',
                'long_detain_event' => 'released_at'
            ],
            [
                'name' => 'Таможенная служба',
                'long_detain_event' => 'released_at'
            ],
            [
                'name' => 'Ветеринарный контроль',
                'long_detain_event' => 'released_at'
            ],
            [
                'name' => 'Фитосанитарный контроль',
                'long_detain_event' => 'released_at'
            ],
            [
                'name' => 'Пункт передачи вагонов',
                'long_detain_event' => 'released_at'
            ],
            [
                'name' => 'Местные вагоны',
                'long_detain_event' => 'released_at'
            ],
            [
                'name' => 'Прочие',
                'long_detain_event' => 'released_at'
            ]
        ]);
    }
}
