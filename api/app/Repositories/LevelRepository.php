<?php

namespace App\Repositories;

use App\Models\Level;

class LevelRepository
{
    private $level;

    public function __construct(Level $level)
    {
        $this->level = $level;
    }

    public function getAll()
    {
        return $this->level->paginate(15);
    }

    public function searchByName(string $name)
    {
        return $this->level->where('name', 'like', "%{$name}%")->paginate(20);
    }

    public function getLevelById(int $id)
    {
        return $this->level->findOrFail($id);
    }

    public function createNew(array $data)
    {
        return $this->level->create($data);
    }

    public function update(int $id, array $data)
    {
        $level = $this->level->findOrFail($id);
        $level->update($data);

        return $level;
    }

    public function delete(int $id)
    {
        $level = $this->getLevelById($id);

        return $level->delete();
    }
}
