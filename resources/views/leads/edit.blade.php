@extends('layouts.app')

@section('content')

  <div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">



    <h1 class="text-2xl font-bold mb-4">Edit Lead</h1>

    <form action="{{ route('leads.update', $lead) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <x-input-label for="name" value="Name" />
        <x-text-input id="name" name="name" type="text" class="w-full" value="{{ old('name', $lead->name) }}" required />

        <x-input-label for="email" value="Email" />
        <x-text-input id="email" name="email" type="email" class="w-full" value="{{ old('email', $lead->email) }}" required />

        <x-input-label for="phone" value="Phone" />
        <x-text-input id="phone" name="phone" type="text" class="w-full" value="{{ old('phone', $lead->phone) }}" required />

        <x-input-label for="lead_source" value="Lead Source" />
        <x-text-input id="lead_source" name="lead_source" type="text" class="w-full" value="{{ old('lead_source', $lead->lead_source) }}" required />

        <x-input-label for="status" value="Status" />
        <select name="status" id="status" class="w-full border rounded p-2">
            @foreach (['New', 'Contacted', 'Converted', 'Lost'] as $status)
                <option value="{{ $status }}" {{ $lead->status === $status ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>

        @if (auth()->user()->role === 'admin')
            <x-input-label for="assigned_to" value="Assign to (Sales Executive)" />
            <select name="assigned_to" id="assigned_to" class="w-full border rounded p-2">
                <option value="">Unassigned</option>
                @foreach ($salesUsers as $user)
                    <option value="{{ $user->id }}" {{ $lead->assigned_to == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        @endif

        <x-input-label for="remarks" value="Remarks" />
        <textarea name="remarks" id="remarks" class="w-full border rounded p-2">{{ old('remarks', $lead->remarks) }}</textarea>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Lead</button>
    </form>
</div></div></div></div>
@endsection
