@extends('layouts.admin')

@section('content')


<!-- <div class="container mx-auto p-6"> -->
    <!-- <h2 class="text-2xl font-bold mb-6">📊 Admin Dashboard</h2> -->
<!-- 
    Stats Cards
 <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6"> -->
        <!-- <div class="bg-blue-500 text-white p-4 rounded shadow"> -->
            <!-- <h3 class="text-lg font-semibold">Total Leads</h3> -->
            <!-- <p class="text-3xl font-bold">{{ $totalLeads }}</p> -->
        <!-- </div> -->
        <!-- <div class="bg-green-500 text-white p-4 rounded shadow"> -->
            <!-- <h3 class="text-lg font-semibold">Converted</h3> -->
            <!-- <p class="text-3xl font-bold">{{ $leadsByStatus->where('status', 'Converted')->first()->total ?? 0 }}</p> -->
        <!-- </div> -->
        <!-- <div class="bg-red-500 text-white p-4 rounded shadow"> -->
            <!-- <h3 class="text-lg font-semibold">Lost</h3> -->
            <!-- <p class="text-3xl font-bold">{{ $leadsByStatus->where('status', 'Lost')->first()->total ?? 0 }}</p> -->
        <!-- </div> -->
    <!-- </div> -->
<!--  
    Chart
     <div class="bg-white p-6 rounded shadow"> -->
        <!-- <canvas id="leadsChart" height="120"></canvas> -->
    <!-- </div> -->
<!-- </div> -->
<!--  -->
<!-- <script>
// document.addEventListener("DOMContentLoaded", function() {
    // const ctx = document.getElementById('leadsChart').getContext('2d');
    // new Chart(ctx, {
        // type: 'bar',
        // data: {
            // labels: @json($leadsByStatus->pluck('status')),
            // datasets: [{
                // label: 'Leads by Status',
                // data: @json($leadsByStatus->pluck('total')),
                // backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444'],
                // borderWidth: 1
            // }]
        // },
        // options: {
            // responsive: true,
            // scales: {
                // y: { beginAtZero: true }
            // }
        // }
    // });
// });
</script> -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->














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
