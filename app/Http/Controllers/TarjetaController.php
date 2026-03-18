<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Student;
use App\Models\Teacher;

class TarjetaController extends Controller
{
    public function show(Request $request, int $id)
    {
        return match ($id) {
            1 => $this->projectCatalog($request),
            2 => $this->studentCatalog($request),
            3 => $this->teacherCatalog($request),
            default => abort(404),
        };
    }

    private function projectCatalog(Request $request)
    {
        $query = Project::query()
            ->select(['id', 'name', 'description', 'hours', 'start_date', 'image_path'])
            ->orderByDesc('id');

        $search = trim((string) $request->query('q', ''));
        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $minHours = $request->query('min_hours');
        if ($minHours !== null && $minHours !== '') {
            $query->where('hours', '>=', (int) $minHours);
        }

        $maxHours = $request->query('max_hours');
        if ($maxHours !== null && $maxHours !== '') {
            $query->where('hours', '<=', (int) $maxHours);
        }

        $projects = $query->paginate(8)->withQueryString();

        return view('tarjeta.cards.catalog', compact('projects'));
    }

    private function studentCatalog(Request $request)
    {
        $query = Student::query()
            ->select(['id', 'name', 'year', 'email', 'dni', 'photo_path'])
            ->orderByDesc('id');

        $search = trim((string) $request->query('q', ''));
        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('dni', 'like', "%{$search}%");
            });
        }

        $year = $request->query('year');
        if ($year !== null && $year !== '') {
            $query->where('year', (int) $year);
        }

        $students = $query->paginate(8)->withQueryString();

        return view('tarjeta.cards.card-2', compact('students'));
    }

    private function teacherCatalog(Request $request)
    {
        $query = Teacher::query()
            ->select(['id', 'name', 'departament', 'email', 'phone', 'photo_path'])
            ->orderByDesc('id');

        $search = trim((string) $request->query('q', ''));
        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $departament = $request->query('departament');
        if ($departament !== null && $departament !== '') {
            $query->where('departament', $departament);
        }

        $teachers = $query->paginate(8)->withQueryString();

        return view('tarjeta.cards.card-3', compact('teachers'));
    }
}
