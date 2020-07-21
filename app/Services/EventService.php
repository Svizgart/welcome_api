<?php

namespace App\Services;

use App\Models\Event;

final class EventService
{
    private $model;

    public function __construct()
    {
        $this->model = new Event;
    }

    public function issetEvent(int $id): bool
    {
        if (is_null($this->model::find($id))) {
            return false;
        }

        return true;
    }
}
