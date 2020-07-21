<?php

namespace App\Http\Controllers\Api\Participants;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParticipantResource;
use App\Models\Participant;
use App\Services\ParticipantService;
use Illuminate\Http\Request;

class ParticipantsController extends Controller
{
    private $service;

    public function __construct(ParticipantService $participantService)
    {
        $this->service = $participantService;
    }

    public function index(): ParticipantResource
    {
        //return new ParticipantResource($this->service->pagedList());
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id): ParticipantResource
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
