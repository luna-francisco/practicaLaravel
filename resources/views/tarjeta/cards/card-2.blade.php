<x-tarjeta.base title="Catalogo de Estudiantes" subtitle="Listado rapido de estudiantes registrados.">
    <div class="space-y-4">
        @if (session('status'))
            <p class="rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-sm text-emerald-700">{{ session('status') }}</p>
        @endif

        @if ($errors->any())
            <div class="rounded-lg border border-rose-200 bg-rose-50 px-3 py-2 text-sm text-rose-700">
                <p class="font-semibold">Hay errores en el formulario.</p>
                <ul class="mt-1 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-wrap items-center justify-between gap-3">
            <p class="text-sm text-slate-600">Total: {{ $students->total() }} estudiantes</p>
            @can('manage-catalogs')
                <button class="btn-brand font-semibold" id="open-create-student-modal" type="button">Añadir estudiante</button>
            @endcan
        </div>

        <form method="GET" class="grid gap-3 md:grid-cols-[1.3fr_0.6fr_auto] items-end">
            <div class="field-stack">
                <label for="student-search" class="text-sm font-semibold text-slate-700">Buscar</label>
                <input id="student-search" name="q" type="text" value="{{ request('q') }}" class="pro-input w-full" placeholder="Nombre, email o DNI">
            </div>
            <div class="field-stack">
                <label for="student-year" class="text-sm font-semibold text-slate-700">Año</label>
                <select id="student-year" name="year" class="pro-input w-full">
                    <option value="">Todos</option>
                    @foreach (range(1, 6) as $year)
                        <option value="{{ $year }}" {{ (string) $year === (string) request('year') ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button class="btn-ghost-light btn-sm font-semibold" type="submit">Filtrar</button>
                @if (request()->query())
                    <a href="{{ route('tarjeta.show', 2) }}" class="btn-ghost-light btn-sm">Limpiar</a>
                @endif
            </div>
        </form>

        <div class="grid gap-3 md:grid-cols-2">
            @forelse ($students as $student)
                <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="h-12 w-12 rounded-full overflow-hidden bg-slate-100 flex items-center justify-center text-sm font-semibold text-slate-600">
                            @if ($student->photo_path)
                                <img src="{{ asset('storage/' . $student->photo_path) }}" alt="{{ $student->name }}" class="h-full w-full object-cover">
                            @else
                                {{ strtoupper(substr($student->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="flex-1">
                            <h2 class="font-semibold text-slate-900">{{ $student->name }}</h2>
                            <p class="mt-1 text-sm text-slate-600">{{ $student->email }}</p>
                            <p class="mt-2 text-xs text-slate-500">Año: {{ $student->year }} | DNI: {{ $student->dni }}</p>
                        </div>
                    </div>

                    @can('manage-catalogs')
                        <div class="mt-4 flex items-center gap-2">
                            <button
                                class="btn-ghost-light btn-sm font-semibold"
                                type="button"
                                data-edit-student-btn
                                data-id="{{ $student->id }}"
                                data-name="{{ $student->name }}"
                                data-email="{{ $student->email }}"
                                data-year="{{ $student->year }}"
                                data-dni="{{ $student->dni }}"
                            >
                                Editar
                            </button>

                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar este estudiante?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm border border-red-200 bg-red-50 text-red-700 hover:bg-red-100 hover:border-red-300 font-semibold" type="submit">Borrar</button>
                            </form>
                        </div>
                    @endcan
                </article>
            @empty
                <article class="rounded-xl border border-slate-200 bg-white p-5 text-slate-600 md:col-span-2">
                    No hay estudiantes para mostrar.
                </article>
            @endforelse
        </div>

        <div class="pt-2">
            {{ $students->links() }}
        </div>
    </div>

    @can('manage-catalogs')
        <div id="create-student-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 p-4">
            <div class="w-full max-w-lg rounded-2xl border border-slate-200 bg-white p-5 shadow-2xl">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="display-font text-xl font-bold text-slate-900">Nuevo estudiante</h3>
                    <button type="button" id="close-create-student-modal" class="btn-ghost-light btn-sm">Cerrar</button>
                </div>

                <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <div class="field-stack">
                        <label for="create-student-name" class="text-sm font-semibold text-slate-700">Nombre</label>
                        <input id="create-student-name" name="name" type="text" value="{{ old('name') }}" class="pro-input w-full" required>
                        @error('name')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field-stack">
                        <label for="create-student-email" class="text-sm font-semibold text-slate-700">Email</label>
                        <input id="create-student-email" name="email" type="email" value="{{ old('email') }}" class="pro-input w-full" required>
                        @error('email')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="field-stack">
                            <label for="create-student-year" class="text-sm font-semibold text-slate-700">Año</label>
                            <input id="create-student-year" name="year" type="number" min="1" max="6" value="{{ old('year', 1) }}" class="pro-input w-full" required>
                            @error('year')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field-stack">
                            <label for="create-student-dni" class="text-sm font-semibold text-slate-700">DNI</label>
                            <input id="create-student-dni" name="dni" type="text" value="{{ old('dni') }}" class="pro-input w-full" required>
                            @error('dni')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="field-stack">
                        <label for="create-student-photo" class="text-sm font-semibold text-slate-700">Foto (opcional)</label>
                        <input id="create-student-photo" name="photo" type="file" accept="image/*" class="pro-input w-full">
                        @error('photo')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-2">
                        <button type="button" id="cancel-create-student-modal" class="btn-ghost-light font-semibold">Cancelar</button>
                        <button type="submit" class="btn-brand font-semibold">Guardar estudiante</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="edit-student-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 p-4">
            <div class="w-full max-w-lg rounded-2xl border border-slate-200 bg-white p-5 shadow-2xl">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="display-font text-xl font-bold text-slate-900">Editar estudiante</h3>
                    <button type="button" id="close-edit-student-modal" class="btn-ghost-light btn-sm">Cerrar</button>
                </div>

                <form id="edit-student-form" action="" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-student-id" name="_edit_student_id" value="">

                    <div class="field-stack">
                        <label for="edit-student-name" class="text-sm font-semibold text-slate-700">Nombre</label>
                        <input id="edit-student-name" name="name" type="text" value="" class="pro-input w-full" required>
                        @error('name')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field-stack">
                        <label for="edit-student-email" class="text-sm font-semibold text-slate-700">Email</label>
                        <input id="edit-student-email" name="email" type="email" value="" class="pro-input w-full" required>
                        @error('email')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="field-stack">
                            <label for="edit-student-year" class="text-sm font-semibold text-slate-700">Año</label>
                            <input id="edit-student-year" name="year" type="number" min="1" max="6" value="" class="pro-input w-full" required>
                            @error('year')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field-stack">
                            <label for="edit-student-dni" class="text-sm font-semibold text-slate-700">DNI</label>
                            <input id="edit-student-dni" name="dni" type="text" value="" class="pro-input w-full" required>
                            @error('dni')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="field-stack">
                        <label for="edit-student-photo" class="text-sm font-semibold text-slate-700">Actualizar foto (opcional)</label>
                        <input id="edit-student-photo" name="photo" type="file" accept="image/*" class="pro-input w-full">
                        <p class="text-xs text-slate-500">Si no subes una foto, se mantiene la actual.</p>
                        @error('photo')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-2">
                        <button type="button" id="cancel-edit-student-modal" class="btn-ghost-light font-semibold">Cancelar</button>
                        <button type="submit" class="btn-brand font-semibold">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    @endcan

    <script>
        (() => {
            const createModal = document.getElementById('create-student-modal');
            const openCreateBtn = document.getElementById('open-create-student-modal');
            const closeCreateBtn = document.getElementById('close-create-student-modal');
            const cancelCreateBtn = document.getElementById('cancel-create-student-modal');

            const editModal = document.getElementById('edit-student-modal');
            const closeEditBtn = document.getElementById('close-edit-student-modal');
            const cancelEditBtn = document.getElementById('cancel-edit-student-modal');
            const editForm = document.getElementById('edit-student-form');
            const editIdInput = document.getElementById('edit-student-id');
            const editNameInput = document.getElementById('edit-student-name');
            const editEmailInput = document.getElementById('edit-student-email');
            const editYearInput = document.getElementById('edit-student-year');
            const editDniInput = document.getElementById('edit-student-dni');
            const updateUrlTemplate = @json(route('students.update', '__ID__'));

            if (!createModal || !openCreateBtn || !editModal || !editForm) return;

            const openCreateModal = () => {
                createModal.classList.remove('hidden');
                createModal.classList.add('flex');
            };

            const closeCreateModal = () => {
                createModal.classList.remove('flex');
                createModal.classList.add('hidden');
            };

            const openEditModal = (student) => {
                editForm.action = updateUrlTemplate.replace('__ID__', String(student.id));
                editIdInput.value = student.id;
                editNameInput.value = student.name ?? '';
                editEmailInput.value = student.email ?? '';
                editYearInput.value = student.year ?? '';
                editDniInput.value = student.dni ?? '';

                editModal.classList.remove('hidden');
                editModal.classList.add('flex');
            };

            const closeEditModal = () => {
                editModal.classList.remove('flex');
                editModal.classList.add('hidden');
            };

            openCreateBtn.addEventListener('click', openCreateModal);
            closeCreateBtn?.addEventListener('click', closeCreateModal);
            cancelCreateBtn?.addEventListener('click', closeCreateModal);

            closeEditBtn?.addEventListener('click', closeEditModal);
            cancelEditBtn?.addEventListener('click', closeEditModal);

            createModal.addEventListener('click', (event) => {
                if (event.target === createModal) {
                    closeCreateModal();
                }
            });

            editModal.addEventListener('click', (event) => {
                if (event.target === editModal) {
                    closeEditModal();
                }
            });

            document.querySelectorAll('[data-edit-student-btn]').forEach((button) => {
                button.addEventListener('click', () => {
                    openEditModal({
                        id: button.dataset.id,
                        name: button.dataset.name,
                        email: button.dataset.email,
                        year: button.dataset.year,
                        dni: button.dataset.dni,
                    });
                });
            });

            const oldEditStudentId = @json(old('_edit_student_id'));
            if (@json($errors->any())) {
                if (oldEditStudentId) {
                    openEditModal({
                        id: oldEditStudentId,
                        name: @json(old('name')),
                        email: @json(old('email')),
                        year: @json(old('year')),
                        dni: @json(old('dni')),
                    });
                } else {
                    openCreateModal();
                }
            }
        })();
    </script>
</x-tarjeta.base>
