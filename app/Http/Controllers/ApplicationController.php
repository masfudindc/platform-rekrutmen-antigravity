<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // Guest methods
    public function create(Vacancy $vacancy)
    {
        // Check if already applied? Optional.
        return view('vacancies.apply', compact('vacancy'));
    }

    public function store(Request $request, Vacancy $vacancy)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        Application::create([
            'vacancy_id' => $vacancy->id,
            'user_id' => Auth::id(), // Assuming logged in
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'status' => 'P',
        ]);

        return redirect()->route('vacancies.index')->with('success', 'Application submitted successfully.');
    }

    // Admin methods
    public function index()
    {
        $applications = Application::with(['vacancy', 'user'])->latest()->get();
        return view('admin.applications.index', compact('applications'));
    }

    public function approve(Application $application)
    {
        $application->update(['status' => 'A']);
        return redirect()->back()->with('success', 'Application approved.');
    }

    public function reject(Application $application)
    {
        $application->update(['status' => 'R']);
        return redirect()->back()->with('success', 'Application rejected.');
    }
    
    public function reports()
    {
        // Summary per department
        // We need: Department Name | Count of Applications
        $applicationsByDept = \App\Models\Department::withCount(['vacancies as applications_count' => function ($query) {
            $query->join('applications', 'vacancies.id', '=', 'applications.vacancy_id');
        }])->get();

        // Status summary
        $statusSummary = Application::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->get();

        return view('admin.reports.index', compact('applicationsByDept', 'statusSummary'));
    }
}
