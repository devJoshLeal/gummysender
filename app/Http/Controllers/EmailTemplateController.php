<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use Inertia\Inertia;

class EmailTemplateController extends Controller
{
    public function index()
    {
        $templates = EmailTemplate::with('author')
            ->latest()
            ->get();

        return Inertia::render('EmailTemplates/Index', [
            'templates' => $templates
        ]);
    }

}
