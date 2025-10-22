@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
/* Custom Scrollbar Styling - Larger Size */
.custom-scrollbar {
    scrollbar-width: auto;
    scrollbar-color: #ec4899 #fce7f3;
}

.custom-scrollbar::-webkit-scrollbar {
    width: 20px;
    height: 20px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #fce7f3;
    border-radius: 10px;
    border: 2px solid #fdf2f8;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #ec4899, #f472b6);
    border-radius: 10px;
    border: 2px solid #fce7f3;
    box-shadow: 0 2px 4px rgba(236, 72, 153, 0.2);
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #db2777, #ec4899);
    box-shadow: 0 4px 8px rgba(236, 72, 153, 0.3);
}

.custom-scrollbar::-webkit-scrollbar-button {
    display: block;
    height: 24px;
    width: 20px;
    background: linear-gradient(135deg, #f472b6, #ec4899);
    border-radius: 8px;
    border: 1px solid #fce7f3;
}

.custom-scrollbar::-webkit-scrollbar-button:hover {
    background: linear-gradient(135deg, #ec4899, #db2777);
}

.custom-scrollbar::-webkit-scrollbar-button:start:decrement {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23ffffff' d='M6 0l6 6-6 6V0z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: center;
    background-size: 12px 12px;
}

.custom-scrollbar::-webkit-scrollbar-button:end:increment {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23ffffff' d='M6 12L0 6l6-6v12z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: center;
    background-size: 12px 12px;
}
</style>
<!-- Welcome Hero Section with Auto-Scrolling Images - Full Edge to Edge, No Gap -->
<div class="relative overflow-hidden -mt-6 h-[350px] sm:h-[400px] md:h-[450px] lg:h-[500px] xl:h-[550px]" style="margin-left: calc(-50vw + 50%); margin-right: calc(-50vw + 50%);">

    <!-- Auto-scrolling Background Images -->
    <div class="absolute inset-0">
        <div id="hero-images-container" class="flex w-full h-full transition-transform duration-2000 ease-in-out">
            <div class="w-full h-full flex-shrink-0">
                <img src="{{ asset('images/strawberry-farm.webp') }}" 
                     alt="Kebun Strawberry" 
                     class="w-full h-full object-cover">
            </div>
            <div class="w-full h-full flex-shrink-0">
                <img src="{{ asset('images/images2.jpg') }}" 
                     alt="Kebun Strawberry Kami" 
                     class="w-full h-full object-cover">
            </div>
            <div class="w-full h-full flex-shrink-0">
                <img src="{{ asset('images/WhatsApp Image 2025-10-21 at 18.40.35_5087f647.jpg') }}" 
                     alt="Foto Kebun Strawberry" 
                     class="w-full h-full object-cover">
            </div>
            <div class="w-full h-full flex-shrink-0">
                <img src="{{ asset('images/WhatsApp Image 2025-10-21 at 18.40.35_81ba61b9.jpg') }}" 
                     alt="Foto Kebun Strawberry" 
                     class="w-full h-full object-cover">
            </div>
            <div class="w-full h-full flex-shrink-0">
                <img src="{{ asset('images/WhatsApp Image 2025-10-21 at 18.40.38_e4378a0f.jpg') }}" 
                     alt="Foto Kebun Strawberry" 
                     class="w-full h-full object-cover">
        </div>
            <div class="w-full h-full flex-shrink-0">
                <img src="{{ asset('images/WhatsApp Image 2025-10-21 at 18.40.39_a11ad240.jpg') }}" 
                     alt="Foto Kebun Strawberry" 
                     class="w-full h-full object-cover">
        </div>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-black/40 to-black/30"></div>
    </div>

    <!-- Welcome Content -->
    <div class="relative z-10 h-full flex flex-col justify-center mx-auto px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16">
        <div class="w-full lg:w-3/4 xl:w-2/3 2xl:w-1/2">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-white mb-3 sm:mb-4 leading-tight" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5), 4px 4px 8px rgba(0, 0, 0, 0.3);">
                Selamat Datang di Ovaltin! 🍓
            </h1>
            <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-100 mb-6 sm:mb-8 leading-relaxed" style="text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5), 2px 2px 6px rgba(0, 0, 0, 0.3);">
                Nikmati strawberry segar berkualitas premium langsung dari kebun kami
            </p>
            <div class="flex flex-wrap gap-3 sm:gap-4">
                <a href="{{ route('user.products.index') }}" class="inline-flex items-center px-5 py-3 sm:px-6 sm:py-3 md:px-8 md:py-4 bg-white text-gray-900 rounded-lg font-bold hover:bg-gray-100 transition transform hover:scale-105 shadow-xl text-sm sm:text-base md:text-lg">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Lihat Produk Kami
                </a>
                    </div>
                </div>
            </div>
        </div>

<div class="space-y-4 sm:space-y-6 mt-6 sm:mt-8">

    <!-- Produk Strawberry Kami - Pink Theme -->
    <div id="produk" class="bg-white shadow-lg rounded-xl sm:rounded-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-pink-50 to-rose-50 px-4 sm:px-6 py-4 sm:py-5 border-b border-pink-100">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                <svg class="w-6 h-6 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                Produk Strawberry Kami
            </h2>
        </div>
        <div class="p-6 sm:p-8">
            @if($products->count() > 0)
                <div class="mb-6 text-center">
                    <p class="text-gray-600 text-sm">Menampilkan {{ $products->count() }} produk strawberry tersedia</p>
                    <p class="text-xs text-gray-500 mt-1">Geser untuk melihat lebih banyak produk</p>
    </div>

                <!-- Horizontal Scroll Container -->
                <div class="relative">
                    <!-- Left Arrow -->
                    <button id="scrollLeft" class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white hover:bg-pink-50 text-pink-600 rounded-full p-3 shadow-lg hover:shadow-xl transition-all duration-200 border-2 border-pink-200 hover:border-pink-400 hidden md:block">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Right Arrow -->
                    <button id="scrollRight" class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white hover:bg-pink-50 text-pink-600 rounded-full p-3 shadow-lg hover:shadow-xl transition-all duration-200 border-2 border-pink-200 hover:border-pink-400 hidden md:block">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    
                    <div id="productsContainer" class="overflow-x-auto custom-scrollbar">
                        <div id="productsScroll" class="flex space-x-6 pb-4 transition-transform duration-300 ease-in-out" style="width: max-content;">
                            @foreach($products as $product)
                                <div class="flex-shrink-0 w-80 sm:w-72 lg:w-80">
                                    <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border-2 border-pink-100 h-full">
                                        @if($product->image)
                                            <div class="h-48 overflow-hidden bg-pink-100">
                                                <img src="{{ asset('storage/' . $product->image) }}" 
                                                     alt="{{ $product->name }}" 
                                                     class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div class="h-48 bg-gradient-to-br from-pink-200 to-rose-200 flex items-center justify-center">
                                                <svg class="w-20 h-20 text-pink-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                                        @endif
                                        <div class="p-5">
                                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $product->name }}</h3>
                                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-2xl font-bold text-pink-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                                    <p class="text-xs text-gray-500">Per {{ $product->unit }}</p>
                                                </div>
                                                <div class="bg-gradient-to-r from-pink-100 to-rose-100 px-3 py-1 rounded-full">
                                                    <p class="text-sm font-semibold text-pink-700">
                                                        Stok: 
                                                        @if($product->status === 'out_of_stock')
                                                            <span class="text-red-600">0</span>
                                                        @else
                                                            {{ $product->stock_quantity }}
                                                        @endif
                                                    </p>
                                                </div>
                                                @if($product->status === 'out_of_stock')
                                                    <div class="bg-gradient-to-r from-red-100 to-red-200 px-3 py-1 rounded-full">
                                                        <p class="text-sm font-semibold text-red-700">Habis Stok</p>
                    </div>
                                                @endif
                    </div>
                </div>
            </div>
        </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Scroll Indicators -->
                    <div class="flex justify-center mt-4 space-x-2">
                        @for($i = 0; $i < ceil($products->count() / 6); $i++)
                            <div class="w-2 h-2 bg-pink-300 rounded-full"></div>
                        @endfor
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-24 h-24 text-pink-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">Belum ada produk tersedia</p>
                </div>
            @endif
            </div>
        </div>

    <!-- Tentang Kami - Pink Theme -->
    <div id="tentang-kami" class="bg-white shadow-lg rounded-xl sm:rounded-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-pink-50 to-rose-50 px-4 sm:px-6 py-4 sm:py-5 border-b border-pink-100">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                <svg class="w-6 h-6 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                Tentang Kami
            </h2>
                        </div>
        <div class="p-6 sm:p-8">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Strawberry Segar dari Kebun Kami</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Kami adalah produsen strawberry premium yang berlokasi di dataran tinggi dengan iklim sempurna untuk menghasilkan strawberry berkualitas terbaik. Setiap buah dipetik dengan hati-hati saat matang sempurna untuk memastikan rasa dan kesegaran yang optimal.
                    </p>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Dengan metode pertanian organik dan perawatan yang teliti, kami menghadirkan strawberry yang tidak hanya lezat, tetapi juga sehat dan bergizi tinggi.
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-pink-50 p-4 rounded-xl border-2 border-pink-200">
                            <p class="text-2xl font-bold text-pink-600 mb-1">Segar</p>
                            <p class="text-sm text-gray-600">Dari Kebun</p>
                    </div>
                        <div class="bg-rose-50 p-4 rounded-xl border-2 border-rose-200">
                            <p class="text-2xl font-bold text-rose-600 mb-1">100%</p>
                            <p class="text-sm text-gray-600">Organik Murni</p>
                    </div>
                        </div>
                    </div>
                <div class="relative">
                    <div class="bg-gradient-to-br from-pink-100 to-rose-100 rounded-2xl overflow-hidden h-[250px] sm:h-[280px] md:h-[320px] lg:h-[350px] xl:h-[380px] flex items-start justify-center pt-8">
                        <img src="{{ asset('images/images2.jpg') }}" 
                             alt="Kebun Strawberry Kami" 
                             class="w-full h-full object-cover rounded-2xl object-bottom">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Testimoni Pelanggan - Pink Theme -->
    <div id="testimoni" class="bg-white shadow-lg rounded-xl sm:rounded-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-pink-50 to-rose-50 px-4 sm:px-6 py-4 sm:py-5 border-b border-pink-100">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                <svg class="w-6 h-6 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                Apa Kata Pelanggan Kami
            </h2>
                                </div>
        <div class="p-6 sm:p-8">
            @if($testimonials->count() > 0)
                <!-- Auto-scrolling testimonials container -->
                <div class="relative overflow-hidden rounded-xl">
                    <div id="testimonials-container" class="flex transition-transform duration-1000 ease-in-out" style="width: {{ $testimonials->count() * 33.333 }}%;">
                        @foreach($testimonials as $index => $testimonial)
                            <div class="w-1/3 px-3 flex-shrink-0">
                                <div class="bg-gradient-to-br {{ $index % 3 == 0 ? 'from-pink-50 to-rose-50 border-pink-100' : ($index % 3 == 1 ? 'from-rose-50 to-pink-50 border-rose-100' : 'from-pink-50 to-rose-50 border-pink-100') }} rounded-2xl p-6 hover:shadow-lg transition border-2 h-full">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 bg-gradient-to-br {{ $index % 3 == 0 ? 'from-pink-400 to-pink-500' : ($index % 3 == 1 ? 'from-rose-400 to-rose-500' : 'from-pink-500 to-rose-600') }} rounded-full flex items-center justify-center text-white font-bold text-lg">
                                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                            </div>
                                        <div class="ml-3">
                                            <h4 class="font-bold text-gray-900">{{ $testimonial->name }}</h4>
                                            <div class="flex text-yellow-400">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $testimonial->rating ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endfor
                </div>
            </div>
        </div>
                                    <p class="text-gray-600 italic">"{{ $testimonial->message }}"</p>
                                </div>
                        </div>
                    @endforeach
        </div>
    </div>

                <!-- Navigation controls -->
                <div class="mt-6 flex items-center justify-center space-x-4">
                    <button id="prev-btn" class="bg-pink-500 hover:bg-pink-600 text-white p-3 rounded-full transition transform hover:scale-110 shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button id="next-btn" class="bg-pink-500 hover:bg-pink-600 text-white p-3 rounded-full transition transform hover:scale-110 shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
            </div>
                                            @else
                <div class="text-center py-8">
                    <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-2xl p-8 border-2 border-pink-100">
                        <svg class="w-16 h-16 text-pink-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Testimoni</h3>
                        <p class="text-gray-600 mb-4">Jadilah yang pertama memberikan testimoni untuk produk strawberry kami!</p>
                        @if(!Auth::user()->isAdmin())
                            <a href="{{ route('testimonials.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg hover:from-pink-600 hover:to-rose-600 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                    </svg>
                                Berikan Testimoni
                            </a>
                        @endif
                    </div>
                                                </div>
                                            @endif
        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('testimonials-container');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    
    if (!container) return;
    
    let currentIndex = 0;
    let intervalId;
    
    const testimonials = container.children;
    const totalTestimonials = testimonials.length;
    
    // Jika testimoni kurang dari 4, sembunyikan navigasi
    if (totalTestimonials <= 3) {
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'none';
        return;
    }
    
    function updatePosition() {
        const translateX = -(currentIndex * 33.333); // 33.333% per testimoni (3 per view)
        container.style.transform = `translateX(${translateX}%)`;
    }
    
    function nextSlide() {
        currentIndex++;
        if (currentIndex >= totalTestimonials - 2) { // -2 karena kita show 3 per view
            currentIndex = 0; // Loop kembali ke awal
        }
        updatePosition();
    }
    
    function prevSlide() {
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = totalTestimonials - 3; // Loop ke akhir
        }
        updatePosition();
    }
    
    function startAutoScroll() {
        if (intervalId) clearInterval(intervalId);
        intervalId = setInterval(nextSlide, 3000); // 3 detik per slide
    }
    
    function pauseAutoScroll() {
        if (intervalId) {
            clearInterval(intervalId);
            intervalId = null;
        }
    }
    
    // Event listeners untuk navigasi manual
    nextBtn.addEventListener('click', function() {
        pauseAutoScroll();
        nextSlide();
        startAutoScroll(); // Restart auto-scroll setelah manual navigation
    });
    
    prevBtn.addEventListener('click', function() {
        pauseAutoScroll();
        prevSlide();
        startAutoScroll(); // Restart auto-scroll setelah manual navigation
    });
    
    // Pause on hover
    container.addEventListener('mouseenter', function() {
        pauseAutoScroll();
    });
    
    container.addEventListener('mouseleave', function() {
        startAutoScroll();
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            pauseAutoScroll();
            prevSlide();
            startAutoScroll();
        } else if (e.key === 'ArrowRight') {
            pauseAutoScroll();
            nextSlide();
            startAutoScroll();
        }
    });
    
    // Start auto-scroll
    startAutoScroll();
});

// Auto-scroll untuk hero section
document.addEventListener('DOMContentLoaded', function() {
    const heroImagesContainer = document.getElementById('hero-images-container');
    
    if (!heroImagesContainer) return;
    
    let currentIndex = 0;
    let intervalId;
    
    const images = heroImagesContainer.children;
    const totalImages = images.length;
    
    // Duplikasi foto untuk looping yang smooth
    function duplicateHeroImages() {
        const container = heroImagesContainer;
        const originalImages = Array.from(images);
        
        // Tambahkan duplikasi di akhir
        originalImages.forEach(img => {
            const clone = img.cloneNode(true);
            container.appendChild(clone);
        });
    }
    
    duplicateHeroImages();
    
    function moveHeroImages() {
        currentIndex++;
        const translateX = -(currentIndex * 100); // 100% per slide
        
        heroImagesContainer.style.transform = `translateX(${translateX}%)`;
        
        // Jika sudah sampai duplikasi pertama, reset ke posisi awal
        if (currentIndex >= totalImages) {
            setTimeout(() => {
                heroImagesContainer.style.transition = 'none';
                currentIndex = 0;
                heroImagesContainer.style.transform = 'translateX(0%)';
                setTimeout(() => {
                    heroImagesContainer.style.transition = 'transform 2s ease-in-out';
                }, 50);
            }, 2000);
        }
    }
    
    function startHeroAutoScroll() {
        if (intervalId) clearInterval(intervalId);
        intervalId = setInterval(moveHeroImages, 4000); // 4 detik per slide
    }
    
    function pauseHeroAutoScroll() {
        if (intervalId) {
            clearInterval(intervalId);
            intervalId = null;
        }
    }
    
    // Pause on hover
    heroImagesContainer.addEventListener('mouseenter', function() {
        pauseHeroAutoScroll();
    });
    
    heroImagesContainer.addEventListener('mouseleave', function() {
        startHeroAutoScroll();
    });
    
    // Start auto-scroll
    startHeroAutoScroll();
    
    // Product carousel navigation
    const scrollLeftBtn = document.getElementById('scrollLeft');
    const scrollRightBtn = document.getElementById('scrollRight');
    const productsContainer = document.getElementById('productsContainer');
    
    if (scrollLeftBtn && scrollRightBtn && productsContainer) {
        scrollLeftBtn.addEventListener('click', function() {
            productsContainer.scrollBy({
                left: -400,
                behavior: 'smooth'
            });
        });
        
        scrollRightBtn.addEventListener('click', function() {
            productsContainer.scrollBy({
                left: 400,
                behavior: 'smooth'
            });
        });
        
        // Show/hide arrows based on scroll position
        function updateArrows() {
            const scrollLeft = productsContainer.scrollLeft;
            const maxScroll = productsContainer.scrollWidth - productsContainer.clientWidth;
            
            scrollLeftBtn.style.opacity = scrollLeft > 0 ? '1' : '0.5';
            scrollLeftBtn.style.pointerEvents = scrollLeft > 0 ? 'auto' : 'none';
            
            scrollRightBtn.style.opacity = scrollLeft < maxScroll - 10 ? '1' : '0.5';
            scrollRightBtn.style.pointerEvents = scrollLeft < maxScroll - 10 ? 'auto' : 'none';
        }
        
        productsContainer.addEventListener('scroll', updateArrows);
        updateArrows();
    }
});
</script>

