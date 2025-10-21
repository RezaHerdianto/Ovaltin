@extends('layouts.app')

@section('title', 'Edit Produk Stroberi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="space-y-6">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Edit Produk Stroberi
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Edit informasi produk stroberi: {{ $strawberryProduct->name }}
                </p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('strawberry-products.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white shadow rounded-lg">
            <form action="{{ route('strawberry-products.update', $strawberryProduct) }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Product Name -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $strawberryProduct->name) }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('name') border-red-300 @enderror">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="sm:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="3" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('description') border-red-300 @enderror">{{ old('description', $strawberryProduct->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $strawberryProduct->price) }}" step="0.01" min="0" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('price') border-red-300 @enderror">
                        @error('price')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock Quantity -->
                    <div>
                        <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Jumlah Stok</label>
                        <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $strawberryProduct->stock_quantity) }}" min="0" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('stock_quantity') border-red-300 @enderror">
                        @error('stock_quantity')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category" id="category" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('category') border-red-300 @enderror">
                            <option value="">Pilih Kategori</option>
                            <option value="Fresh Strawberry" {{ old('category', $strawberryProduct->category) == 'Fresh Strawberry' ? 'selected' : '' }}>Fresh Strawberry</option>
                            <option value="Frozen Strawberry" {{ old('category', $strawberryProduct->category) == 'Frozen Strawberry' ? 'selected' : '' }}>Frozen Strawberry</option>
                            <option value="Strawberry Jam" {{ old('category', $strawberryProduct->category) == 'Strawberry Jam' ? 'selected' : '' }}>Strawberry Jam</option>
                            <option value="Strawberry Juice" {{ old('category', $strawberryProduct->category) == 'Strawberry Juice' ? 'selected' : '' }}>Strawberry Juice</option>
                            <option value="Strawberry Dessert" {{ old('category', $strawberryProduct->category) == 'Strawberry Dessert' ? 'selected' : '' }}>Strawberry Dessert</option>
                        </select>
                        @error('category')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Origin -->
                    <div>
                        <label for="origin" class="block text-sm font-medium text-gray-700">Asal Produk</label>
                        <input type="text" name="origin" id="origin" value="{{ old('origin', $strawberryProduct->origin) }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('origin') border-red-300 @enderror">
                        @error('origin')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status Produk</label>
                        <select name="status" id="status" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('status') border-red-300 @enderror">
                            <option value="">Pilih Status</option>
                            <option value="active" {{ old('status', $strawberryProduct->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status', $strawberryProduct->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                            <option value="out_of_stock" {{ old('status', $strawberryProduct->status) == 'out_of_stock' ? 'selected' : '' }}>Habis Stok</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Harvest Date -->
                    <div>
                        <label for="harvest_date" class="block text-sm font-medium text-gray-700">Tanggal Panen</label>
                        <input type="date" name="harvest_date" id="harvest_date" value="{{ old('harvest_date', $strawberryProduct->harvest_date->format('Y-m-d')) }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('harvest_date') border-red-300 @enderror">
                        @error('harvest_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="sm:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                        
                        <!-- Current Image -->
                        @if($strawberryProduct->image)
                            <div class="mt-2 mb-4">
                                <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $strawberryProduct->image) }}" alt="Current Image" class="h-32 w-32 object-cover rounded-lg shadow-md">
                            </div>
                        @endif
                        
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-pink-400 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-pink-600 hover:text-pink-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-pink-500">
                                        <span>Upload gambar baru</span>
                                        <input id="image" name="image" type="file" accept="image/*" class="sr-only" onchange="previewImage(this)">
                                    </label>
                                    <p class="pl-1">atau drag & drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, WEBP hingga 10MB</p>
                            </div>
                        </div>
                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-4 hidden">
                            <img id="previewImg" src="" alt="Preview" class="mx-auto h-32 w-32 object-cover rounded-lg shadow-md">
                            <p class="mt-2 text-center text-sm text-gray-600">Preview gambar baru</p>
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nutritional Info -->
                    <div class="sm:col-span-2">
                        <label for="nutritional_info" class="block text-sm font-medium text-gray-700">Informasi Nutrisi (Opsional)</label>
                        <textarea name="nutritional_info" id="nutritional_info" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('nutritional_info') border-red-300 @enderror">{{ old('nutritional_info', $strawberryProduct->nutritional_info) }}</textarea>
                        @error('nutritional_info')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Is Organic -->
                    <div class="sm:col-span-2">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_organic" id="is_organic" value="1" {{ old('is_organic', $strawberryProduct->is_organic) ? 'checked' : '' }}
                                class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                            <label for="is_organic" class="ml-2 block text-sm text-gray-900">
                                Produk Organik
                            </label>
                        </div>
                        @error('is_organic')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('strawberry-products.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
function previewImage(input) {
    const file = input.files[0];
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
    }
}

// Drag and drop functionality
const dropZone = document.querySelector('.border-dashed');
const fileInput = document.getElementById('image');

dropZone.addEventListener('dragover', function(e) {
    e.preventDefault();
    dropZone.classList.add('border-pink-400', 'bg-pink-50');
});

dropZone.addEventListener('dragleave', function(e) {
    e.preventDefault();
    dropZone.classList.remove('border-pink-400', 'bg-pink-50');
});

dropZone.addEventListener('drop', function(e) {
    e.preventDefault();
    dropZone.classList.remove('border-pink-400', 'bg-pink-50');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fileInput.files = files;
        previewImage(fileInput);
    }
});
</script>
