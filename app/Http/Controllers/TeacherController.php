<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function store(StoreTeacherRequest $request)
    {
        $data = $request->validated();

        if (array_key_exists('photo', $data)) {
            unset($data['photo']);
        }

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('teachers', 'public');
        }

        Teacher::create($data);

        return redirect()
            ->route('tarjeta.show', 3)
            ->with('status', 'Profesor creado correctamente.');
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $data = $request->validated();

        if (array_key_exists('photo', $data)) {
            unset($data['photo']);
        }

        if ($request->hasFile('photo')) {
            if ($teacher->photo_path) {
                Storage::disk('public')->delete($teacher->photo_path);
            }

            $data['photo_path'] = $request->file('photo')->store('teachers', 'public');
        }

        $teacher->update($data);

        return redirect()
            ->route('tarjeta.show', 3)
            ->with('status', 'Profesor actualizado correctamente.');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->photo_path) {
            Storage::disk('public')->delete($teacher->photo_path);
        }

        $teacher->delete();

        return redirect()
            ->back()
            ->with('status', 'Profesor eliminado correctamente.');
    }
}
