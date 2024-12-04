    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ isset($product) ? __('Edit Product') : __('Create New Product') }}
            </h2>
        </x-slot>

        <div class="py-12 bg-gray-100 dark:bg-gray-900">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Form container with custom background color -->
                <div class="bg-[#1c2a3a] dark:bg-gray-800 shadow-lg sm:rounded-lg overflow-hidden">
                    <div class="p-6">
                        <!-- Form for creating a new product -->
                        <form method="POST" action="{{isset($product) ? route('product.update', $product->product_id) : route('product.store') }}" enctype="multipart/form-data">
                            @csrf
                            @isset($product)

                            @method('PUT')
                                
                            @endisset
                            <!-- Product Image Upload with Preview -->
                            <div class="mt-4">
                                <label for="product_image" class="block text-gray-200">Product Image</label>
                                <input id="product_image" type="file" name="product_image" accept="image/*"
                                    class="block mt-1 w-full bg-[#1c2a3a] text-white" onchange="previewProductImage(event)">
                                <img id="product-image-preview" class="mt-2 w-32 h-32 rounded" style="display: none;" alt="Product Image Preview">
                                <x-input-error :messages="$errors->get('product_image')" class="mt-2" />
                            </div>

                            <!-- Product Name Input -->
                            <div class="mt-4">
                                <label for="product_name" class="block text-gray-200">Product Name</label>
                                <input id="product_name" type="text" name="product_name" value="{{ isset($product) ? $product->product_name : old ('product_name')}}"
                                    class="block mt-1 w-full bg-[#1c2a3a] text-white">
                                <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
                            </div>

                            <!-- Product Category Input -->
                            <div class="mt-4">
                                <label for="product_category" class="block text-gray-200">Category</label>
                                <select id="product_category" name="product_category"
                                    class="block mt-1 w-full bg-[#1c2a3a] text-white">
                                    <option value="" disabled selected>Select a category</option>
                                    @foreach ($categories as $index => $category)
                                    <option value="{{ $category->category_id}}" {{ isset($product) && $product->category_id == $category->category_id ? 'selected' : ''}}>
                                        {{ $index + 1}}. {{  $category->category_name }}</option>
                                    @endforeach
                                    <!-- Add dynamic category options here -->
                                </select>
                                <x-input-error :messages="$errors->get('product_category')" class="mt-2" />
                            </div>

                            <!-- Product Price Input -->
                            <div class="mt-4">
                                <label for="price" class="block text-gray-200">Price</label>
                                <input id="price" type="number" name="price" value="{{ isset($product) ? $product->price : old ('price')}}"
                                    class="block mt-1 w-full bg-[#1c2a3a] text-white">
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>

                            <!-- Product Stock Input -->
                            <div class="mt-4">
                                <label for="stocks" class="block text-gray-200">Stocks</label>
                                <input id="stocks" type="number" name="stocks" value="{{ isset($product) ? $product->stocks : old ('stocks')}}"
                                    class="block mt-1 w-full bg-[#1c2a3a] text-white">
                                <x-input-error :messages="$errors->get('stocks')" class="mt-2" />
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-4">
                                <button class="px-4 py-2 bg-blue-600 text-white rounded-md">
                                    {{ isset($product) ? __('Submit') : __('Create New Product') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript for Image Preview -->
        <script>
            function previewProductImage(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const output = document.getElementById('product-image-preview');
                    output.src = reader.result;
                    output.style.display = 'block'; // Show the image preview
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    </x-app-layout>
