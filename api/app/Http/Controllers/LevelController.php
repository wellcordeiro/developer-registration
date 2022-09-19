<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Http\Resources\LevelResource;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::all();
        return response()->json($levels);
    }

    public function store(Request $request)
    {
        $level = Level::create($request->all());
        return response()->json($level);
    }

    public function show(Level $level)
    {
        return response()->json($level);
    }

    public function update(Request $request, Level $level)
    {
        $level->update($request->all());
        return response()->json($level);
    }

    public function destroy(Level $level)
    {
        $level->delete();
        return response()->json(null, 204);
    }

}
