<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Repositories\Event\EventRepositoryInterface;

class EventController extends Controller
{
    protected $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function show($id)
    {
        try {
            $event = $this->eventRepository->find($id);
            $this->dataView['event'] = $event;

            return view('event.index', $this->dataView);
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}
