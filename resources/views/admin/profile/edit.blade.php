<x-layouts.admin title="Edit Profil">

    <div class="max-w-2xl">
        <form
            method="POST"
            action="{{ route('admin.profile.update') }}"
            enctype="multipart/form-data"
            class="space-y-6"
            x-data="imagePreview()"
        >
            @csrf
            @method('PATCH')

            {{-- Photo --}}
            <div class="card-paper p-5">
                <h2 class="font-serif text-base font-semibold text-ink mb-4">Foto Profil</h2>
                <div class="flex items-start gap-5 flex-wrap">
                    {{-- Preview --}}
                    <div class="relative flex-shrink-0">
                        <img
                            :src="previewUrl || '{{ $profile->photo ? Storage::url($profile->photo) : '' }}'"
                            x-show="previewUrl || '{{ $profile->photo }}'"
                            alt="Preview foto"
                            class="w-24 h-24 object-cover rounded-sm border border-warm-border"
                        />
                        <div x-show="!previewUrl && !{{ $profile->photo ? 'true' : 'false' }}"
                             class="w-24 h-24 rounded-sm border-2 border-dashed border-warm-border flex items-center justify-center bg-paper-100">
                            <svg class="w-8 h-8 text-warm-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    </div>

                    <div class="flex-1 min-w-0">
                        <label for="photo" class="form-label">Upload Foto Baru</label>
                        <input
                            id="photo"
                            type="file"
                            name="photo"
                            accept="image/jpg,image/jpeg,image/png,image/webp"
                            @change="handleFile($event)"
                            class="block w-full text-sm text-ink-100 file:mr-3 file:py-1.5 file:px-3
                                   file:rounded-sm file:border file:border-warm-border file:text-xs
                                   file:font-mono file:bg-paper file:text-ink-100
                                   hover:file:bg-paper-200 cursor-pointer"
                        />
                        <p class="mt-1 text-xs text-warm-gray">JPG, PNG, WebP — maks. 2MB</p>
                        @error('photo') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Info --}}
            <div class="card-paper p-5 space-y-5">
                <h2 class="font-serif text-base font-semibold text-ink">Informasi Profil</h2>

                <div>
                    <label for="name" class="form-label">Nama Lengkap <span class="text-sienna">*</span></label>
                    <input id="name" type="text" name="name" value="{{ old('name', $profile->name) }}"
                           required class="form-input @error('name') border-red-400 @enderror" />
                    @error('name') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="form-label">Email Kontak <span class="text-sienna">*</span></label>
                    <input id="email" type="email" name="email" value="{{ old('email', $profile->email) }}"
                           required class="form-input @error('email') border-red-400 @enderror" />
                    @error('email') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="description" class="form-label">Bio / Deskripsi <span class="text-sienna">*</span></label>
                    <textarea id="description" name="description" rows="5" required
                              class="form-textarea @error('description') border-red-400 @enderror">{{ old('description', $profile->description) }}</textarea>
                    @error('description') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <script>
        function imagePreview() {
            return {
                previewUrl: null,
                handleFile(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.previewUrl = URL.createObjectURL(file);
                    }
                }
            }
        }
    </script>

</x-layouts.admin>
