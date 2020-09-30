<?php

use Illuminate\Database\Seeder;

class EventParticipantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            \Illuminate\Support\Facades\DB::table('event_participant')->insert([
                'event_id' => \App\Models\Event::inRandomOrder()->first()->id,
                'participant_id' => \App\Models\Participant::inRandomOrder()->first()->id,
            ]);
        }
    }
}
