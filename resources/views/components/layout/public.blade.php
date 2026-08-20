@props(['profile' => null, 'title' => null, 'metaDescription' => null])

<x-layouts.public :profile="$profile" :title="$title" :metaDescription="$metaDescription">
    {{ $slot }}
</x-layouts.public>
