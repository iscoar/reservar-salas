<?php

namespace Src\MeetingRoom\Domain;

use Illuminate\Database\Eloquent\Collection;

interface MeetingRoomRepositoryInterface
{
    public function findAll(): Collection;
    public function find(int $id): ?MeetingRoom;
    public function create(array $data): MeetingRoom;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
