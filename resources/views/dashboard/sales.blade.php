@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">My Assigned Leads</h1>
        <p class="text-gray-500 mt-1">Welcome, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Assigned Leads Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Assigned Leads</h2>
            <p class="text-sm text-gray-500">Here are the leads assigned to you.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Lead Source</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($assignedLeads as $lead)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $lead->name }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                    {{ match($lead->status) {
                                        'New' => 'bg-blue-100 text-blue-800',
                                        'Contacted' => 'bg-yellow-100 text-yellow-800',
                                        'Converted' => 'bg-green-100 text-green-800',
                                        default => 'bg-red-100 text-red-800'
                                    } }}">
                                    {{ $lead->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $lead->lead_source }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">No leads assigned yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
