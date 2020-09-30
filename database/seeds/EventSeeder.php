<?php

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $count = 10;

    public function run()
    {
        factory(Event::class, $this->count)->create();
    }
}
