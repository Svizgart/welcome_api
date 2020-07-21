<?php

namespace App\Http\Controllers\Api\Participants;

use App\Http\Requests\Api\{CreateParticipantsRequest, UpdateParticipantsRequest};
use App\Http\Controllers\Controller;
use App\Http\Resources\ParticipantResource;
use App\Models\Participant;
use App\Services\ParticipantService;
use Illuminate\Http\JsonResponse;

class ParticipantsController extends Controller
{
    private $service;

    public function __construct(ParticipantService $participantService)
    {
        $this->service = $participantService;
    }

    public function index(): ParticipantResource
    {
        return new ParticipantResource($this->service->pagedList());
    }

    public function store(CreateParticipantsRequest $request)
    {
        return new ParticipantResource($this->service->store($request));
    }

    public function show(Participant $participant): ParticipantResource
    {
        return new ParticipantResource($participant);
    }

    public function update(Participant $participant, UpdateParticipantsRequest $request): ParticipantResource
    {
        return new ParticipantResource($this->service->update($participant, $request));
    }

    public function destroy(Participant $participant): ?JsonResponse
    {
        $participant->delete();

        return response()->json(['success' => true]);
    }
}
