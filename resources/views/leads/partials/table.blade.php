@extends('layouts.app')

@section('content')

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
            @forelse ($leads as $lead)
                <tr class="border-b">
                    <td class="p-2">{{ $lead->name }}</td>
                    <td class="p-2">{{ $lead->email }}</td>
                    <td class="p-2">{{ $lead->phone }}</td>
                    <td class="p-2">{{ $lead->status }}</td>
                    <td class="p-2">{{ $lead->lead_source }}</td>
                    <td class="p-2">{{ optional($lead->user)->name }}</td>
                    <td class="p-2 flex gap-2">
                        <a href="{{ route('leads.show', $lead) }}" class="text-blue-600">View</a>
                        @if(auth()->user()->role === 'sales' && $lead->assigned_to === auth()->id())
                            <a href="{{ route('leads.edit', $lead) }}" class="text-yellow-600">Edit</a>
                        @endif
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('leads.edit', $lead) }}" class="text-yellow-600">Edit</a>
                            <form action="{{ route('leads.destroy', $lead) }}" method="POST" onsubmit="return confirm('Delete this lead?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-2 text-center">No leads found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $leads->links() }}
</div>
@endsection