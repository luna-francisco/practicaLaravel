<x-tarjeta.base title="Catalogo de Profesores" subtitle="Listado rapido de profesores registrados.">
    @php
        $departments = [
            'Informática',
            'Electricidad y Electrónica',
            'Administración y Gestión',
            'Comercio y Marketing',
            'Sanidad',
            'Servicios Socioculturales y a la Comunidad',
            'Hostelería y Turismo',
            'Mantenimiento de Vehículos',
            'Instalación y Mantenimiento',
            'Fabricación Mecánica',
            'Edificación y Obra Civil',
            'Imagen Personal',
            'Agraria',
            'Industrias Alimentarias',
            'Artes Gráficas',
            'Orientación',
            'FOL (Formación y Orientación Laboral)',
        ];
    @endphp

    <div class="space-y-4">
        @if (session('status'))
            <p class="rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-sm text-emerald-700">{{ session('status') }}</p>
        @endif

        <div class="flex items-center justify-between">
            <p class="text-sm text-slate-600">Total: {{ $teachers->count() }} profesores</p>
            <button class="btn-brand font-semibold" id="open-create-teacher-modal" type="button">Añadir profesor</button>
        </div>

        <div class="grid gap-3 md:grid-cols-2">
            @forelse ($teachers as $teacher)
                <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                    <h2 class="font-semibold text-slate-900">{{ $teacher->name }}</h2>
                    <p class="mt-1 text-sm text-slate-600">{{ $teacher->email }}</p>
                    <p class="mt-2 text-xs text-slate-500">Departamento: {{ $teacher->departament }} | Telefono: {{ $teacher->phone }}</p>

                    <div class="mt-4 flex items-center gap-2">
                        <button
                            class="btn-ghost-light btn-sm font-semibold"
                            type="button"
                            data-edit-teacher-btn
                            data-id="{{ $teacher->id }}"
                            data-name="{{ $teacher->name }}"
                            data-departament="{{ $teacher->departament }}"
                            data-email="{{ $teacher->email }}"
                            data-phone="{{ $teacher->phone }}"
                        >
                            Editar
                        </button>

                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar este profesor?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm border border-red-200 bg-red-50 text-red-700 hover:bg-red-100 hover:border-red-300 font-semibold" type="submit">Borrar</button>
                        </form>
                    </div>
                </article>
            @empty
                <article class="rounded-xl border border-slate-200 bg-white p-5 text-slate-600 md:col-span-2">
                    No hay profesores para mostrar.
                </article>
            @endforelse
        </div>
    </div>

    <div id="create-teacher-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 p-4">
        <div class="w-full max-w-lg rounded-2xl border border-slate-200 bg-white p-5 shadow-2xl">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="display-font text-xl font-bold text-slate-900">Nuevo profesor</h3>
                <button type="button" id="close-create-teacher-modal" class="btn-ghost-light btn-sm">Cerrar</button>
            </div>

            <form action="{{ route('teachers.store') }}" method="POST" class="space-y-3">
                @csrf
                <div class="field-stack">
                    <label for="create-teacher-name" class="text-sm font-semibold text-slate-700">Nombre</label>
                    <input id="create-teacher-name" name="name" type="text" value="{{ old('name') }}" class="pro-input w-full" required>
                    @error('name')
                        <p class="text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-stack">
                    <label for="create-teacher-email" class="text-sm font-semibold text-slate-700">Email</label>
                    <input id="create-teacher-email" name="email" type="email" value="{{ old('email') }}" class="pro-input w-full" required>
                    @error('email')
                        <p class="text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="field-stack">
                        <label for="create-teacher-departament" class="text-sm font-semibold text-slate-700">Departamento</label>
                        <select id="create-teacher-departament" name="departament" class="pro-input w-full" required>
                            <option value="" disabled {{ old('departament') ? '' : 'selected' }}>Selecciona un departamento</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department }}" {{ old('departament') === $department ? 'selected' : '' }}>
                                    {{ $department }}
                                </option>
                            @endforeach
                        </select>
                        @error('departament')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field-stack">
                        <label for="create-teacher-phone" class="text-sm font-semibold text-slate-700">Telefono</label>
                        <input id="create-teacher-phone" name="phone" type="text" value="{{ old('phone') }}" class="pro-input w-full" required>
                        @error('phone')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-2 flex items-center justify-end gap-2">
                    <button type="button" id="cancel-create-teacher-modal" class="btn-ghost-light font-semibold">Cancelar</button>
                    <button type="submit" class="btn-brand font-semibold">Guardar profesor</button>
                </div>
            </form>
        </div>
    </div>

    <div id="edit-teacher-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 p-4">
        <div class="w-full max-w-lg rounded-2xl border border-slate-200 bg-white p-5 shadow-2xl">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="display-font text-xl font-bold text-slate-900">Editar profesor</h3>
                <button type="button" id="close-edit-teacher-modal" class="btn-ghost-light btn-sm">Cerrar</button>
            </div>

            <form id="edit-teacher-form" action="" method="POST" class="space-y-3">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit-teacher-id" name="_edit_teacher_id" value="">

                <div class="field-stack">
                    <label for="edit-teacher-name" class="text-sm font-semibold text-slate-700">Nombre</label>
                    <input id="edit-teacher-name" name="name" type="text" value="" class="pro-input w-full" required>
                    @error('name')
                        <p class="text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-stack">
                    <label for="edit-teacher-email" class="text-sm font-semibold text-slate-700">Email</label>
                    <input id="edit-teacher-email" name="email" type="email" value="" class="pro-input w-full" required>
                    @error('email')
                        <p class="text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="field-stack">
                        <label for="edit-teacher-departament" class="text-sm font-semibold text-slate-700">Departamento</label>
                        <select id="edit-teacher-departament" name="departament" class="pro-input w-full" required>
                            <option value="" disabled>Selecciona un departamento</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department }}">{{ $department }}</option>
                            @endforeach
                        </select>
                        @error('departament')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field-stack">
                        <label for="edit-teacher-phone" class="text-sm font-semibold text-slate-700">Telefono</label>
                        <input id="edit-teacher-phone" name="phone" type="text" value="" class="pro-input w-full" required>
                        @error('phone')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-2 flex items-center justify-end gap-2">
                    <button type="button" id="cancel-edit-teacher-modal" class="btn-ghost-light font-semibold">Cancelar</button>
                    <button type="submit" class="btn-brand font-semibold">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (() => {
            const createModal = document.getElementById('create-teacher-modal');
            const openCreateBtn = document.getElementById('open-create-teacher-modal');
            const closeCreateBtn = document.getElementById('close-create-teacher-modal');
            const cancelCreateBtn = document.getElementById('cancel-create-teacher-modal');

            const editModal = document.getElementById('edit-teacher-modal');
            const closeEditBtn = document.getElementById('close-edit-teacher-modal');
            const cancelEditBtn = document.getElementById('cancel-edit-teacher-modal');
            const editForm = document.getElementById('edit-teacher-form');
            const editIdInput = document.getElementById('edit-teacher-id');
            const editNameInput = document.getElementById('edit-teacher-name');
            const editEmailInput = document.getElementById('edit-teacher-email');
            const editDepartamentInput = document.getElementById('edit-teacher-departament');
            const editPhoneInput = document.getElementById('edit-teacher-phone');
            const updateUrlTemplate = @json(route('teachers.update', '__ID__'));

            if (!createModal || !openCreateBtn || !editModal || !editForm) return;

            const openCreateModal = () => {
                createModal.classList.remove('hidden');
                createModal.classList.add('flex');
            };

            const closeCreateModal = () => {
                createModal.classList.remove('flex');
                createModal.classList.add('hidden');
            };

            const openEditModal = (teacher) => {
                editForm.action = updateUrlTemplate.replace('__ID__', String(teacher.id));
                editIdInput.value = teacher.id;
                editNameInput.value = teacher.name ?? '';
                editEmailInput.value = teacher.email ?? '';
                editDepartamentInput.value = teacher.departament ?? '';
                editPhoneInput.value = teacher.phone ?? '';

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

            document.querySelectorAll('[data-edit-teacher-btn]').forEach((button) => {
                button.addEventListener('click', () => {
                    openEditModal({
                        id: button.dataset.id,
                        name: button.dataset.name,
                        departament: button.dataset.departament,
                        email: button.dataset.email,
                        phone: button.dataset.phone,
                    });
                });
            });

            const oldEditTeacherId = @json(old('_edit_teacher_id'));
            if (@json($errors->any())) {
                if (oldEditTeacherId) {
                    openEditModal({
                        id: oldEditTeacherId,
                        name: @json(old('name')),
                        departament: @json(old('departament')),
                        email: @json(old('email')),
                        phone: @json(old('phone')),
                    });
                } else {
                    openCreateModal();
                }
            }
        })();
    </script>
</x-tarjeta.base>
