@extends('layouts.app')

@section('title', 'Detail Pemesanan - ' . $order->order_number)

@section('content')
<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-red-600">
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
                    <a href="{{ route('orders.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-red-600 md:ml-2">Pemesanan Saya</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $order->order_number }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Order Details -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-pink-500 px-6 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-white">Detail Pemesanan</h1>
                    <p class="text-red-100 mt-1">No. Pesanan: {{ $order->order_number }}</p>
                </div>
                <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-lg text-white font-semibold {{ $order->status_color }}">
                    {{ $order->status_label }}
                </span>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <!-- Informasi Pemesan -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Pemesan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Nama Pemesan</p>
                        <p class="text-lg font-medium text-gray-900">{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Nomor HP</p>
                        <p class="text-lg font-medium text-gray-900">{{ $order->customer_phone }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-600">Alamat</p>
                        <p class="text-lg font-medium text-gray-900">{{ $order->customer_address }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Tanggal Pemesanan</p>
                        <p class="text-lg font-medium text-gray-900">{{ $order->order_date->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Tanggal Diterima</p>
                        <p class="text-lg font-medium text-gray-900">{{ $order->delivery_date->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Daftar Produk -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Produk yang Dipesan</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Produk
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Harga per Unit
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Subtotal
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->product_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $item->formatted_price_per_unit }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $item->quantity }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">{{ $item->formatted_subtotal }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right text-sm font-semibold text-gray-900">
                                    Total Pembayaran:
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-lg font-bold text-red-600">{{ $order->formatted_total }}</div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Catatan -->
            @if($order->notes)
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Catatan</h2>
                    <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $order->notes }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

