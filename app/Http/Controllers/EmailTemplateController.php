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
        ->get()
        ->map(function ($template) {
            return [
                'id' => $template->id,
                'title' => $template->title,
                'subject' => $template->subject,
                'author' => [
                    'name' => $template->author?->name
                ],
            ];
        });
        return Inertia::render('EmailTemplates/Index', [
            'templates' => $templates
        ]);
    }

    public function create()
    {
       return Inertia::render('EmailTemplates/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content_html' => 'required|string',
        ]);

        EmailTemplate::create([
            ...$validated,
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('email-templates.index')
            ->with('success', 'Template created successfully.');
    }
    public function show(EmailTemplate $emailTemplate)
    {
        return Inertia::render('EmailTemplates/Show', [
            'template' => $emailTemplate
        ]);
    }

}
