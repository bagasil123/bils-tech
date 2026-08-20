{{-- Confirm Delete Modal Component --}}
@props([
    'id'      => 'confirm-modal',
    'title'   => 'Konfirmasi Hapus',
    'message' => 'Apakah kamu yakin ingin menghapus item ini? Tindakan ini tidak dapat dibatalkan.',
    'action'  => '#',
])

<div
    x-data="{ open: false }"
    x-on:open-modal-{{ $id }}.window="open = true"
    class="inline-block"
>
    {{-- Trigger slot --}}
    <span @click="open = true">{{ $slot }}</span>

    {{-- Overlay --}}
    <div
        x-show="open"
        x-transition:enter="transition-opacity duration-200"
        x-transition:leave="transition-opacity duration-200"
        class="fixed inset-0 z-40 bg-black/40"
        style="display:none"
        @click.self="open = false"
    >
        {{-- Modal --}}
        <div
            x-show="open"
            x-transition:enter="transition-all duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                   w-full max-w-md bg-paper border border-warm-border rounded-sm shadow-xl p-6"
        >
            <h2 class="font-serif text-xl font-semibold text-ink mb-2">{{ $title }}</h2>
            <p class="text-sm text-ink-100 leading-relaxed mb-6">{{ $message }}</p>
            <div class="flex gap-3 justify-end">
                <button @click="open = false" class="btn-ghost">Batal</button>
                <form method="POST" action="{{ $action }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
