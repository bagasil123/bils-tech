<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Portfolio' }} — {{ $profile->name ?? 'Bagas Ilham Saputro' }}</title>
    <meta name="description" content="{{ $metaDescription ?? ($profile->description ?? 'Portfolio pribadi seorang full-stack developer.') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Decorative ruled-line header */
        .ruled-header {
            background-image: repeating-linear-gradient(
                transparent,
                transparent 27px,
                rgba(216,205,184,0.5) 27px,
                rgba(216,205,184,0.5) 28px
            );
        }
    </style>
</head>
<body class="min-h-screen bg-paper text-ink">

    {{-- ===================== NAVBAR ===================== --}}
    <header class="sticky top-0 z-50 border-b border-warm-border bg-paper/95 backdrop-blur-sm">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 h-14 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-serif text-lg font-semibold tracking-tight text-ink hover:text-sienna transition-colors">
                {{ $profile->name ?? 'Portfolio' }}
            </a>
            <nav class="flex items-center gap-6">
                <a href="{{ route('home') }}#projects" class="text-sm text-ink-100 hover:text-sienna transition-colors font-medium">Projects</a>
                <a href="mailto:{{ $profile->email ?? '' }}" class="text-sm text-ink-100 hover:text-sienna transition-colors font-medium">Kontak</a>
                <a href="{{ route('login') }}" class="text-xs font-mono text-warm-gray hover:text-ink-100 transition-colors">Admin ↗</a>
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
                © {{ date('Y') }} {{ $profile->name ?? 'Bagas Ilham Saputro' }}
            </p>
            <p class="text-xs text-warm-gray">
                Dibangun dengan Laravel &amp; ☕
            </p>
        </div>
    </footer>

</body>
</html>
