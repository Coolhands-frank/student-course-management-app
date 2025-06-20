<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
     <!--   <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div> -->

        <div class="p-4 flex flex-col relative items-center justify-center w-full h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="mb-4 text-xl md:text-3xl lg:text-4xl xl:text-6xl">
                <h2>What Will You Like to Do</h2>
            </div>

            <div class="flex flex-col md:flex-row gap-4 text-center text-base md:text-lg xl:text-xl">
                <div class="border rounded-md px-6 py-3">
                    Manage Students
                </div>
                <div class="border rounded-md px-6 py-3">
                    Manage Courses
                </div>
                <div class="border rounded-md px-6 py-3">
                    Manage Enrollments 
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
