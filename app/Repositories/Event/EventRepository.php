<?php
namespace App\Repositories\Event;

use App\Models\Event;
use App\Repositories\BaseRepository;
use App\Repositories\Event\EventRepositoryInterface;

class EventRepository extends BaseRepository implements EventRepositoryInterface
{
    function model()
    {
        return Event::class;
    }
}
