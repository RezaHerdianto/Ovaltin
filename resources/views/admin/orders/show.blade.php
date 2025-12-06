@extends('layouts.app')

@section('title', 'Detail Pemesanan - ' . $order->order_number)

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
                    @if($order->user)
                        <div>
                            <p class="text-sm text-gray-600">Akun User</p>
                            <p class="text-lg font-medium text-gray-900">{{ $order->user->name }} ({{ $order->user->email }})</p>
                        </div>
                    @endif
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

            <!-- Bukti Pembayaran -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Bukti Pembayaran</h2>
                @if($order->payment_proof)
                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" 
                                alt="Bukti Pembayaran" 
                                class="max-w-md rounded-lg shadow-md cursor-pointer"
                                onclick="window.open('{{ asset('storage/' . $order->payment_proof) }}', '_blank')">
                        </div>
                        <form action="{{ route('admin.orders.delete-payment-proof', $order) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus bukti pembayaran ini?')">
                                Hapus Bukti Pembayaran
                            </button>
                        </form>
                    </div>
                @else
                    <div class="border border-gray-200 rounded-lg p-6">
                        <p class="text-gray-600 mb-4">Belum ada bukti pembayaran yang diunggah.</p>
                        <form action="{{ route('admin.orders.upload-payment-proof', $order) }}" 
                            method="POST" 
                            enctype="multipart/form-data"
                            class="space-y-4">
                            @csrf
                            <div>
                                <label for="payment_proof" class="block text-sm font-medium text-gray-700 mb-2">
                                    Unggah Bukti Pembayaran <span class="text-red-500">*</span>
                                </label>
                                <input type="file" 
                                    name="payment_proof" 
                                    id="payment_proof" 
                                    accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100"
                                    required>
                                <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 5MB</p>
                                @error('payment_proof')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="px-6 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600">
                                Unggah Bukti Pembayaran
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Catatan -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Catatan</h2>
                <form action="{{ route('admin.orders.update-notes', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <textarea name="notes" 
                        rows="3"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">{{ $order->notes }}</textarea>
                    <button type="submit" class="mt-2 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                        Simpan Catatan
                    </button>
                </form>
            </div>

            <!-- Update Status -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Update Status</h2>
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="flex items-center space-x-4">
                        <select name="status" 
                            class="border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Sedang Diproses</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        <button type="submit" class="px-6 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.orders.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    Kembali ke Daftar
                </a>
                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="px-6 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                        Hapus Pesanan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

