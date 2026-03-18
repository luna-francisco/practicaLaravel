<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();

        if (array_key_exists('photo', $data)) {
            unset($data['photo']);
        }

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('students', 'public');
        }

        Student::create($data);

        return redirect()
            ->route('tarjeta.show', 2)
            ->with('status', 'Estudiante creado correctamente.');
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->validated();

        if (array_key_exists('photo', $data)) {
            unset($data['photo']);
        }

        if ($request->hasFile('photo')) {
            if ($student->photo_path) {
                Storage::disk('public')->delete($student->photo_path);
            }

            $data['photo_path'] = $request->file('photo')->store('students', 'public');
        }

        $student->update($data);

        return redirect()
            ->route('tarjeta.show', 2)
            ->with('status', 'Estudiante actualizado correctamente.');
    }

    public function destroy(Student $student)
    {
        if ($student->photo_path) {
            Storage::disk('public')->delete($student->photo_path);
        }

        $student->delete();

        return redirect()
            ->back()
            ->with('status', 'Estudiante eliminado correctamente.');
    }
}
