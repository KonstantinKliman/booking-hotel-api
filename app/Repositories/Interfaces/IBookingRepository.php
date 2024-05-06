<?php

namespace App\Repositories\Interfaces;

interface IBookingRepository
{
    public function create(array $data);

    public function getById(int $id);

    public function update(array $data, int $id);

    public function all();

    public function getForCustomer(int $userId);

    public function delete(int $id);

    public function getForOwner(int $userId);
}
