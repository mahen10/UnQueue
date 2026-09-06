@extends('layouts.owner')
@section('title', 'Billing & Langganan')
@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Billing & Langganan</h1>
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h2 class="font-semibold text-gray-800">Status Langganan</h2>
                @if($shop->isSubscriptionActive())
                    <span class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-full">
                        ✅ Aktif — {{ $shop->subscriptionDaysLeft() }} hari tersisa
                    </span>
                @else
                    <span class="inline-block mt-2 px-3 py-1 bg-red-100 text-red-700 text-sm font-semibold rounded-full">
                        ❌ Tidak Aktif
                    </span>
                @endif
            </div>
            <form action="{{ route('owner.billing.subscribe') }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">
                    Perpanjang Sekarang
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800">Riwayat Langganan</h2>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paket</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mulai</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Berakhir</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($subscriptions as $sub)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $sub->plan_name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $sub->starts_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $sub->ends_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 text-xs rounded-full {{ $sub->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($sub->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-400">Belum ada riwayat langganan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
