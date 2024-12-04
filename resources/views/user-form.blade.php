    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create New User') }}
            </h2>
        </x-slot>

        <div class="py-12 bg-gray-100 dark:bg-gray-900">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Form container with custom background color -->
                <div class="bg-[#1c2a3a] dark:bg-gray-800 shadow-lg sm:rounded-lg overflow-hidden">
                    <div class="p-6">
                        <!-- Form for creating a new user -->
                        <form method="POST" action="{{ isset($user) ? route('user.update', $user->id) : route('users.store') }}" enctype="multipart/form-data">
                            @csrf
                            
                            @isset($user)
                                @method('PUT')
                            @endisset

                            <!-- Profile Upload with Image Preview -->
                            <div class="mt-4">
                                <label for="profile" class="block text-gray-200">Profile Picture</label>
                                <input id="profile" type="file" name="profile" accept="image/*" class="block mt-1 w-full bg-[#1c2a3a] text-white" onchange="previewImage(event)">
                                <img id="image-preview" class="mt-2 w-32 h-32 rounded-full" style="display: none;" alt="Profile Picture Preview">
                                <x-input-error :messages="$errors->get('profile')" class="mt-2" />
                            </div>

                            <!-- Name Input -->
                            <div class="mt-4">
                                <label for="name" class="block text-gray-200">Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="block mt-1 w-full bg-[#1c2a3a] text-white">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email Input -->
                            <div class="mt-4">
                                <label for="email" class="block text-gray-200">Email Address</label>
                                <input id="email" type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="block mt-1 w-full bg-[#1c2a3a] text-white">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password Input -->
                            <div class="mt-4">
                                <label for="password" class="block text-gray-200">Password</label>
                                <input id="password" type="password" name="password" class="block mt-1 w-full bg-[#1c2a3a] text-white">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="mt-4">
                                <label for="password_confirmation" class="block text-gray-200">Confirm Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" class="block mt-1 w-full bg-[#1c2a3a] text-white">
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-4">
                                <button class="px-4 py-2 bg-blue-600 text-white rounded-md">
                                    @isset($user)
                                        SAVE
                                        @else
                                        SUBMIT
                                    @endisset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript for Image Preview -->
        <script>
            function previewImage(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const output = document.getElementById('image-preview');
                    output.src = reader.result;
                    output.style.display = 'block'; // Show the image preview
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    </x-app-layout>
