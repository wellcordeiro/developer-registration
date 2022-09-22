<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateDeveloper;
use App\Http\Resources\DeveloperResource;
use App\Services\DeveloperService;


class DeveloperController extends Controller
{
    protected DeveloperService $developerService;

    public function __construct(DeveloperService $developerService)
    {
        $this->developerService = $developerService;
    }

    public function index()
    {
        $developers = $this->developerService->getDevelopers();

        return DeveloperResource::collection($developers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateDeveloper $request): DeveloperResource
    {
        $developer = $this->developerService->createDeveloper($request->validated());
        return new DeveloperResource($developer);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return DeveloperResource|\Illuminate\Http\JsonResponse
     */

    public function show($id)
    {
        if (!is_numeric($id)) {
            return abort(400, 'Invalid type for parameter id.');
        }

        $developer = $this->developerService->getDeveloperById($id);
        return new DeveloperResource($developer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return DeveloperResource|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(StoreUpdateDeveloper $request, $id)
    {
        if (!is_numeric($id)) {
            return abort(400, 'Invalid type for parameter id.');
        }

        $developer = $this->developerService->updateDeveloper($id, $request->validated());
        return new DeveloperResource($developer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (!is_numeric($id)) {
            return abort(400, 'Invalid type for parameter id.');
        }

        $this->developerService->deleteDeveloper($id);
        return response()->json([], 204);
    }
}
