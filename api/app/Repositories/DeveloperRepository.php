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
        return $this->developer->paginate(15);
    }

    public function searchByName($name)
    {
        return $this->developer->where('name', 'like', "%{$name}%")
            ->orWhere('email', 'like', "%{$name}%")
            ->paginate(20);
    }

    public function searchByLevel($level_id)
    {
        return $this->developer->where('level_id', $level_id)->paginate(20);
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
