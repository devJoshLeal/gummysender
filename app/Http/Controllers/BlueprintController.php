<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blueprints;
use Inertia\Inertia;

class BlueprintController extends Controller
{
    public function show(Blueprints $blueprint)
    {
        $route="Blueprints/".$blueprint->title;
        return Inertia::render($route, [
            'template' => []
        ]);
    }
}
