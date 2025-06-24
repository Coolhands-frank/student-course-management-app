<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Details: ') . $student->name }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <strong>Name:</strong> {{ $student->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Email:</strong> {{ $student->email }}
                    </div>
                    <div class="mb-4">
                        <strong>Gender:</strong> {{ $student->gender }}
                    </div>
                    <div class="mb-4">
                        <strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y') }}
                    </div>
                    <div class="mb-4">
                        <strong>Address:</strong> {{ $student->address }}
                    </div>

                    <h3 class="font-semibold text-lg text-gray-800 leading-tight mt-6 mb-3">Enrolled Courses</h3>
                    @if ($student->courses->isEmpty())
                        <p>This student is not enrolled in any courses yet.</p>
                    @else
                        <ul class="list-disc list-inside">
                            @foreach ($student->courses as $course)
                                <li>{{ $course->course_name }} ({{ $course->course_code }})</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('students.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Back to Students
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
