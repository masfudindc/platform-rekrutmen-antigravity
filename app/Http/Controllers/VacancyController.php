<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\Department;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = Vacancy::with('department')->latest()->get();
        return view('admin.vacancies.index', compact('vacancies'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.vacancies.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'posisi' => 'required|string|max:255',
            'quota' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
        ]);

        Vacancy::create($request->all());

        return redirect()->route('admin.vacancies.index')->with('success', 'Vacancy created successfully.');
    }

    public function edit(Vacancy $vacancy)
    {
        $departments = Department::all();
        return view('admin.vacancies.edit', compact('vacancy', 'departments'));
    }

    public function update(Request $request, Vacancy $vacancy)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'posisi' => 'required|string|max:255',
            'quota' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
        ]);

        $vacancy->update($request->all());

        return redirect()->route('admin.vacancies.index')->with('success', 'Vacancy updated successfully.');
    }

    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();
        return redirect()->route('admin.vacancies.index')->with('success', 'Vacancy deleted successfully.');
    }
}
