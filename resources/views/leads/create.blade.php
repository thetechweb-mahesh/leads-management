@extends('layouts.app')

@section('header')
    <h2>Leads</h2>
@endsection

@section('content')
    <div>
      <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
              <form action="{{ route('leads.store') }}" method="POST" class="space-y-4">
@csrf
<x-input-label for="name" value="Name" />
<x-text-input id="name" name="name" type="text" class="w-full" required />
<x-input-label for="email" value="Email" />
<x-text-input id="email" name="email" type="email" class="w-full" required />
<x-input-label for="phone" value="Phone" />
<x-text-input id="phone" name="phone" type="text" class="w-full" required />
<x-input-label for="lead_source" value="Lead Source" />
<x-text-input id="lead_source" name="lead_source" type="text" class="w-full" required />
<x-input-label for="status" value="Status" />
<select name="status" id="status" class="w-full border rounded p-2">
    @foreach (['New', 'Contacted', 'Converted', 'Lost'] as $status)
        <option value="{{ $status }}">{{ $status }}</option>
    @endforeach
</select>
<x-input-label for="assigned_to" value="Assign to (Sales Executive)" />
<select name="assigned_to" id="assigned_to" class="w-full border rounded p-2">
    <option value="">Unassigned</option>
    @foreach ($salesUsers as $user)
        <option value="{{ $user->id }}">{{ $user->name }}</option>
    @endforeach
</select>
<x-input-label for="remarks" value="Remarks" />
<textarea name="remarks" id="remarks" class="w-full border rounded p-2"></textarea>
<button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded" style="background-color: blue;">Save Lead</button>

            </div>
        </div>
    </div>
</div>
    </div>
@endsection
