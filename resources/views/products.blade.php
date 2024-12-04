<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <!-- Header -->
                    <header class="flex flex-row justify-end">
                        <a href="{{ route('product.create') }}" class="flex flex-row bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            New Product
                        </a>
                    </header>
                    
                    <!-- Table -->
                    <table class="min-w-full border-collapse border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700 text-left text-gray-600 dark:text-gray-300 uppercase text-sm leading-normal">
                                <th class="py-3 px-6">IMAGE</th>
                                <th class="py-3 px-6">Product Name</th>
                                <th class="py-3 px-6">Category</th>
                                <th class="py-3 px-6">Price</th>
                                <th class="py-3 px-6">Stocks</th>
                                <th class="py-3 px-6">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 dark:text-gray-200 text-sm font-light">
                            @foreach($products as $product)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="py-3 px-6">
                                    <img src="{{ isset($product->product_image) ? asset('storage/Uploads/Product Images/' . $product->product_image)  : asset('storage/Uploads/Product Images/Screenshot 2024-12-01 202917-1733111004.png') }}" class="w-10 h-10 rounded-full" alt="Product Images">
                                    
                                </td>
                                <td class="py-3 px-6">{{ $product->product_name}}</td>
                                <td class="py-3 px-6">{{ $product->product_category}}</td>
                                <td class="py-3 px-6">{{ $product->price}}</td>
                                <td class="py-3 px-6">{{ $product->stocks}}</td>
                                <td class="py-3 px-6 flex space-x-2">
                                    <a title="EDIT" href="{{ route('product.edit', $product->product_id) }}" class="bg-blue-600 dark:bg-blue-500 text-white py-1 px-4 rounded hover:bg-blue-700 dark:hover:bg-blue-600 transition duration-300">
                                        EDIT
                                    </a>
                                    <form action="{{ route('product.delete', $product->product_id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            title="DELETE"
                                            class="bg-red-600 dark:bg-red-500 text-white py-1 px-4 rounded hover:bg-red-700 dark:hover:bg-red-600 transition duration-300"
                                            onclick="return confirm('Are you sure you want to delete this product?');">
                                            DELETE
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
