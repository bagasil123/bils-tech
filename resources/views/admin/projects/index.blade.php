<x-layouts.admin title="Projects">

    {{-- Filter bar --}}
    <form method="GET" action="{{ route('admin.projects.index') }}"
          class="flex flex-wrap gap-3 mb-6 items-end">
        <div>
            <label class="form-label">Cari</label>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Judul project..."
                   class="form-input w-48" />
        </div>
        <div>
            <label class="form-label">Kategori</label>
            <select name="category" class="form-input w-44">
                <option value="">Semua</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn-outline text-xs">Filter</button>
        @if(request('search') || request('category'))
            <a href="{{ route('admin.projects.index') }}" class="btn-ghost border border-warm-border text-xs">Reset</a>
        @endif

        <div class="ml-auto">
            <a href="{{ route('admin.projects.create') }}" class="btn-primary">+ Tambah Project</a>
        </div>
    </form>

    {{-- Table --}}
    <div class="card-paper overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-warm-border bg-paper-100">
                    <th class="text-left px-5 py-3 font-mono text-xs text-warm-gray uppercase tracking-wider">Project</th>
                    <th class="text-left px-5 py-3 font-mono text-xs text-warm-gray uppercase tracking-wider hidden md:table-cell">Kategori</th>
                    <th class="text-left px-5 py-3 font-mono text-xs text-warm-gray uppercase tracking-wider hidden lg:table-cell">Demo</th>
                    <th class="text-right px-5 py-3 font-mono text-xs text-warm-gray uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-warm-border">
                @forelse($projects as $project)
                    <tr class="hover:bg-paper-100 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <img
                                    src="{{ $project->image && file_exists(public_path('storage/' . $project->image))
                                        ? Storage::url($project->image)
                                        : 'https://placehold.co/60x45/EDE0C4/8C8278?text=img' }}"
                                    alt="{{ $project->title }}"
                                    class="w-14 h-10 object-cover rounded-sm border border-warm-border flex-shrink-0"
                                />
                                <span class="font-medium text-ink">{{ $project->title }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 hidden md:table-cell">
                            <span class="text-xs font-mono bg-sienna/10 text-sienna px-2 py-0.5 rounded-full">
                                {{ $project->category->name }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 hidden lg:table-cell">
                            @if($project->demo_link)
                                <a href="{{ $project->demo_link }}" target="_blank"
                                   class="text-xs font-mono text-ink-100 underline underline-offset-2 hover:text-sienna transition-colors truncate block max-w-[180px]">
                                    {{ $project->demo_link }}
                                </a>
                            @else
                                <span class="text-xs text-warm-gray italic">—</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.projects.edit', $project) }}"
                                   class="text-xs font-mono text-ink-100 hover:text-sienna transition-colors">Edit</a>

                                <x-confirm-modal
                                    :action="route('admin.projects.destroy', $project)"
                                    title="Hapus Project"
                                    :message="'Hapus project &quot;' . $project->title . '&quot;? Gambar juga akan dihapus dari server.'"
                                >
                                    <button type="button" class="text-xs font-mono text-red-600 hover:text-red-800 transition-colors">Hapus</button>
                                </x-confirm-modal>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-12 text-center text-sm font-mono text-warm-gray">
                            — Belum ada project. <a href="{{ route('admin.projects.create') }}" class="text-sienna hover:underline">Tambah sekarang →</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($projects->hasPages())
        <div class="mt-5">
            {{ $projects->links() }}
        </div>
    @endif

</x-layouts.admin>
