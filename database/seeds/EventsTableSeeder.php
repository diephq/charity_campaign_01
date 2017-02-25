<?php

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::truncate();

        factory(Event::class, 20)->create()->each(function ($event) {
            foreach (range(1, 6) as $key) {
                $event->images()->create([
                    'image' => 'event.jpg',
                ]);
            }
        });
    }
}
