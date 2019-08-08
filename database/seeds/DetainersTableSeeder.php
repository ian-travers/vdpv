<?php

use Illuminate\Database\Seeder;

class DetainersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('detainers')->truncate();

        DB::table('detainers')->insert([
            [
                'name' => 'Таможенная служба',
                'long_detain_event' => 'detained_at'
            ],
            [
                'name' => 'Вагонное предприятие',
                'long_detain_event' => 'released_at'
            ],
            [
                'name' => 'Коммерческая неисправность',
                'long_detain_event' => 'detained_at'
            ],
            [
                'name' => 'Ветеринарный контроль',
                'long_detain_event' => 'detained_at'
            ],
            [
                'name' => 'Фитосанитарный контроль',
                'long_detain_event' => 'detained_at'
            ],
            [
                'name' => 'Транспортно-экспедиционная организация',
                'long_detain_event' => 'detained_at'
            ],
            [
                'name' => 'Пункт передачи выгонов',
                'long_detain_event' => 'detained_at'
            ],
            [
                'name' => 'Местные вагоны',
                'long_detain_event' => 'released_at'
            ]
        ]);
    }
}
