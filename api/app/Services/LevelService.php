<?php

namespace App\Services;

use App\Models\Level;
use App\Repositories\LevelRepository;

class LevelService
{
    private LevelRepository $repository;

    public function __construct(LevelRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getLevels($request)
    {
        $search = $request->query('name');

        if (!empty($search)) {
            return $this->repository->searchByName($search);
        } else {
            return $this->repository->getAll();
        }
    }

    public function getLevelById(int $id)
    {
        return $this->repository->getLevelById($id);
    }

    public function createLevel(array $data): \App\Models\Level
    {
        return $this->repository->createNew($data);
    }

    public function updateLevel(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteLevel(Level $level)
    {
        if ($level->developers()->count() > 0) {
            return abort(409, 'You cannot remove a level while it is related to a developer. Please remove the developer first.');
        }

        return $this->repository->delete($level->id);
    }
}
