<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Developer;
use App\Http\Resources\DeveloperResource;
use App\Models\Level;
use Illuminate\Support\Facades\DB;

class DeveloperController extends Controller
{
    public function index(Request $request)
    {
        $developers = Developer::all();

        //query for search by name
        if ($request->filled('name')) {
            $developers = $developers->where('name', 'like', "%{$request->query('name')}%");
        }
        //create paginate
        $developers = $developers->paginate(20);
        return DeveloperResource::collection($developers);
    }

    public function store(Request $request)
    {
        $developer = Developer::create($request->only(['name', 'level_id', 'gender', 'birthdate', 'hobby']));
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
