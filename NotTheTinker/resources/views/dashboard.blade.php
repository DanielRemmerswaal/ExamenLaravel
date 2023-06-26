<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div class="mt-8">
                        <h2 class="text-xl font-bold">Task List</h2>
                        <ul class="mt-4">
                            @foreach ($tasks as $task)
                            <li class="border rounded-lg p-4 mb-4 flex flex-col md:flex-row md:items-center md:justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $task->title }}</h3>
                                    <p class="text-gray-600">{{ $task->text }}</p>
                                    <p class="text-gray-500 mt-2">Deadline: {{ $task->deadline }}</p>
                                </div>
                                <div class="mt-4 md:mt-0">
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mb-2 md:mb-0">Delete</button>
                                    </form>
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</button>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <h2 class="text-xl font-bold">Add Task</h2>
                    <div class="p-4 bg-white shadow rounded">
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                                <input type="text" name="title" id="title" class="w-full px-3 py-2 border border-gray-300 rounded">
                            </div>

                            <div class="mb-4">
                                <label for="text" class="block text-gray-700 text-sm font-bold mb-2">Text:</label>
                                <textarea name="text" id="text" class="w-full px-3 py-2 border border-gray-300 rounded" rows="3"></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="deadline" class="block text-gray-700 text-sm font-bold mb-2">Deadline:</label>
                                <input type="date" name="deadline" id="deadline" class="w-full px-3 py-2 border border-gray-300 rounded">
                            </div>

                            <div>
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
