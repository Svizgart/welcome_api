<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Pagination\LengthAwarePaginator;

final class EventService
{
    private $model;

    private const PAGINATION = 20;

    public function __construct()
    {
        $this->model = new Event;
    }

    public function pagedList(): LengthAwarePaginator
    {
        return $this->model::paginate(self::PAGINATION);
    }

    public function getEventBayId(int $id): ?Event
    {
        return $this->model::find($id);
    }
}
