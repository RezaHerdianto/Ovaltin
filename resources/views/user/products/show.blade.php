@extends('layouts.app')

@section('title', $product->name . ' - Detail Produk')

@section('content')
<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-pink-600">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <a href="{{ route('user.products.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-pink-600 md:ml-2">Katalog Produk</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Product Details -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="p-6 sm:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Product Image -->
                <div>
                    @if($product->image)
                        <img class="w-full h-96 object-cover rounded-xl shadow-lg" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-pink-200 to-rose-200 rounded-xl flex items-center justify-center">
                            <svg class="w-32 h-32 text-pink-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Product Information -->
                <div class="space-y-6">
                    <!-- Basic Info -->
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-pink-100 text-pink-800">
                                {{ $product->category }}
                            </span>
                            @if($product->is_organic)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Organik
                                </span>
                            @endif
                        </div>
                        
                        <!-- Status Alert -->
                        @if($product->status === 'out_of_stock')
                            <div class="mb-6">
                                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <div>
                                            <h3 class="text-sm font-medium text-red-800">Produk Habis Stok</h3>
                                            <p class="text-sm text-red-700 mt-1">Produk ini sedang tidak tersedia. Silakan hubungi kami untuk informasi lebih lanjut.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Price -->
                        <div class="mb-6">
                            <p class="text-4xl font-bold text-pink-600 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-gray-600">Per unit</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Deskripsi Produk</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                    </div>

                    <!-- Product Details -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-pink-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-2">Asal Produk</h4>
                            <p class="text-gray-700">{{ $product->origin }}</p>
                        </div>
                        <div class="bg-pink-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-2">Tanggal Panen</h4>
                            <p class="text-gray-700">{{ $product->harvest_date->format('d M Y') }}</p>
                        </div>
                        <div class="bg-pink-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-2">Stok Tersedia</h4>
                            <p class="text-gray-700">
                                @if($product->status === 'out_of_stock')
                                    <span class="text-red-600 font-semibold">0 unit</span>
                                @else
                                    {{ $product->stock_quantity }} unit
                                @endif
                            </p>
                        </div>
                        <div class="bg-pink-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-2">Status</h4>
                            <p class="text-gray-700">
                                @if($product->status === 'active')
                                    <span class="text-green-600 font-semibold">Tersedia</span>
                                @elseif($product->status === 'out_of_stock')
                                    <span class="text-red-600 font-semibold">Habis Stok</span>
                                @else
                                    <span class="text-gray-600 font-semibold">Tidak Tersedia</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Nutritional Info -->
                    @if($product->nutritional_info)
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">Informasi Nutrisi</h3>
                            <div class="bg-green-50 p-4 rounded-lg">
                                <p class="text-gray-700">{{ $product->nutritional_info }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Contact Info -->
                    <div class="bg-gradient-to-r from-pink-100 to-rose-100 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Ingin Memesan?</h3>
                        <p class="text-gray-700 mb-4">Hubungi kami untuk informasi pemesanan dan pengiriman.</p>
                        <div class="flex flex-wrap gap-3">
                            <a href="tel:+6281234567890" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                Telepon
                            </a>
                            <a href="https://wa.me/6281234567890" class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                                WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <div class="p-6 sm:p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border-2 border-pink-100">
                            @if($relatedProduct->image)
                                <div class="h-32 overflow-hidden bg-pink-100">
                                    <img src="{{ asset('storage/' . $relatedProduct->image) }}" 
                                         alt="{{ $relatedProduct->name }}" 
                                         class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="h-32 bg-gradient-to-br from-pink-200 to-rose-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-pink-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-bold text-gray-900 mb-2 text-sm">{{ $relatedProduct->name }}</h3>
                                <p class="text-lg font-bold text-pink-600 mb-2">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</p>
                                <a href="{{ route('user.products.show', $relatedProduct) }}" class="w-full inline-flex items-center justify-center px-3 py-2 border border-transparent rounded-lg text-xs font-medium text-white bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 transition-all duration-200">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
