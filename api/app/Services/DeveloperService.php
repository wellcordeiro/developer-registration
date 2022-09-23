<?php

namespace App\Services;

use App\Repositories\DeveloperRepository;

class DeveloperService
{
    private DeveloperRepository $repository;

    public function __construct(DeveloperRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getDevelopers($search)
    {
        if ($search->query('level_id')) {
            $developers = $this->repository->searchByLevel($search->query('level_id'));
        } else if ($search->query('name')) {
            $developers = $this->repository->searchByName($search->query('name'));
        } else {
            $developers = $this->repository->getAll();
        }

        return $developers;
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
