<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <!-- New User Button -->
                    @if (session('message'))
                        <p>{{ session('message') }}</p>
                     @endif   
                    <div class="flex justify-between items-center mb-6">                 
                        <h3 class="text-lg font-medium text-gray-700 dark:text-gray-200">User List</h3>
                        <a href="{{ route('users.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white dark:text-gray-200 rounded-lg shadow hover:bg-blue-700 focus:outline-none">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            New User
                        </a>
                    </div>

                    <!-- Table -->
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700 text-left text-sm leading-normal">
                                <th class="px-6 py-3 text-gray-600 dark:text-gray-300 font-semibold">Profile</th>
                                <th class="px-6 py-3 text-gray-600 dark:text-gray-300 font-semibold">Name</th>
                                <th class="px-6 py-3 text-gray-600 dark:text-gray-300 font-semibold">Email</th>
                                <th class="px-6 py-3 text-gray-600 dark:text-gray-300 font-semibold">Date Created</th>
                                <th class="px-6 py-3 text-gray-600 dark:text-gray-300 font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 dark:text-gray-200 text-sm font-light">
                            @foreach($users as $user)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="px-6 py-4">
                                    <img class="w-10 h-10 rounded-full" src="{{ $user->profile ? Storage::url($user->profile) . '?' . time() : 'default-image-path.jpg' }}" alt="users-profile">

                                </td>
                                <td class="px-6 py-4">{{ $user->name}}</td>
                                <td class="px-6 py-4">{{ $user->email}}</td>
                                <td class="px-6 py-4">{{ $user->created_at}}</td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <!-- Edit Icon -->
                                    <a href="{{ route('user.edit', $user->id ) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                        <svg xmlns="#" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M16.586 3.414a2 2 0 112.828 2.828L11 14l-4 1 1-4 7.586-7.586z" />
                                        </svg>
                                    </a>
                                    <!-- Delete Icon -->
                                    <form action="{{ route('user.delete', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline" onclick="return confirm('Are you sure you want to delete your profile?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M4 7h16M10 7V4a1 1 0 011-1h2a1 1 0 011 1v3" />
                                            </svg>
                                        </button>
                                    </form>                                                                      
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
