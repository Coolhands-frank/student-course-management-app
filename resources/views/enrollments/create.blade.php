<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Courses to Student') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-application-messages />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('enrollments.store') }}">
                        @csrf

                        <!-- Select Student -->
                        <div>
                            <x-input-label for="student_id" :value="__('Select Student')" />
                            <select id="student_id" name="student_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Select Student --</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->name }} ({{ $student->email }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                        </div>

                        <!-- Select Courses -->
                        <div class="mt-4">
                            <x-input-label for="course_ids" :value="__('Select Courses')" />
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                @forelse ($courses as $course)
                                    <div class="flex items-center">
                                        <input type="checkbox" id="course_{{ $course->id }}" name="course_ids[]" value="{{ $course->id }}"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                            {{ in_array($course->id, old('course_ids', [])) ? 'checked' : '' }}>
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
                                {{ __('Assign Courses') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>