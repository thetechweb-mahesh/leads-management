@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Leads <a href="{{ route('dashboard') }}" class="text-blue px-4 py-2 rounded">Back to dashboard</a></h1> 

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif


    <form method="GET" class="flex gap-4 mb-4">
        <select name="status" class="border rounded p-2">
            <option value="">All Statuses</option>
            @foreach (['New', 'Contacted', 'Converted', 'Lost'] as $status)
                <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>

        <select name="lead_source" class="border rounded p-2">
            <option value="">All Sources</option>
            @foreach ($leads->pluck('lead_source')->unique() as $source)
                <option value="{{ $source }}" {{ request('lead_source') === $source ? 'selected' : '' }}>{{ $source }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>

    </form>


@if(auth()->user()?->role === 'admin')
    <a href="{{ route('leads.export') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
        Download CSV
    </a>

    <a href="{{ route('leads.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">
        + Create Lead
    </a>
@endif






    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100 text-left text-sm font-medium">
                    <th class="p-2">Name</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Phone</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Source</th>
                    <th class="p-2">Assigned</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach ($leads as $lead)
                    <tr class="border-b">
                        <td class="p-2">{{ $lead->name }}</td>
                        <td class="p-2">{{ $lead->email }}</td>
                        <td class="p-2">{{ $lead->phone }}</td>
                        <td class="p-2">{{ $lead->status }}</td>
                        <td class="p-2">{{ $lead->lead_source }}</td>
                        <td class="p-2">{{ optional($lead->user)->name }}</td>
                        <td class="p-2 flex gap-2">
                            <a href="{{ route('leads.show', $lead) }}" class="text-blue-600">View</a>   @if (auth()->user()->role === 'admin')
                            <a href="{{ route('leads.edit', $lead) }}" class="text-yellow-600">Edit</a>  @endif
                            @if (auth()->user()->role === 'admin')
                                <form action="{{ route('leads.destroy', $lead) }}" method="POST" onsubmit="return confirm('Delete this lead?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $leads->links() }}
    </div>
</div>
@endsection
