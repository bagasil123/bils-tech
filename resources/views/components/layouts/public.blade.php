@props(['profile' => null, 'title' => null, 'metaDescription' => null])

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ? $title . ' — ' : '' }}{{ optional($profile)->name ?? 'Portfolio' }}</title>
    <meta name="description" content="{{ $metaDescription ?? (optional($profile)->description ? \Str::limit($profile->description, 155) : 'Portfolio pribadi seorang full-stack developer.') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-paper text-ink">

    {{-- ===================== NAVBAR ===================== --}}
    <header class="sticky top-0 z-50 border-b border-warm-border bg-paper/95 backdrop-blur-sm">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 h-14 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-serif text-lg font-semibold tracking-tight text-ink hover:text-sienna transition-colors">
                {{ optional($profile)->name ?? 'Portfolio' }}
            </a>
            <nav class="flex items-center gap-5">
                <a href="{{ route('home') }}#projects" class="text-sm text-ink-100 hover:text-sienna transition-colors font-medium">Projects</a>
                @if(optional($profile)->email)
                    <a href="mailto:{{ $profile->email }}" class="text-sm text-ink-100 hover:text-sienna transition-colors font-medium">Kontak</a>
                @endif
                <a href="{{ auth()->check() ? route('admin.dashboard') : route('login') }}" class="text-xs font-mono text-warm-gray hover:text-ink-100 transition-colors">Admin ↗</a>
            </nav>
        </div>
    </header>

    {{-- ===================== CONTENT ===================== --}}
    <main>
        {{ $slot }}
    </main>

    {{-- ===================== FOOTER ===================== --}}
    <footer class="border-t border-warm-border mt-20 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs font-mono text-warm-gray">
                © {{ date('Y') }} {{ optional($profile)->name ?? 'Portfolio' }}
            </p>
            <p class="text-xs text-warm-gray">Dibangun dengan Laravel &amp; ☕</p>
        </div>
    </footer>

</body>
</html>
