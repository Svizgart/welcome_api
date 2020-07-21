<?php

namespace App\Services;

use App\Models\Participant;
use Illuminate\Pagination\LengthAwarePaginator;
use phpDocumentor\Reflection\Types\Self_;

final class ParticipantService
{
    private $model;

    private const PAGINATION = 20;

    public function __construct()
    {
        $this->model = new Participant;
    }

    public function pagedList(): LengthAwarePaginator
    {
        return $this->model::paginate(self::PAGINATION);
    }
}
