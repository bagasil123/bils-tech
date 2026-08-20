<x-layouts.admin title="Tambah Project">

    <div class="max-w-2xl">
        <form
            method="POST"
            action="{{ route('admin.projects.store') }}"
            enctype="multipart/form-data"
            class="space-y-5"
            x-data="imagePreview()"
        >
            @csrf

            {{-- Image upload --}}
            <div class="card-paper p-5">
                <h2 class="font-serif text-base font-semibold text-ink mb-4">Gambar Thumbnail <span class="text-sienna">*</span></h2>
                <div class="space-y-3">
                    <div class="relative w-full aspect-video bg-paper-200 border-2 border-dashed border-warm-border rounded-sm overflow-hidden flex items-center justify-center">
                        <img x-show="previewUrl" :src="previewUrl" class="absolute inset-0 w-full h-full object-cover" style="display:none" />
                        <div x-show="!previewUrl" class="text-center">
                            <svg class="w-12 h-12 text-warm-border mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="text-xs text-warm-gray font-mono">Pilih gambar</p>
                        </div>
                    </div>
                    <input type="file" id="image" name="image" required accept="image/*"
                           @change="handleFile($event)"
                           class="block w-full text-sm text-ink-100 file:mr-3 file:py-1.5 file:px-3
                                  file:rounded-sm file:border file:border-warm-border file:text-xs
                                  file:font-mono file:bg-paper file:text-ink-100 hover:file:bg-paper-200 cursor-pointer
                                  @error('image') border-red-400 @enderror" />
                    <p class="text-xs text-warm-gray">JPG, PNG, WebP — maks. 3MB</p>
                    @error('image') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Fields --}}
            <div class="card-paper p-5 space-y-5">
                <div>
                    <label for="title" class="form-label">Judul Project <span class="text-sienna">*</span></label>
                    <input id="title" type="text" name="title" value="{{ old('title') }}" required
                           class="form-input @error('title') border-red-400 @enderror" />
                    @error('title') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="category_id" class="form-label">Kategori <span class="text-sienna">*</span></label>
                    <select id="category_id" name="category_id" required
                            class="form-input @error('category_id') border-red-400 @enderror">
                        <option value="">Pilih kategori...</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="demo_link" class="form-label">Link Demo / URL</label>
                    <input id="demo_link" type="url" name="demo_link" value="{{ old('demo_link') }}"
                           placeholder="https://..." class="form-input @error('demo_link') border-red-400 @enderror" />
                    @error('demo_link') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea id="description" name="description" rows="4"
                              class="form-textarea @error('description') border-red-400 @enderror">{{ old('description') }}</textarea>
                    @error('description') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn-primary">Simpan Project</button>
                <a href="{{ route('admin.projects.index') }}" class="btn-ghost border border-warm-border">Batal</a>
            </div>
        </form>
    </div>

    <script>
        function imagePreview() {
            return {
                previewUrl: null,
                handleFile(event) {
                    const file = event.target.files[0];
                    if (file) this.previewUrl = URL.createObjectURL(file);
                }
            }
        }
    </script>

</x-layouts.admin>
