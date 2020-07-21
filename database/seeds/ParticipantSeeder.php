<?php

use Illuminate\Database\Seeder;
use App\Models\Participant;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $count = 100;

    public function run()
    {
        factory(Participant::class, $this->count)->create();
    }
}
