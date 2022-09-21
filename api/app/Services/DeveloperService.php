<?php

namespace App\Services;

use App\Repositories\DeveloperRepository;
use Illuminate\Http\Request;

class DeveloperService
{
    private DeveloperRepository $repository;

    public function __construct(DeveloperRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getDevelopers()
    {
        return $this->repository->getAll();
    }

    public function getDeveloperById(int $id)
    {
        return $this->repository->getDeveloperById($id);
    }

    public function createDeveloper(array $data): \App\Models\Developer
    {
        return $this->repository->createNew($data);
    }

    public function updateDeveloper(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteDeveloper(int $id)
    {
        return $this->repository->delete($id);
    }

}
