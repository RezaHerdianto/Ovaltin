@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Welcome Hero Section with Strawberry Image - Full Edge to Edge, No Gap -->
<div class="relative overflow-hidden -mt-6 h-[350px] sm:h-[400px] md:h-[450px] lg:h-[500px] xl:h-[550px]" style="margin-left: calc(-50vw + 50%); margin-right: calc(-50vw + 50%);">

    <!-- Background Image with Gradient Overlay -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/strawberry-farm.webp') }}" 
             alt="Kebun Strawberry" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-black/40 to-black/30"></div>
    </div>
    
    <!-- Welcome Content -->
    <div class="relative z-10 h-full flex flex-col justify-center mx-auto px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16">
        <div class="w-full lg:w-3/4 xl:w-2/3 2xl:w-1/2">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-white mb-3 sm:mb-4 leading-tight">
                Selamat Datang di Kebun Strawberry! 🍓
            </h1>
            <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-100 mb-6 sm:mb-8 leading-relaxed">
                Nikmati strawberry segar berkualitas premium langsung dari kebun kami
            </p>
            <div class="flex flex-wrap gap-3 sm:gap-4">
                <a href="#produk" class="inline-flex items-center px-5 py-3 sm:px-6 sm:py-3 md:px-8 md:py-4 bg-white text-gray-900 rounded-lg font-bold hover:bg-gray-100 transition transform hover:scale-105 shadow-xl text-sm sm:text-base md:text-lg">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Lihat Produk Kami
                </a>
                <a href="#testimoni" class="inline-flex items-center px-5 py-3 sm:px-6 sm:py-3 md:px-8 md:py-4 bg-white text-gray-900 rounded-lg font-bold hover:bg-gray-100 transition transform hover:scale-105 shadow-xl text-sm sm:text-base md:text-lg border-2 border-white">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                    Testimoni Pelanggan
                </a>
                    </div>
                </div>
            </div>
        </div>

<div class="space-y-4 sm:space-y-6 mt-6 sm:mt-8">

    <!-- Keunggulan Produk -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 xl:gap-6">
        <!-- Fresh -->
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-5 lg:p-6 text-white transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">100% Segar</p>
                    <p class="text-lg font-semibold">Dipetik Harian</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm p-3 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
        </div>

        <!-- Quality -->
        <div class="bg-gradient-to-br from-red-500 to-pink-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-5 lg:p-6 text-white transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-sm font-medium mb-1">Kualitas Premium</p>
                    <p class="text-lg font-semibold">Grade A</p>
                    </div>
                <div class="bg-white/20 backdrop-blur-sm p-3 rounded-xl">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Organic -->
        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-5 lg:p-6 text-white transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1">100% Organik</p>
                    <p class="text-lg font-semibold">Tanpa Pestisida</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm p-3 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
        </div>

        <!-- Fast Delivery -->
        <div class="bg-gradient-to-br from-orange-500 to-amber-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-5 lg:p-6 text-white transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium mb-1">Pengiriman Cepat</p>
                    <p class="text-lg font-semibold">Same Day</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm p-3 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    </div>
                </div>
            </div>
        </div>

    <!-- Tentang Kami -->
    <div id="produk" class="bg-white shadow-lg rounded-xl sm:rounded-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-red-50 to-pink-50 px-4 sm:px-6 py-4 sm:py-5 border-b border-red-100">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                <svg class="w-6 h-6 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                Tentang Kebun Strawberry Kami
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
                        <div class="bg-green-50 p-4 rounded-xl">
                            <p class="text-3xl font-bold text-green-600 mb-1">5+</p>
                            <p class="text-sm text-gray-600">Tahun Pengalaman</p>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-xl">
                            <p class="text-3xl font-bold text-blue-600 mb-1">1000+</p>
                            <p class="text-sm text-gray-600">Pelanggan Puas</p>
                        </div>
                        </div>
                    </div>
                <div class="relative">
                    <div class="bg-gradient-to-br from-red-100 to-pink-100 rounded-2xl p-6 h-full flex items-center justify-center">
                        <svg class="w-32 h-32 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimoni Pelanggan -->
    <div id="testimoni" class="bg-white shadow-lg rounded-xl sm:rounded-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-4 sm:px-6 py-4 sm:py-5 border-b border-purple-100">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                Apa Kata Pelanggan Kami
            </h2>
                                </div>
        <div class="p-6 sm:p-8">
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Testimoni 1 -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 hover:shadow-lg transition">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            S
                            </div>
                        <div class="ml-3">
                            <h4 class="font-bold text-gray-900">Sarah Wijaya</h4>
                            <div class="flex text-yellow-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                </div>
            </div>
                    </div>
                    <p class="text-gray-600 italic">"Strawberry nya sangat segar dan manis! Anak-anak saya sangat suka. Pengiriman juga cepat dan packing rapi. Pasti order lagi!"</p>
        </div>

                <!-- Testimoni 2 -->
                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-6 hover:shadow-lg transition">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            B
                        </div>
                        <div class="ml-3">
                            <h4 class="font-bold text-gray-900">Budi Santoso</h4>
                            <div class="flex text-yellow-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                </div>
            </div>
        </div>
                    <p class="text-gray-600 italic">"Kualitas strawberry premium dengan harga yang reasonable. Cocok untuk usaha kue saya. Pelayanan sangat memuaskan!"</p>
    </div>

                <!-- Testimoni 3 -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 hover:shadow-lg transition">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            D
            </div>
                        <div class="ml-3">
                            <h4 class="font-bold text-gray-900">Dewi Lestari</h4>
                            <div class="flex text-yellow-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                </div>
                                        </div>
                                    </div>
                    <p class="text-gray-600 italic">"Sudah langganan sejak 2 tahun yang lalu. Selalu konsisten kualitasnya. Recommended banget untuk yang cari strawberry organik!"</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
