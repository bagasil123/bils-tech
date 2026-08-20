<x-layouts.admin title="Tambah Kategori">

    <div class="max-w-md">
        <form method="POST" action="{{ route('admin.categories.store') }}" class="card-paper p-6 space-y-5">
            @csrf

            <div>
                <label for="name" class="form-label">Nama Kategori <span class="text-sienna">*</span></label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                       required placeholder="cth: Web Development"
                       class="form-input @error('name') border-red-400 @enderror" />
                @error('name') <p class="form-error">{{ $message }}</p> @enderror
                <p class="mt-1 text-xs text-warm-gray">Slug akan di-generate otomatis dari nama.</p>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Simpan</button>
                <a href="{{ route('admin.categories.index') }}" class="btn-ghost border border-warm-border">Batal</a>
            </div>
        </form>
    </div>

</x-layouts.admin>
