<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blueprints;
use Inertia\Inertia;

class BlueprintController extends Controller
{
    public function show(Blueprints $blueprint)
    {
        // 1. Ruta al archivo HTML del blueprint
        $path = resource_path("blueprints/{$blueprint->title}.html");

        if (!file_exists($path)) {
            abort(404, 'Blueprint HTML not found');
        }

        // 2. Leer HTML base
        $html = file_get_contents($path);

        // 3. Datos placeholder (por ahora estáticos)
        $template = [
            "title" => "Template Title",
            "subject" => "Template Subject",
            "content" => [
                [
                    "title" => "Content Box Title????",
                    "body" => "Content HTML Body"
                ]
            ]
        ];

        // 4. Reemplazar placeholders (simple y poderoso)
        $html = str_replace('{{title}}', $template['title'], $html);
        $html = str_replace('{{subject}}', $template['subject'], $html);
        $html = str_replace('{{content_title}}', $template['content'][0]['title'], $html);
        $html = str_replace('{{content_body}}', $template['content'][0]['body'], $html);

        return Inertia::render('Blueprints/Show', [
            'html' => $html,
            'template' => $template,
            'blueprint' => $blueprint->title
        ]);
    }
}
