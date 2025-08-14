@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold">All Leads</h1>
        <div class="flex gap-2">
            <a class="text-gray-400 cursor-not-allowed px-4 py-2 rounded border text-sm">+ Add New Lead</a>

            <!-- Filters Button -->
            <button onclick="document.getElementById('filterForm').classList.toggle('hidden')"
                class="border px-4 py-2 rounded text-sm bg-white hover:bg-gray-100">
                Filters
            </button>

            <a href="#" class="border px-4 py-2 rounded text-sm bg-white hover:bg-gray-100">Import Leads</a>
            <a href="{{ route('leads.export') }}" class="border px-4 py-2 rounded text-sm bg-white hover:bg-gray-100">Export Leads</a>
        </div>
    </div>

    <!-- Filter Form -->
    <div id="filterForm" class="bg-gray-50 p-4 rounded-lg mb-4 hidden">
        <form method="GET" action="{{ route('leads.index') }}" class="flex flex-wrap gap-3">
            <input type="text" name="search" placeholder="Search by name/email"
                value="{{ request('search') }}"
                class="border px-3 py-2 rounded text-sm">

            <select name="status" class="border px-3 py-2 rounded text-sm">
                <option value="">All Status</option>
                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Contacted</option>
                <option value="converted" {{ request('status') == 'converted' ? 'selected' : '' }}>Converted</option>
            </select>

            <select name="lead_source" class="border px-3 py-2 rounded text-sm">
                <option value="">All Campaigns</option>
                <option value="facebook" {{ request('lead_source') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                <option value="google" {{ request('lead_source') == 'google' ? 'selected' : '' }}>Google</option>
                <option value="website" {{ request('lead_source') == 'website' ? 'selected' : '' }}>Website</option>
                <option value="referral" {{ request('lead_source') == 'referral' ? 'selected' : '' }}>Referral</option>
            </select>

            <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded text-sm hover:bg-blue-600">
                Apply
            </button>
            <a href="{{ route('leads.index') }}"
                class="border px-4 py-2 rounded text-sm bg-gray-100 hover:bg-gray-200">
                Clear
            </a>
        </form>
    </div>

    <!-- Leads Table -->
    <div class="overflow-x-auto bg-white shadow-sm rounded-xl">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-white border-b font-medium text-gray-600">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Mobile No.</th>
                    <th class="px-6 py-4">Rating</th>
                    <th class="px-6 py-4">Campaign</th>
                    <th class="px-6 py-4">Comments</th>
                    <th class="px-6 py-4">Executive</th>
                    <th class="px-6 py-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($leads as $lead)
                    <tr class="hover:bg-gray-50 text-gray-800">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $lead->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $lead->name }}</td>
                        <td class="px-6 py-4">{{ $lead->email }}</td>
                        <td class="px-2 py-4">{{ $lead->phone }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-700">{{ ucfirst($lead->status) }}</td>
                        <td class="px-6 py-4">

                            <a href="{{ $lead->lead_source }}" target="_blank">
              {{ \Illuminate\Support\Str::limit($lead->lead_source, 10) }}
                       </a>

                        </td>
                        <td class="px-6 py-4">—</td>

                        <!-- Executive -->
                        <td class="px-6 py-4">
                            @if($lead->user)
                                <div class="flex items-center gap-2">
                                    <div class="h-7 w-7 bg-gray-200 rounded-full flex items-center justify-center text-xs font-semibold text-gray-700 uppercase">
                                        {{ strtoupper(substr($lead->user->name, 0, 2)) }}
                                    </div>
                                    <span class="text-gray-800 text-sm">{{ $lead->user->name }}</span>
                                </div>
                            @else
                                <span class="text-gray-400 text-sm italic">Unassigned</span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <!-- View -->
                                <a href="{{ route('leads.show', $lead) }}" title="View"
                                   class="p-2 bg-blue-100 rounded-full hover:bg-blue-200 transition">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                         viewBox="0 0 24 24">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7
                                                 c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>

                                @if(auth()->user()->role === 'admin')
                                    <!-- Edit -->
                                    <a href="{{ route('leads.edit', $lead) }}" title="Edit"
                                       class="p-2 bg-yellow-100 rounded-full hover:bg-yellow-200 transition">
                                        <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24">
                                            <path d="M15.232 5.232l3.536 3.536M9 11l6 6"/>
                                            <path d="M3 21h6l11.293-11.293a1 1 0 000-1.414l-4.586-4.586
                                                     a1 1 0 00-1.414 0L3 21z"/>
                                        </svg>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('leads.destroy', $lead) }}" method="POST"
                                          onsubmit="return confirm('Delete this lead?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" title="Delete"
                                                class="p-2 bg-red-100 rounded-full hover:bg-red-200 transition">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                                 viewBox="0 0 24 24">
                                                <path d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-gray-500">No leads available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $leads->links() }}
    </div>
</div>
@endsection
