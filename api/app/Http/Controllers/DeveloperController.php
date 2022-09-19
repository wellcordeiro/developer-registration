<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Developer;
use App\Http\Resources\DeveloperResource;

class DeveloperController extends Controller
{
    public function index()
    {
        $developers = Developer::all();
        return DeveloperResource::collection($developers);
    }

    public function store(Request $request)
    {
        $developer = Developer::create($request->all());
        return new DeveloperResource($developer);
    }

    public function show(Developer $developer)
    {
        return new DeveloperResource($developer);
    }

    public function update(Request $request, Developer $developer)
    {
        $developer->update($request->all());
        return new DeveloperResource($developer);
    }

    public function destroy(Developer $developer)
    {
        $developer->delete();
        return response()->json(null, 204);
    }
}
