@props(['project'])

<article class="card-paper group overflow-hidden">
    {{-- Thumbnail --}}
    <div class="aspect-[4/3] overflow-hidden bg-paper-200 relative">
        <img
            src="{{ $project->image && file_exists(public_path('storage/' . $project->image))
                ? Storage::url($project->image)
                : 'https://placehold.co/400x300/111111/29BDD4?text=' . urlencode($project->title) }}"
            alt="{{ $project->title }}"
            loading="lazy"
            class="w-full h-full object-cover opacity-75 group-hover:opacity-100 group-hover:scale-[1.04] transition-all duration-500"
        />
        {{-- Cyan overlay on hover --}}
        <div class="absolute inset-0 bg-gradient-to-t from-paper-100/80 via-transparent to-transparent
                    opacity-60 group-hover:opacity-30 transition-opacity duration-300"></div>
    </div>

    {{-- Content --}}
    <div class="p-4 sm:p-5">
        {{-- Category label --}}
        <p class="text-xs font-mono text-sienna uppercase tracking-widest mb-2">
            {{ $project->category->name }}
        </p>

        {{-- Title --}}
        <h3 class="font-serif text-lg font-semibold text-ink leading-snug mb-3 group-hover:text-sienna transition-colors duration-200">
            {{ $project->title }}
        </h3>

        {{-- Description preview --}}
        @if($project->description)
            <p class="text-sm text-ink-100 leading-relaxed mb-4 line-clamp-2">
                {{ $project->description }}
            </p>
        @endif

        {{-- CTA --}}
        @if($project->demo_link)
            <a
                href="{{ $project->demo_link }}"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center gap-1.5 text-xs font-mono font-medium text-sienna
                       underline underline-offset-4 decoration-sienna/30
                       hover:decoration-sienna transition-colors"
            >
                Lihat Project
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        @else
            <span class="text-xs font-mono text-ink-50 italic">Demo tidak tersedia</span>
        @endif
    </div>
</article>
