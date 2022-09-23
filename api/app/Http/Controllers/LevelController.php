<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateLevel;
use App\Http\Resources\LevelResource;
use App\Models\Level;
use App\Services\LevelService;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    protected LevelService $levelService;

    public function __construct(LevelService $levelService)
    {
        $this->levelService = $levelService;
    }

    public function index(Request $request)
    {
        $level = $this->levelService->getLevels($request);

        return LevelResource::collection($level);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateLevel $request): LevelResource
    {
        $level = $this->levelService->createLevel($request->validated());
        return new LevelResource($level);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return LevelResource|\Illuminate\Http\JsonResponse
     */

    public function show($id)
    {
        if (!is_numeric($id)) {
            return abort(400, 'Invalid type for parameter id.');
        }

        $level = $this->levelService->getLevelById($id);
        return new LevelResource($level);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return LevelResource|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(StoreUpdateLevel $request, $id)
    {
        if (!is_numeric($id)) {
            return abort(400, 'Invalid type for parameter id.');
        }

        $level = $this->levelService->updateLevel($id, $request->validated());
        return new LevelResource($level);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Level $level
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        $this->levelService->deleteLevel($level);
        return response()->json([], 204);
    }
}
