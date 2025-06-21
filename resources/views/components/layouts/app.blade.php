<x-layouts.app.sidebar :title="$title ?? null">

    <!-- Page Heading -->
    @isset($header)
        <header class="hidden lg:block bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
