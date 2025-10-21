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
        <nav class="bg-gradient-to-r from-pink-500 via-pink-600 to-rose-600 shadow-lg">
            <div class="mx-auto px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center shadow-md">
                                    <svg class="w-5 h-5 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
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
    </div>
</body>
</html>
