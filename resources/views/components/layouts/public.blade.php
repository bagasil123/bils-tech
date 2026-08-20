@props(['profile' => null, 'title' => null, 'metaDescription' => null])

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @php
        $pageTitle = ($title ? $title . ' — ' : '') . (optional($profile)->name ?? 'Portfolio');
        $pageDesc = $metaDescription ?? (optional($profile)->description ? \Str::limit(strip_tags($profile->description), 155) : 'Portfolio pribadi seorang full-stack developer.');
        $pageUrl = url()->current();
        $pageImage = optional($profile)->photo ? url(Storage::url($profile->photo)) : asset('favicon.ico');
        $authorName = optional($profile)->name ?? 'Bagas Ilham Saputro';
    @endphp

    <title>{{ $pageTitle }}</title>
    
    {{-- Primary Meta Tags --}}
    <meta name="title" content="{{ $pageTitle }}" />
    <meta name="description" content="{{ $pageDesc }}" />
    <meta name="author" content="{{ $authorName }}" />
    <meta name="keywords" content="Portfolio, Web Developer, Programmer, Full-stack Developer, {{ $authorName }}, Laravel, PHP" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="{{ $pageUrl }}" />

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $pageUrl }}" />
    <meta property="og:title" content="{{ $pageTitle }}" />
    <meta property="og:description" content="{{ $pageDesc }}" />
    <meta property="og:image" content="{{ $pageImage }}" />
    <meta property="og:site_name" content="{{ $authorName }}" />

    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ $pageUrl }}" />
    <meta property="twitter:title" content="{{ $pageTitle }}" />
    <meta property="twitter:description" content="{{ $pageDesc }}" />
    <meta property="twitter:image" content="{{ $pageImage }}" />

    {{-- Structured Data (JSON-LD) for Google --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Person",
      "name": "{{ $authorName }}",
      "url": "{{ url('/') }}",
      "image": "{{ $pageImage }}",
      "jobTitle": "Web Developer",
      "description": "{{ $pageDesc }}"
    }
    </script>
    
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
