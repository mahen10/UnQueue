@extends('layouts.app')
@section('title', 'Owner Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard Owner</h1>
        <p class="text-gray-500 mt-2">Restoran Aktif: {{ request()->attributes->get('shop')->name }}</p>
    </div>
</div>
@endsection
