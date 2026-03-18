<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Student;
use App\Models\Teacher;

class TarjetaController extends Controller
{
    public function show(int $id)
    {
        return match ($id) {
            1 => $this->projectCatalog(),
            2 => $this->studentCatalog(),
            3 => $this->teacherCatalog(),
            default => abort(404),
        };
    }

    private function projectCatalog()
    {
        $projects = Project::query()
            ->select(['id', 'name', 'description', 'hours', 'start_date'])
            ->orderByDesc('id')
            ->get();

        return view('tarjeta.cards.catalog', compact('projects'));
    }

    private function studentCatalog()
    {
        $students = Student::query()
            ->select(['id', 'name', 'year', 'email', 'dni'])
            ->orderByDesc('id')
            ->get();

        return view('tarjeta.cards.card-2', compact('students'));
    }

    private function teacherCatalog()
    {
        $teachers = Teacher::query()
            ->select(['id', 'name', 'departament', 'email', 'phone'])
            ->orderByDesc('id')
            ->get();

        return view('tarjeta.cards.card-3', compact('teachers'));
    }
}
