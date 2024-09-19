<?php

namespace Src\Booking\Domain;

interface BookingRepositoryInterface
{
    public function find(int $id): ?Booking;
    public function create(array $data): Booking;
    public function cancel(int $id): bool;
}
