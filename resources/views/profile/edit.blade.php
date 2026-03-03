<x-app-layout>
    <x-slot name="header">
        <h2 class="display-font font-extrabold text-2xl text-slate-900 leading-tight">
            {{ __('Profile') }}
        </h2>
        <div class="accent-rule mt-2"></div>
    </x-slot>

    <section class="page-wrap">
        <div class="content-shell space-y-6">
            <div class="section-card">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="section-card">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="section-card">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
