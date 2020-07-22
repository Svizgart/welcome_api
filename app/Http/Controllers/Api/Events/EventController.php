<?php

namespace App\Http\Controllers\Api\Events;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventService;

class EventController extends Controller
{
    private $service;

    public function __construct(EventService $eventService)
    {
        $this->service = $eventService;
    }

    public function getEvents(): EventResource
    {
        return new EventResource($this->service->pagedList());
    }

    public function show(Event $event): EventResource
    {
        return new EventResource($event);
    }
}
