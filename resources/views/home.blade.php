<x-layouts.public :profile="$profile" title="Portfolio">

    {{-- =============== HERO / PROFILE =============== --}}
    <section class="max-w-5xl mx-auto px-4 sm:px-6 pt-16 pb-16 md:pt-24 md:pb-20 relative">

        {{-- Background decorative rings (terinspirasi dari foto profil) --}}
        <div class="absolute top-10 right-0 w-72 h-72 rounded-full border border-sienna/10 pointer-events-none hidden md:block"></div>
        <div class="absolute top-20 right-10 w-52 h-52 rounded-full border border-sienna/15 pointer-events-none hidden md:block"></div>

        <div class="grid grid-cols-1 md:grid-cols-[1fr_auto] gap-10 md:gap-16 items-start">

            {{-- Text block --}}
            <div class="animate-slide-up">
                <p class="section-eyebrow">— hello, saya</p>
                <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl font-bold text-ink leading-tight mb-5">
                    {{ $profile->name ?? 'Bagas Ilham Saputro' }}
                </h1>

                {{-- Cyan underline accent --}}
                <div class="h-0.5 mb-6 w-48 bg-gradient-to-r from-sienna to-transparent"></div>

                <p class="text-base md:text-lg text-ink-100 leading-relaxed max-w-xl mb-8">
                    {{ $profile->description ?? '' }}
                </p>

                <div class="flex flex-wrap items-center gap-4">
                    @if(optional($profile)->email)
                        <a href="mailto:{{ $profile->email }}" class="btn-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Hubungi Saya
                        </a>
                    @endif
                    <a href="#projects" class="btn-outline">
                        Lihat Projects
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                </div>
            </div>

            {{-- Profile photo with cyan ring --}}
            <div class="mx-auto md:mx-0 order-first md:order-last animate-fade-in">
                <div class="relative w-36 h-36 md:w-48 md:h-48">
                    {{-- Outer ring --}}
                    <div class="absolute inset-0 rounded-full border-2 border-sienna/30 scale-110"></div>
                    {{-- Inner ring --}}
                    <div class="absolute inset-0 rounded-full border border-sienna/50 scale-[1.04]"
                         style="box-shadow: 0 0 20px rgba(41,189,212,0.2);"></div>
                    {{-- Photo --}}
                    @if(optional($profile)->photo)
                        <img
                            src="{{ Storage::url($profile->photo) }}"
                            alt="{{ $profile->name }}"
                            class="w-full h-full object-cover rounded-full border-2 border-sienna/60"
                            style="box-shadow: 0 0 24px rgba(41,189,212,0.35);"
                        />
                    @else
                        <div class="w-full h-full bg-paper-200 rounded-full border-2 border-sienna/40 flex items-center justify-center"
                             style="box-shadow: 0 0 20px rgba(41,189,212,0.2);">
                            <svg class="w-16 h-16 text-sienna/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Cyan divider --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="cyan-line"></div>
    </div>

    {{-- =============== PROJECTS =============== --}}
    <section id="projects" class="max-w-5xl mx-auto px-4 sm:px-6 py-16 md:py-20"
             x-data="{ active: 'all' }">

        <div class="mb-10">
            <p class="section-eyebrow">Karya &amp; Project</p>
            <h2 class="section-title mb-6">Apa yang telah<br>
                <span class="text-sienna" style="text-shadow: 0 0 20px rgba(41,189,212,0.3);">saya kerjakan.</span>
            </h2>

            {{-- Category filter tabs --}}
            @if($categories->count() > 0)
                <div class="flex flex-wrap gap-2 mt-6">
                    <button @click="active = 'all'"
                            :class="active === 'all' ? 'cat-tab active' : 'cat-tab'">
                        Semua
                    </button>
                    @foreach($categories as $cat)
                        <button
                            @click="active = '{{ $cat->slug }}'"
                            :class="active === '{{ $cat->slug }}' ? 'cat-tab active' : 'cat-tab'"
                        >{{ $cat->name }}</button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Projects grouped by category --}}
        @forelse($categories as $category)
            <div
                x-show="active === 'all' || active === '{{ $category->slug }}'"
                x-transition:enter="transition-opacity duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                class="mb-14"
            >
                {{-- Category heading --}}
                <div class="flex items-center gap-4 mb-6">
                    <h3 class="font-mono text-xs text-sienna uppercase tracking-[0.15em] whitespace-nowrap">{{ $category->name }}</h3>
                    <div class="flex-1 h-px bg-warm-border"></div>
                    <span class="font-mono text-xs text-ink-50 bg-paper-200 px-2 py-0.5 rounded-full border border-warm-border">
                        {{ $category->projects->count() }}
                    </span>
                </div>

                {{-- Project grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($category->projects as $project)
                        <x-project-card :project="$project" />
                    @endforeach
                </div>
            </div>
        @empty
            <div class="text-center py-20 text-ink-50">
                <p class="font-mono text-sm">— belum ada project —</p>
                <p class="text-xs mt-2">Tambahkan project lewat <a href="{{ route('login') }}" class="text-sienna hover:underline">panel admin</a>.</p>
            </div>
        @endforelse

    </section>

</x-layouts.public>
