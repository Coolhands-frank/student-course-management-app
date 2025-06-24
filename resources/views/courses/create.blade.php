<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-application-messages />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('courses.store') }}">
                        @csrf

                        <!-- Course Code -->
                        <div>
                            <x-input-label for="course_code" :value="__('Course Code')" />
                            <x-text-input id="course_code" class="block mt-1 w-full" type="text" name="course_code" :value="old('course_code')" required autofocus />
                            <x-input-error :messages="$errors->get('course_code')" class="mt-2" />
                        </div>

                        <!-- Course Name -->
                        <div class="mt-4">
                            <x-input-label for="course_name" :value="__('Course Name')" />
                            <x-text-input id="course_name" class="block mt-1 w-full" type="text" name="course_name" :value="old('course_name')" required />
                            <x-input-error :messages="$errors->get('course_name')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Unit -->
                        <div class="mt-4">
                            <x-input-label for="unit" :value="__('Units')" />
                            <x-text-input id="unit" class="block mt-1 w-full" type="number" name="unit" :value="old('unit')" required min="1" />
                            <x-input-error :messages="$errors->get('unit')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-course-cancel-btn />
                            <x-primary-button class="ms-4">
                                {{ __('Save Course') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>