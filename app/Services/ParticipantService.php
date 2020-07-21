<?php

namespace App\Services;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class ParticipantService
{
    private $model;
    private $eventService;

    private const PAGINATION = 20;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
        $this->model = new Participant;
    }

    public function pagedList(): LengthAwarePaginator
    {
        return $this->model::paginate(self::PAGINATION);
    }

    //TODO: отправка писем
    public function store(Request $request): ?Participant
    {
        if (! $this->eventService->issetEvent($request->get('event'))) {
            return null;
        }

        $participant = $this->model->fill($request->except('events'));
        $participant->save();

        $participant->events()->sync($request->get('events'));

        return $participant;
    }

    public function update(Participant $participant, Request $request): ?Participant
    {
        if (! $this->eventService->issetEvent($request->get('event'))) {
            return null;
        }

        $participant->fill($request->except('events'));
        $participant->save();

        $participant->events()->sync($request->get('events'));

        return $participant;
    }

}
