@extends('layouts.app')

@section('title', 'Manajemen Pemesanan')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Manajemen Pemesanan</h1>
            <p class="text-gray-600 mt-1">Kelola semua pesanan dari pelanggan</p>
        </div>
        <a href="{{ route('admin.orders.create') }}" class="px-6 py-3 bg-pink-500 text-white rounded-lg hover:bg-pink-600 font-semibold">
            + Buat Pemesanan Baru
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white shadow-lg rounded-xl p-6">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                <input type="text" name="search" id="search" 
                    value="{{ request('search') }}"
                    placeholder="No. pesanan, nama, atau HP"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="status" 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Sedang Diproses</option>
                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Orders List -->
    @if($orders->count() > 0)
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-pink-500">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                No. Pesanan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Pemesan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Tanggal Pemesanan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Total
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Bukti Pembayaran
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $order->order_number }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $order->customer_phone }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $order->order_date->format('d/m/Y H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-red-600">{{ $order->formatted_total }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->status_color }}">
                                        {{ $order->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($order->payment_proof)
                                        <span class="text-green-600 font-semibold">✓ Ada</span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="text-red-600 hover:text-red-900 mr-3">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $orders->links() }}
            </div>
        </div>
    @else
        <div class="bg-white shadow-lg rounded-xl p-12 text-center">
            <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Pemesanan</h3>
            <p class="text-gray-600">Belum ada pesanan yang masuk.</p>
        </div>
    @endif
</div>
@endsection

