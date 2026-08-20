<x-layouts.admin title="Pengaturan Akun">

    <div class="max-w-lg">
        <form method="POST" action="{{ route('admin.account.update') }}" class="space-y-5">
            @csrf
            @method('PATCH')

            {{-- Info Akun --}}
            <div class="card-paper p-5 space-y-5">
                <h2 class="font-serif text-base font-semibold text-ink border-b border-warm-border pb-3">
                    Informasi Akun
                </h2>

                <div>
                    <label for="name" class="form-label">Nama <span class="text-sienna">*</span></label>
                    <input id="name" type="text" name="name"
                           value="{{ old('name', auth()->user()->name) }}"
                           required
                           class="form-input @error('name') border-red-500 @enderror" />
                    @error('name') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="form-label">Email Login <span class="text-sienna">*</span></label>
                    <input id="email" type="email" name="email"
                           value="{{ old('email', auth()->user()->email) }}"
                           required
                           class="form-input @error('email') border-red-500 @enderror" />
                    @error('email') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Ganti Password --}}
            <div class="card-paper p-5 space-y-5">
                <div>
                    <h2 class="font-serif text-base font-semibold text-ink">Ubah Password</h2>
                    <p class="text-xs text-ink-50 mt-0.5">Kosongkan kolom "Password Baru" jika tidak ingin menggantinya.</p>
                </div>

                <div>
                    <label for="current_password" class="form-label">Password Saat Ini <span class="text-sienna">*</span></label>
                    <input id="current_password" type="password" name="current_password"
                           required autocomplete="current-password"
                           placeholder="••••••••"
                           class="form-input @error('current_password') border-red-500 @enderror" />
                    @error('current_password') <p class="form-error">{{ $message }}</p> @enderror
                    <p class="mt-1 text-xs text-ink-50">Wajib diisi untuk mengonfirmasi perubahan.</p>
                </div>

                <div>
                    <label for="password" class="form-label">Password Baru</label>
                    <input id="password" type="password" name="password"
                           autocomplete="new-password"
                           placeholder="Min. 8 karakter"
                           class="form-input @error('password') border-red-500 @enderror" />
                    @error('password') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           autocomplete="new-password"
                           placeholder="Ulangi password baru"
                           class="form-input" />
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</x-layouts.admin>
