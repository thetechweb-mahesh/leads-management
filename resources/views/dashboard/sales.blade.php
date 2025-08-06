@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6"> My Assigned Leads           <a href="{{ route('leads.index') }}" class="bg-blue-600 text-white px-1 py-2 rounded">
 view Leads
      </a></h2>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Lead Source</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($assignedLeads as $lead)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $lead->name }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $lead->status === 'New' ? 'bg-blue-100 text-blue-800' :
                                       ($lead->status === 'Contacted' ? 'bg-yellow-100 text-yellow-800' :
                                       ($lead->status === 'Converted' ? 'bg-green-100 text-green-800' :
                                       'bg-red-100 text-red-800')) }}">
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
@endsection
