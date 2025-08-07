@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Welcome Message -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Welcome, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-500 mt-1">Here is an overview of your dashboard.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Total Leads -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-sm font-medium text-gray-500">Total Leads</h3>
            <p class="mt-2 text-4xl font-bold text-blue-600">{{ $totalLeads }}</p>
        </div>

        <!-- Leads by Status -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-sm font-medium text-gray-500 mb-4">Leads by Status</h3>
            <ul class="divide-y divide-gray-200">
                @forelse($leadsByStatus as $item)
                    <li class="flex justify-between py-2">
                        <span class="text-gray-700 font-medium">{{ $item->status }}</span>
                        <span class="text-gray-900 font-bold">{{ $item->total }}</span>
                    </li>
                @empty
                    <li class="text-gray-500 py-2">No data available.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
