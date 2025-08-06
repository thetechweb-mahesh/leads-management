@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6"> Admin Dashboard 
               <a href="{{ route('leads.index') }}" class="bg-blue-600 text-white px-1 py-2 rounded">
      view Leads
           </a>

</h2>

        <!-- Total Leads -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h3 class="text-lg font-medium text-gray-700 mb-2">Total Leads</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $totalLeads }}</p>
        </div>

        <!-- Leads by Status -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-700 mb-4">Leads by Status</h3>
            <ul class="space-y-3">
                @forelse($leadsByStatus as $item)
                    <li class="flex items-center justify-between border-b pb-2">
                        <span class="text-gray-600 font-semibold">{{ $item->status }}</span>
                        <span class="text-gray-800 text-lg font-bold">{{ $item->total }}</span>
                    </li>
                @empty
                    <li class="text-gray-500">No data available.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
