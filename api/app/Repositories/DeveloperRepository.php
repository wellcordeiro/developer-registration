<?php

namespace App\Repositories;

use App\Models\Developer;

class DeveloperRepository
{
    private $developer;

    public function __construct(Developer $developer)
    {
        $this->developer = $developer;
    }

    public function getAll()
    {
        return $this->developer->all();
    }

    public function getDeveloperById(int $id): Developer
    {
        return $this->developer->findOrFail($id);
    }

    public function createNew(array $data)
    {
        return $this->developer->create($data);
    }

    public function update(int $id, array $data)
    {
        $developer = $this->developer->findOrFail($id);
        $developer->update($data);
        return $developer;
    }

    public function delete(int $id)
    {
        $developer = $this->getDeveloperById($id);

        return $developer->delete();
    }
}
