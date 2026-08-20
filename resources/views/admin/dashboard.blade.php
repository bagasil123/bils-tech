<x-layouts.admin title="Dashboard">

    {{-- Stats cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-8 max-w-lg">
        <div class="card-paper p-5">
            <p class="text-xs font-mono text-warm-gray uppercase tracking-widest mb-1">Total Project</p>
            <p class="font-serif text-4xl font-bold text-ink">{{ $totalProjects }}</p>
        </div>
        <div class="card-paper p-5">
            <p class="text-xs font-mono text-warm-gray uppercase tracking-widest mb-1">Total Kategori</p>
            <p class="font-serif text-4xl font-bold text-ink">{{ $totalCategories }}</p>
        </div>
    </div>

    {{-- Quick links --}}
    <div class="card-paper p-5 max-w-lg">
        <h2 class="font-serif text-base font-semibold text-ink mb-4">Aksi Cepat</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.projects.create') }}" class="btn-primary text-xs">+ Tambah Project</a>
            <a href="{{ route('admin.categories.create') }}" class="btn-outline text-xs">+ Tambah Kategori</a>
            <a href="{{ route('admin.profile.edit') }}" class="btn-ghost text-xs border border-warm-border">Edit Profil</a>
        </div>
    </div>

</x-layouts.admin>
