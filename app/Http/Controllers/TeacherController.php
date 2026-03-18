<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function store(StoreTeacherRequest $request)
    {
        Teacher::create($request->validated());

        return redirect()
            ->route('tarjeta.show', 3)
            ->with('status', 'Profesor creado correctamente.');
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->validated());

        return redirect()
            ->route('tarjeta.show', 3)
            ->with('status', 'Profesor actualizado correctamente.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()
            ->back()
            ->with('status', 'Profesor eliminado correctamente.');
    }
}
