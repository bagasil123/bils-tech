<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login — Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-paper flex items-center justify-center px-4">

    {{-- Background decorative rings --}}
    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none select-none">
        <div class="w-[500px] h-[500px] rounded-full border border-sienna/5"></div>
    </div>
    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none select-none">
        <div class="w-[360px] h-[360px] rounded-full border border-sienna/8"></div>
    </div>

    <div class="w-full max-w-sm relative z-10">
        {{-- Header --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="font-serif text-2xl font-bold text-ink hover:text-sienna transition-colors"
               style="text-shadow: 0 0 20px rgba(41,189,212,0.2);">
                Bils·Tech
            </a>
            <p class="text-xs font-mono text-sienna mt-1 uppercase tracking-widest">Admin Panel</p>
        </div>

        {{-- Card --}}
        <div class="card-paper p-7" style="box-shadow: 0 0 40px rgba(41,189,212,0.08);">
            <h1 class="font-serif text-xl font-semibold text-ink mb-6">Masuk ke Akun</h1>

            {{-- Session error --}}
            @if ($errors->any())
                <div class="mb-4 bg-red-900/30 border border-red-700/50 text-red-400 text-sm px-3 py-2.5 rounded-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="form-label">Email</label>
                    <input
                        id="email" type="email" name="email"
                        value="{{ old('email') }}"
                        autocomplete="email" autofocus required
                        class="form-input {{ $errors->has('email') ? 'border-red-600' : '' }}"
                        placeholder="admin@bilstech.id"
                    />
                </div>

                <div>
                    <label for="password" class="form-label">Password</label>
                    <input
                        id="password" type="password" name="password"
                        autocomplete="current-password" required
                        class="form-input {{ $errors->has('password') ? 'border-red-600' : '' }}"
                        placeholder="••••••••"
                    />
                </div>

                <div class="flex items-center gap-2">
                    <input id="remember_me" type="checkbox" name="remember"
                           class="rounded-sm border-warm-border bg-paper-200 text-sienna focus:ring-sienna focus:ring-offset-0" />
                    <label for="remember_me" class="text-sm text-ink-100">Ingat saya</label>
                </div>

                <button type="submit" class="btn-primary w-full justify-center">
                    Masuk
                </button>
            </form>
        </div>

        <p class="text-center mt-5 text-xs font-mono text-ink-50">
            <a href="{{ route('home') }}" class="hover:text-sienna transition-colors">← Kembali ke halaman publik</a>
        </p>
    </div>

</body>
</html>
