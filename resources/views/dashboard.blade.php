<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white-800 leading-tight">
            {{ __('Dashboards') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900">
                    @section('content')
                   
<h2>Total Leads: {{ $totalLeads }}</h2>

<h3>Leads by Status:</h3>
<ul>
@foreach($leadsByStatus as $status => $count)
    <li>{{ $status }}: {{ $count }}</li>
@endforeach
</ul>

@endsection
                </div>
            </div>
        </div>
    </div>
</x-app-layout>








