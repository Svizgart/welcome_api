<?php

namespace App\Services;

use App\Jobs\SenMassageJob;
use App\Providers\MemberAdded;
use App\Models\{Event, Participant};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class ParticipantService
{
    private $model;
    private $eventService;
    private $emailService;

    private const PAGINATION = 20;

    public function __construct(EventService $eventService, EmailService $emailService)
    {
        $this->eventService = $eventService;
        $this->emailService = $emailService;
        $this->model = new Participant;
    }

    public function pagedList(): LengthAwarePaginator
    {
        return $this->model::paginate(self::PAGINATION);
    }

    public function store(Request $request): ?Participant
    {
        $event = $this->eventService->getEventBayId($request->get('event'));

        if (! $this->eventCheck($event)) {
            return null;
        }

        $participant = $this->model->fill($request->except('events'));
        $participant->save();

        $participant->events()->sync($request->get('events'));

        event(new MemberAdded($this->emailService, $participant));

        return $participant;
    }

    public function update(Participant $participant, Request $request): ?Participant
    {
        if (! $this->eventCheck($this->eventService->getEventBayId($request->get('event')))) {
            return null;
        }

        $participant->fill($request->except('events'));
        $participant->save();

        $participant->events()->sync($request->get('events'));

        return $participant;
    }

    private function eventCheck(Event $event)
    {
        if (is_null($event)) {
            return false;
        }

        if (! $event->date->gte(Carbon::now())) {
            return false;
        }

        return true;
    }

}
