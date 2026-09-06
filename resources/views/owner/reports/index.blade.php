@extends('layouts.app')
@section('title', 'Laporan Penjualan')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Laporan Penjualan</h1>
            <p class="text-sm text-gray-500 mt-1">Data penjualan dari pesanan yang sudah dibayar</p>
        </div>
        <div>
            <a href="{{ route('owner.reports.export', request()->query()) }}" class="inline-flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-sm font-medium">
                ⬇️ Export CSV
            </a>
        </div>
    </div>

    {{-- Filter Date --}}
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6">
        <form method="GET" action="{{ route('owner.reports.index') }}" class="flex flex-wrap items-end gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="border-gray-300 rounded-lg text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="border-gray-300 rounded-lg text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm font-medium">
                Filter
            </button>
            <a href="{{ route('owner.reports.index') }}" class="text-sm text-gray-500 hover:underline">Reset</a>
        </form>
    </div>

    {{-- Ringkasan --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <p class="text-xs text-gray-500">Total Transaksi</p>
            <p class="text-xl font-bold text-gray-900 mt-1">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <p class="text-xs text-gray-500">Total Subtotal (Bersih)</p>
            <p class="text-xl font-bold text-gray-900 mt-1">Rp {{ number_format($netRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <p class="text-xs text-gray-500">Total Pajak</p>
            <p class="text-xl font-bold text-red-600 mt-1">Rp {{ number_format($totalTax, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <p class="text-xs text-gray-500">Total Service Charge</p>
            <p class="text-xl font-bold text-orange-600 mt-1">Rp {{ number_format($totalServiceCharge, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border-2 border-blue-100 bg-blue-50">
            <p class="text-xs font-semibold text-blue-700">Total Pendapatan Kotor</p>
            <p class="text-2xl font-bold text-blue-700 mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order / Meja</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">#{{ $order->order_number }}</div>
                            <div class="text-xs text-gray-500">{{ $order->table->name ?? 'Manual' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ strtoupper($order->payment->method ?? 'QRIS') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold text-right">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-sm">
                            Tidak ada data pesanan pada rentang tanggal tersebut.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
