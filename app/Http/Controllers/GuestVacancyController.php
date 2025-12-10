<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class GuestVacancyController extends Controller
{
    public function index()
    {
        $vacancies = Vacancy::with('department')->where('quota', '>', 0)->latest()->get();
        return view('vacancies.index', compact('vacancies'));
    }

    public function show(Vacancy $vacancy)
    {
        return view('vacancies.show', compact('vacancy'));
    }
}
