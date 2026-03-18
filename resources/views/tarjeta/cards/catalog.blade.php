<x-tarjeta.base title="Catalogo de Proyectos" subtitle="Listado rapido de proyectos disponibles.">
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
            <p class="text-sm text-slate-600">Total: {{ $projects->total() }} proyectos</p>
            @can('manage-catalogs')
                <button class="btn-brand font-semibold" id="open-create-project-modal" type="button">Añadir proyecto</button>
            @endcan
        </div>

        <form method="GET" class="grid gap-3 md:grid-cols-[1.3fr_repeat(2,0.6fr)_auto] items-end">
            <div class="field-stack">
                <label for="project-search" class="text-sm font-semibold text-slate-700">Buscar</label>
                <input id="project-search" name="q" type="text" value="{{ request('q') }}" class="pro-input w-full" placeholder="Nombre o descripcion">
            </div>
            <div class="field-stack">
                <label for="project-min-hours" class="text-sm font-semibold text-slate-700">Horas min</label>
                <input id="project-min-hours" name="min_hours" type="number" min="1" value="{{ request('min_hours') }}" class="pro-input w-full">
            </div>
            <div class="field-stack">
                <label for="project-max-hours" class="text-sm font-semibold text-slate-700">Horas max</label>
                <input id="project-max-hours" name="max_hours" type="number" min="1" value="{{ request('max_hours') }}" class="pro-input w-full">
            </div>
            <div class="flex gap-2">
                <button class="btn-ghost-light btn-sm font-semibold" type="submit">Filtrar</button>
                @if (request()->query())
                    <a href="{{ route('tarjeta.show', 1) }}" class="btn-ghost-light btn-sm">Limpiar</a>
                @endif
            </div>
        </form>

        <div class="grid gap-3 md:grid-cols-2">
            @forelse ($projects as $project)
                <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="h-14 w-20 overflow-hidden rounded-lg bg-slate-100 text-xs text-slate-500 flex items-center justify-center">
                            @if ($project->image_path)
                                <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->name }}" class="h-full w-full object-cover">
                            @else
                                Sin imagen
                            @endif
                        </div>
                        <div class="flex-1">
                            <h2 class="font-semibold text-slate-900">{{ $project->name }}</h2>
                            <p class="mt-1 text-sm text-slate-600">{{ $project->description }}</p>
                            <p class="mt-2 text-xs text-slate-500">Horas: {{ $project->hours }} | Inicio: {{ $project->start_date ?? 'N/D' }}</p>
                        </div>
                    </div>

                    @can('manage-catalogs')
                        <div class="mt-4 flex items-center gap-2">
                            <button
                                class="btn-ghost-light btn-sm font-semibold"
                                type="button"
                                data-edit-project-btn
                                data-id="{{ $project->id }}"
                                data-name="{{ $project->name }}"
                                data-description="{{ $project->description }}"
                                data-hours="{{ $project->hours }}"
                                data-start-date="{{ $project->start_date ?? '' }}"
                            >
                                Editar
                            </button>

                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar este proyecto?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm border border-red-200 bg-red-50 text-red-700 hover:bg-red-100 hover:border-red-300 font-semibold" type="submit">Borrar</button>
                            </form>
                        </div>
                    @endcan
                </article>
            @empty
                <article class="rounded-xl border border-slate-200 bg-white p-5 text-slate-600 md:col-span-2">
                    No hay proyectos para mostrar.
                </article>
            @endforelse
        </div>

        <div class="pt-2">
            {{ $projects->links() }}
        </div>
    </div>

    @can('manage-catalogs')
        <div id="create-project-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 p-4">
            <div class="w-full max-w-lg rounded-2xl border border-slate-200 bg-white p-5 shadow-2xl">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="display-font text-xl font-bold text-slate-900">Nuevo proyecto</h3>
                    <button type="button" id="close-create-project-modal" class="btn-ghost-light btn-sm">Cerrar</button>
                </div>

                <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <div class="field-stack">
                        <label for="create-name" class="text-sm font-semibold text-slate-700">Nombre</label>
                        <input id="create-name" name="name" type="text" value="{{ old('name') }}" class="pro-input w-full" required>
                        @error('name')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field-stack">
                        <label for="create-description" class="text-sm font-semibold text-slate-700">Descripcion</label>
                        <input id="create-description" name="description" type="text" value="{{ old('description') }}" class="pro-input w-full" required>
                        @error('description')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="field-stack">
                            <label for="create-hours" class="text-sm font-semibold text-slate-700">Horas</label>
                            <input id="create-hours" name="hours" type="number" min="1" max="1000" value="{{ old('hours', 40) }}" class="pro-input w-full" required>
                            @error('hours')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field-stack">
                            <label for="create-start-date" class="text-sm font-semibold text-slate-700">Fecha de inicio</label>
                            <input id="create-start-date" name="start_date" type="date" value="{{ old('start_date') }}" class="pro-input w-full">
                            @error('start_date')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="field-stack">
                        <label for="create-project-image" class="text-sm font-semibold text-slate-700">Imagen (opcional)</label>
                        <input id="create-project-image" name="image" type="file" accept="image/*" class="pro-input w-full">
                        @error('image')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-2">
                        <button type="button" id="cancel-create-project-modal" class="btn-ghost-light font-semibold">Cancelar</button>
                        <button type="submit" class="btn-brand font-semibold">Guardar proyecto</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="edit-project-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 p-4">
            <div class="w-full max-w-lg rounded-2xl border border-slate-200 bg-white p-5 shadow-2xl">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="display-font text-xl font-bold text-slate-900">Editar proyecto</h3>
                    <button type="button" id="close-edit-project-modal" class="btn-ghost-light btn-sm">Cerrar</button>
                </div>

                <form id="edit-project-form" action="" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-project-id" name="_edit_project_id" value="">

                    <div class="field-stack">
                        <label for="edit-name" class="text-sm font-semibold text-slate-700">Nombre</label>
                        <input id="edit-name" name="name" type="text" value="" class="pro-input w-full" required>
                        @error('name')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field-stack">
                        <label for="edit-description" class="text-sm font-semibold text-slate-700">Descripcion</label>
                        <input id="edit-description" name="description" type="text" value="" class="pro-input w-full" required>
                        @error('description')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="field-stack">
                            <label for="edit-hours" class="text-sm font-semibold text-slate-700">Horas</label>
                            <input id="edit-hours" name="hours" type="number" min="1" max="1000" value="" class="pro-input w-full" required>
                            @error('hours')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field-stack">
                            <label for="edit-start-date" class="text-sm font-semibold text-slate-700">Fecha de inicio</label>
                            <input id="edit-start-date" name="start_date" type="date" value="" class="pro-input w-full">
                            @error('start_date')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="field-stack">
                        <label for="edit-project-image" class="text-sm font-semibold text-slate-700">Actualizar imagen (opcional)</label>
                        <input id="edit-project-image" name="image" type="file" accept="image/*" class="pro-input w-full">
                        <p class="text-xs text-slate-500">Si no subes una imagen, se mantiene la actual.</p>
                        @error('image')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-2">
                        <button type="button" id="cancel-edit-project-modal" class="btn-ghost-light font-semibold">Cancelar</button>
                        <button type="submit" class="btn-brand font-semibold">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    @endcan

    <script>
        (() => {
            const createModal = document.getElementById('create-project-modal');
            const openCreateBtn = document.getElementById('open-create-project-modal');
            const closeCreateBtn = document.getElementById('close-create-project-modal');
            const cancelCreateBtn = document.getElementById('cancel-create-project-modal');

            const editModal = document.getElementById('edit-project-modal');
            const closeEditBtn = document.getElementById('close-edit-project-modal');
            const cancelEditBtn = document.getElementById('cancel-edit-project-modal');
            const editForm = document.getElementById('edit-project-form');
            const editIdInput = document.getElementById('edit-project-id');
            const editNameInput = document.getElementById('edit-name');
            const editDescriptionInput = document.getElementById('edit-description');
            const editHoursInput = document.getElementById('edit-hours');
            const editStartDateInput = document.getElementById('edit-start-date');
            const updateUrlTemplate = @json(route('projects.update', '__ID__'));

            if (!createModal || !openCreateBtn || !editModal || !editForm) return;

            const openCreateModal = () => {
                createModal.classList.remove('hidden');
                createModal.classList.add('flex');
            };

            const closeCreateModal = () => {
                createModal.classList.remove('flex');
                createModal.classList.add('hidden');
            };

            const openEditModal = (project) => {
                editForm.action = updateUrlTemplate.replace('__ID__', String(project.id));
                editIdInput.value = project.id;
                editNameInput.value = project.name ?? '';
                editDescriptionInput.value = project.description ?? '';
                editHoursInput.value = project.hours ?? '';
                editStartDateInput.value = project.startDate ?? '';

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

            document.querySelectorAll('[data-edit-project-btn]').forEach((button) => {
                button.addEventListener('click', () => {
                    openEditModal({
                        id: button.dataset.id,
                        name: button.dataset.name,
                        description: button.dataset.description,
                        hours: button.dataset.hours,
                        startDate: button.dataset.startDate,
                    });
                });
            });

            const oldEditProjectId = @json(old('_edit_project_id'));
            if (@json($errors->any())) {
                if (oldEditProjectId) {
                    openEditModal({
                        id: oldEditProjectId,
                        name: @json(old('name')),
                        description: @json(old('description')),
                        hours: @json(old('hours')),
                        startDate: @json(old('start_date')),
                    });
                } else {
                    openCreateModal();
                }
            }
        })();
    </script>
</x-tarjeta.base>
