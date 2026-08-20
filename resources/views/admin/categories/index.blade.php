<x-layouts.admin title="Kategori">

    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-warm-gray">{{ $categories->count() }} kategori terdaftar</p>
        <a href="{{ route('admin.categories.create') }}" class="btn-primary text-xs">+ Tambah Kategori</a>
    </div>

    <div class="card-paper overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-warm-border bg-paper-100">
                    <th class="text-left px-5 py-3 font-mono text-xs text-warm-gray uppercase tracking-wider">Nama</th>
                    <th class="text-left px-5 py-3 font-mono text-xs text-warm-gray uppercase tracking-wider">Slug</th>
                    <th class="text-center px-5 py-3 font-mono text-xs text-warm-gray uppercase tracking-wider">Projects</th>
                    <th class="text-right px-5 py-3 font-mono text-xs text-warm-gray uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-warm-border">
                @forelse($categories as $category)
                    <tr class="hover:bg-paper-100 transition-colors">
                        <td class="px-5 py-3.5 font-medium text-ink">{{ $category->name }}</td>
                        <td class="px-5 py-3.5 font-mono text-xs text-warm-gray">{{ $category->slug }}</td>
                        <td class="px-5 py-3.5 text-center">
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-paper-200 text-xs font-mono text-ink-100">
                                {{ $category->projects_count }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="text-xs font-mono text-ink-100 hover:text-sienna transition-colors">Edit</a>

                                <x-confirm-modal
                                    :action="route('admin.categories.destroy', $category)"
                                    title="Hapus Kategori"
                                    :message="'Hapus kategori &quot;' . $category->name . '&quot;? Pastikan tidak ada project yang terkait.'"
                                >
                                    <button type="button" class="text-xs font-mono text-red-600 hover:text-red-800 transition-colors">Hapus</button>
                                </x-confirm-modal>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-10 text-center text-sm font-mono text-warm-gray">
                            — Belum ada kategori —
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.admin>
