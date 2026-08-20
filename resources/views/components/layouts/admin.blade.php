@props(['title' => 'Dashboard'])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin — {{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-paper-100 text-ink" x-data="{ sidebarOpen: false }">

    {{-- ===================== MOBILE OVERLAY ===================== --}}
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition-opacity duration-200"
        x-transition:leave="transition-opacity duration-200"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-20 bg-black/40 lg:hidden"
        style="display:none"
    ></div>

    {{-- ===================== SIDEBAR ===================== --}}
    <aside
        class="fixed top-0 left-0 z-30 h-full w-60 bg-paper border-r border-warm-border flex flex-col
               transform transition-transform duration-300 ease-in-out"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    >
        {{-- Brand --}}
        <div class="h-14 border-b border-warm-border flex items-center px-5 flex-shrink-0">
            <a href="{{ route('home') }}" target="_blank" class="font-serif text-base font-semibold text-ink hover:text-sienna transition-colors">
                Bils·Tech
            </a>
            <span class="ml-2 text-xs font-mono bg-sienna/10 text-sienna px-1.5 py-0.5 rounded">admin</span>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 overflow-y-auto p-3 space-y-0.5">
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.profile.edit') }}"
               class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Profil
            </a>
            <a href="{{ route('admin.categories.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                Kategori
            </a>
            <a href="{{ route('admin.projects.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Projects
            </a>

            <div class="h-px bg-warm-border my-2"></div>

            <a href="{{ route('admin.account.edit') }}"
               class="sidebar-link {{ request()->routeIs('admin.account.*') ? 'active' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Pengaturan Akun
            </a>
        </nav>

        {{-- User + Logout --}}
        <div class="border-t border-warm-border p-3 flex-shrink-0">
            <div class="flex items-center gap-3 mb-2 px-2">
                <div class="w-7 h-7 rounded-full bg-sienna/20 flex items-center justify-center text-sienna text-xs font-mono font-bold flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span class="text-sm text-ink-100 font-medium truncate">{{ auth()->user()->name }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full text-left">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ===================== MAIN CONTENT ===================== --}}
    <div class="lg:pl-60 min-h-screen flex flex-col">
        {{-- Top bar --}}
        <div class="sticky top-0 z-10 h-14 bg-paper border-b border-warm-border flex items-center px-4 sm:px-6 gap-4">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-1.5 rounded text-ink-100 hover:bg-paper-200 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <h1 class="font-serif text-lg font-semibold text-ink">{{ $title }}</h1>
        </div>

        {{-- Page content --}}
        <main class="flex-1 p-4 sm:p-6">
            {{-- Flash messages --}}
            @if(session('success'))
                <div class="mb-5 flex items-start gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-sm text-sm">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-5 flex items-start gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-sm text-sm">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

</body>
</html>
