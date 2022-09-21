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

    public function getDeveloperById(int $id)
    {
        return $this->developer->findOrFail($id);
    }

    public function createNew(array $data)
    {
        return $this->developer->create($data);
    }

    public function find(int $id)
    {
        return $this->developer->findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $developer = $this->developer->findOrFail($id);
        $developer->update($data);
        return $developer;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        $developer = $this->developer->findOrFail($id);
        return $developer->delete();
    }
}
