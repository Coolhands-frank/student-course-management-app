<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col rounded-xl">
        <!--
        <div class="text-base md:text-lg lg:text-xl xl:text-2xl 2xl:text-4xl hidden md:grid auto-rows-min gap-4 md:grid-cols-3 mb-4">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="flex flex-col items-center justify-center h-full">
                    <h2>TOTAL STUDENTS</h2>
                    <p>60</p>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class=" flex flex-col items-center justify-center h-full">
                    <h2>TOTAL COURSES</h2>
                    <p>60</p>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="flex flex-col items-center justify-center h-full">
                    <h2>ENROLLED STUDENTS</h2>
                    <p>60</p>
                </div>
            </div>
        </div>
        -->

        <div class="p-4 flex flex-col relative items-center justify-center w-full h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="mb-4 text-xl md:text-3xl lg:text-4xl xl:text-5xl">
                <h2>What Will You Like to Do</h2>
            </div>

            <div class="flex flex-col md:flex-row gap-4 text-center text-base md:text-lg 2xl:text-xl">
                <a href="{{ route('students.index') }}" class="hover:border-none border rounded-md px-6 py-3">
                    Manage Students
                </a>
                <a href="{{ route('courses.index') }}" class="border hover:border-none rounded-md px-6 py-3">
                    Manage Courses
                </a>
                <a href="{{ route('enrollments.index') }}" class="border hover:border-none rounded-md px-6 py-3">
                    Manage Enrollments 
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
