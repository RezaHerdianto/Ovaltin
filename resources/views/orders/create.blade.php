@extends('layouts.app')

@section('title', 'Buat Pemesanan')

@section('content')
<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-red-600">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    Admin Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <a href="{{ route('admin.orders.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-red-600 md:ml-2">Pemesanan</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Buat Pemesanan</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Form Pemesanan -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="bg-pink-500 px-6 py-4">
            <h1 class="text-2xl font-bold text-white">Form Pemesanan</h1>
            <p class="text-red-100 mt-1">Isi form di bawah ini untuk membuat pesanan</p>
        </div>

        <form action="{{ route('admin.orders.store') }}" method="POST" class="p-6" id="orderForm">
            @csrf

            <!-- Informasi Pemesan -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Informasi Pemesan
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Pemesan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="customer_name" id="customer_name" 
                            value="{{ old('customer_name', auth()->user()->name) }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500 @error('customer_name') border-red-500 @enderror"
                            required>
                        @error('customer_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor HP <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="customer_phone" id="customer_phone" 
                            value="{{ old('customer_phone') }}"
                            placeholder="081234567890"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500 @error('customer_phone') border-red-500 @enderror"
                            required>
                        @error('customer_phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat <span class="text-red-500">*</span>
                    </label>
                    <textarea name="customer_address" id="customer_address" rows="3"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500 @error('customer_address') border-red-500 @enderror"
                        required>{{ old('customer_address') }}</textarea>
                    @error('customer_address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="delivery_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Pesanan Diterima <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="delivery_date" id="delivery_date" 
                        value="{{ old('delivery_date') }}"
                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500 @error('delivery_date') border-red-500 @enderror"
                        required>
                    <p class="mt-1 text-sm text-gray-500">Pilih tanggal kapan pesanan ingin diterima</p>
                    @error('delivery_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Produk yang Dipesan -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Produk yang Dipesan
                </h2>

                <div id="products-container" class="space-y-4">
                    <!-- Product Item Template -->
                    <div class="product-item border border-gray-200 rounded-lg p-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Produk <span class="text-red-500">*</span>
                                </label>
                                <select name="products[0][product_id]" 
                                    class="product-select w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500"
                                    required>
                                    <option value="">Pilih Produk</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" 
                                            data-price="{{ $product->price }}"
                                            data-stock="{{ $product->stock_quantity }}">
                                            {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }} (Stok: {{ $product->stock_quantity }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Jumlah <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="products[0][quantity]" 
                                    min="1" value="1"
                                    class="quantity-input w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500"
                                    required>
                            </div>

                            <div class="flex items-end">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Subtotal
                                    </label>
                                    <div class="text-lg font-semibold text-red-600 subtotal-display">
                                        Rp 0
                                    </div>
                                </div>
                                <button type="button" class="remove-product ml-2 px-3 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" id="add-product" class="mt-4 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    + Tambah Produk
                </button>

                @error('products')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catatan -->
            <div class="mb-8">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Catatan (Opsional)
                </label>
                <textarea name="notes" id="notes" rows="3"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">{{ old('notes') }}</textarea>
            </div>

            <!-- Total -->
            <div class="mb-6 p-4 bg-red-50 rounded-lg border-2 border-red-200">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold text-gray-900">Total Pembayaran:</span>
                    <span class="text-2xl font-bold text-red-600" id="total-amount">Rp 0</span>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.orders.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-pink-500 text-white rounded-lg hover:bg-pink-600 font-semibold">
                    Buat Pemesanan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let productIndex = 1;

// Add product row
document.getElementById('add-product').addEventListener('click', function() {
    const container = document.getElementById('products-container');
    const template = container.querySelector('.product-item').cloneNode(true);
    
    // Update input names
    const selects = template.querySelectorAll('select, input');
    selects.forEach(select => {
        if (select.name) {
            select.name = select.name.replace(/\[0\]/, `[${productIndex}]`);
        }
        if (select.classList.contains('product-select')) {
            select.value = '';
        }
        if (select.classList.contains('quantity-input')) {
            select.value = 1;
        }
    });
    
    template.querySelector('.subtotal-display').textContent = 'Rp 0';
    
    container.appendChild(template);
    productIndex++;
    
    attachEventListeners(template);
});

// Remove product row
document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-product')) {
        const productItem = e.target.closest('.product-item');
        if (document.querySelectorAll('.product-item').length > 1) {
            productItem.remove();
            calculateTotal();
        } else {
            alert('Minimal harus ada 1 produk');
        }
    }
});

// Calculate subtotal and total
function calculateSubtotal(item) {
    const select = item.querySelector('.product-select');
    const quantityInput = item.querySelector('.quantity-input');
    const subtotalDisplay = item.querySelector('.subtotal-display');
    
    const price = parseFloat(select.options[select.selectedIndex]?.dataset.price || 0);
    const quantity = parseInt(quantityInput.value || 0);
    const subtotal = price * quantity;
    
    subtotalDisplay.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    
    calculateTotal();
}

// Calculate total
function calculateTotal() {
    let total = 0;
    document.querySelectorAll('.product-item').forEach(item => {
        const select = item.querySelector('.product-select');
        const quantityInput = item.querySelector('.quantity-input');
        const price = parseFloat(select.options[select.selectedIndex]?.dataset.price || 0);
        const quantity = parseInt(quantityInput.value || 0);
        total += price * quantity;
    });
    
    document.getElementById('total-amount').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

// Attach event listeners
function attachEventListeners(item) {
    const select = item.querySelector('.product-select');
    const quantityInput = item.querySelector('.quantity-input');
    
    select.addEventListener('change', () => {
        const stock = parseInt(select.options[select.selectedIndex]?.dataset.stock || 0);
        quantityInput.max = stock;
        if (parseInt(quantityInput.value) > stock) {
            quantityInput.value = stock;
        }
        calculateSubtotal(item);
    });
    
    quantityInput.addEventListener('input', () => {
        const stock = parseInt(select.options[select.selectedIndex]?.dataset.stock || 0);
        if (parseInt(quantityInput.value) > stock) {
            quantityInput.value = stock;
        }
        calculateSubtotal(item);
    });
}

// Initialize
document.querySelectorAll('.product-item').forEach(item => {
    attachEventListeners(item);
});
</script>
@endsection

