<?php

namespace App\Repositories\Interfaces;

interface IRoomRepository
{
    public function create(array $data);

    public function getById(int $id);

    public function update(array $data, int $id);

    public function delete(int $id);
}
