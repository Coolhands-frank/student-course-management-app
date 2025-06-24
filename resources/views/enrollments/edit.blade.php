<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Enrollment for: ') . $student->name }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-application-messages />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('enrollments.update', $student) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <p class="text-lg font-medium text-gray-700">Student: <span class="font-semibold">{{ $student->name }}</span></p>
                            <p class="text-sm text-gray-600">Email: {{ $student->email }}</p>
                        </div>

                        <!-- Select Courses -->
                        <div class="mt-4">
                            <x-input-label for="course_ids" :value="__('Select Courses')" />
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                @forelse ($allCourses as $course)
                                    <div class="flex items-center">
                                        <input type="checkbox" id="course_{{ $course->id }}" name="course_ids[]" value="{{ $course->id }}"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                            {{ in_array($course->id, old('course_ids', $enrolledCourseIds)) ? 'checked' : '' }}>
                                        <label for="course_{{ $course->id }}" class="ml-2 text-sm text-gray-600">{{ $course->course_name }} ({{ $course->course_code }})</label>
                                    </div>
                                @empty
                                    <p class="text-gray-500 col-span-2">No courses available. Please add courses first.</p>
                                @endforelse
                            </div>
                            <x-input-error :messages="$errors->get('course_ids')" class="mt-2" />
                            <x-input-error :messages="$errors->get('course_ids.*')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-enrollment-cancel-btn />

                            <x-primary-button class="ms-4">
                                {{ __('Update Enrollment') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>