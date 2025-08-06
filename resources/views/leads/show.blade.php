@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lead Details</h1>     

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $lead->name }}</h5>
            <p class="card-text"><strong>Status:</strong> {{ $lead->status }}</p>
            <p class="card-text"><strong>Remarks:</strong> {{ $lead->remarks }}</p>
            @if($lead->assignedTo)
                <p class="card-text">
                    <strong>Assigned To:</strong> {{ $lead->assignedTo->name }} ({{ $lead->assignedTo->role }})
                </p>
            @else
                <p class="card-text"><strong>Assigned To:</strong> Unassigned</p>
            @endif
            <p class="card-text"><small class="text-muted">Created: {{ $lead->created_at->format('Y-m-d') }}</small></p>
        </div>
    </div>

    <hr>
    <a href="{{ route('leads.index') }}" class="btn btn-secondary bg-blue-600 text-white px-4 py-2 rounded">Back to Leads</a>
    <a href="{{ route('leads.edit', $lead) }}" class="btn btn-primary">Edit Lead</a>
</div>
@endsection
