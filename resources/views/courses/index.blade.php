<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-application-messages />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('courses.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Add New Course
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Code</th>
                                    <th scope="col" class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Name</th>
                                {{--    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th> --}}
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Units</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($courses as $course)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $course->course_code }}</td>
                                        <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">{{ $course->course_name }}</td>
                                    {{--    <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($course->description, 50) }}</td> --}}
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $course->unit }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('courses.show', $course) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                                            <a href="{{ route('courses.edit', $course) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                            <form action="{{ route('courses.destroy', $course) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this course?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>