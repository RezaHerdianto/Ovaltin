<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard Produk Stroberi')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation - Pink Theme -->
        <nav class="bg-gradient-to-r from-pink-500 via-pink-600 to-rose-600 shadow-lg sticky top-0 z-50">
            <div class="mx-auto px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <div class="flex items-center">
                                <img src="{{ asset('images/foto logo.webp') }}" alt="Ovaltin Logo" class="w-8 h-8 object-cover rounded-full">
                                <span class="ml-2 text-xl font-bold text-white">Ovaltin</span>
                            </div>
                        </div>

                        <!-- Navigation Links -->
                        @auth
                           <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                               <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'border-white text-white' : 'border-transparent text-pink-100 hover:text-white hover:border-pink-300' }}">
                                   Dashboard
                               </a>
                               <a href="{{ route('user.products.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('user.products.*') ? 'border-white text-white' : 'border-transparent text-pink-100 hover:text-white hover:border-pink-300' }}">
                                   Katalog Produk
                               </a>
                               <a href="{{ route('testimonials.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('testimonials.*') ? 'border-white text-white' : 'border-transparent text-pink-100 hover:text-white hover:border-pink-300' }}">
                                   Testimoni
                               </a>
                               <a href="{{ route('contact.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('contact.*') ? 'border-white text-white' : 'border-transparent text-pink-100 hover:text-white hover:border-pink-300' }}">
                                   Kontak
                               </a>
                               @if(Auth::user()->isAdmin())
                                   <a href="{{ route('strawberry-products.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('strawberry-products.*') ? 'border-white text-white' : 'border-transparent text-pink-100 hover:text-white hover:border-pink-300' }}">
                                       Produk Stroberi
                                   </a>
                                   <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('admin.*') ? 'border-white text-white' : 'border-transparent text-pink-100 hover:text-white hover:border-pink-300' }}">
                                       Admin Panel
                                   </a>
                               @endif
                           </div>
                        @endauth
                    </div>

                    <!-- Right side -->
                    <div class="flex items-center">
                        @auth
                            <div class="flex items-center space-x-4">
                                <span class="text-sm text-pink-100">
                                    Selamat datang, <span class="font-medium text-white">{{ Auth::user()->name }}</span>
                                    @if(Auth::user()->isAdmin())
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-white text-pink-600 ml-1 shadow-sm">
                                            Admin
                                        </span>
                                    @endif
                                </span>
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-3 py-2 border border-white text-sm leading-4 font-medium rounded-md text-white bg-white/20 hover:bg-white/30 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition duration-150 ease-in-out">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('login') }}" class="text-sm text-pink-100 hover:text-white font-medium transition">Login</a>
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-white text-sm font-medium rounded-md text-white bg-white/20 hover:bg-white/30 backdrop-blur-sm transition">Register</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-6">
            <div class="mx-auto px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gradient-to-r from-pink-600 via-pink-700 to-rose-700 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <!-- Main Footer Content -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    <!-- Logo Ovaltin & Alamat -->
                    <div>
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('images/foto logo.webp') }}" alt="Ovaltin Logo" class="w-10 h-10 object-cover rounded-full mr-3">
                            <span class="text-3xl font-bold">Ovaltin</span>
                        </div>
                        <div class="space-y-1 text-pink-100">
                            <div>Jl. Raya Pangalengan</div>
                            <div>Desa Pangalengan</div>
                            <div>Kecamatan Pangalengan</div>
                            <div>Kabupaten Bandung</div>
                            <div>Jawa Barat, Indonesia</div>
                        </div>
                    </div>
                    <!-- Kontak -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-white">Kontak</h3>
                        <div class="space-y-3">
                            <div class="flex items-center text-pink-100">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>+62 812-3456-7890</span>
                            </div>
                            <div class="flex items-center text-pink-100">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>info@ovaltin.com</span>
                            </div>
                        </div>
                    </div>

                    <!-- Layanan -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-white">Layanan</h3>
                        <ul class="space-y-3">
                            <li><a href="{{ route('user.products.index') }}" class="text-pink-100 hover:text-white transition duration-200">Katalog Produk</a></li>
                            <li><a href="{{ route('testimonials.index') }}" class="text-pink-100 hover:text-white transition duration-200">Testimoni</a></li>
                            <li><a href="#" class="text-pink-100 hover:text-white transition duration-200">Pemesanan</a></li>
                        </ul>
                    </div>

                    <!-- Media Sosial -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-white">Ikuti Kami di Media Sosial</h3>
                        <div class="flex space-x-4">
                            <!-- Instagram -->
                            <a href="https://www.instagram.com/dapur.ovaltin/" target="_blank" class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full hover:scale-110 transition duration-200">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            
                            <!-- WhatsApp -->
                            <a href="#" class="flex items-center justify-center w-12 h-12 bg-green-500 rounded-full hover:scale-110 transition duration-200">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </a>
                            
                            <!-- TikTok -->
                            <a href="https://www.tiktok.com/@dapur_ovaltin?_t=8gilzzPgcCX&_r=1" target="_blank" class="flex items-center justify-center w-12 h-12 bg-black rounded-full hover:scale-110 transition duration-200">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-.88-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/>
                                </svg>
                            </a>
                            
                            <!-- YouTube -->
                            <a href="https://www.youtube.com/@dapurovaltinLM" target="_blank" class="flex items-center justify-center w-12 h-12 bg-red-600 rounded-full hover:scale-110 transition duration-200">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="pt-8 border-t border-pink-500 text-center">
                    <p class="text-pink-200 text-sm mb-2">© {{ date('Y') }} Ovaltin. Hak Cipta Dilindungi.</p>
                    <p class="text-pink-300 text-xs">Dibuat dengan ❤️ untuk para pecinta strawberry Indonesia</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
