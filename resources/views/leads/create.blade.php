@extends('layouts.admin')







@section('content')
 <div class="mb-4 border-b pb-2">
     <h2 class="text-3xl font-bold text-gray-800 ">Add New Lead</h2>
     <p class="text-sm text-gray-500 mt-1">Enter the lead information below to create a new record.</p>
 </div>
    <div class="py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 ">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-8 px-6 py-4">
                <form action="{{ route('leads.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" value="Name" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                    </div>

                    <!-- Phone -->
                    <div>
                        <x-input-label for="phone" value="Phone" />
                        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" required />
                    </div>

                    <!-- Lead Source -->
                    <div>
                        <x-input-label for="lead_source" value="Lead Source" />
                        <x-text-input id="lead_source" name="lead_source" type="text" class="mt-1 block w-full" required />
                    </div>

                    <!-- Status -->
                    <div>
                        <x-input-label for="status" value="Status" />
                        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @foreach (['New', 'Contacted', 'Converted', 'Lost'] as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Assign to -->
                    <div>
                        <x-input-label for="assigned_to" value="Assign to (Sales Executive)" />
                        <select name="assigned_to" id="assigned_to" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Unassigned</option>
                            @foreach ($salesUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Remarks -->
                    <div class="md:col-span-2">
                        <x-input-label for="remarks" value="Remarks" />
                        <textarea name="remarks" id="remarks" rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <!-- Submit -->
                    <div class="md:col-span-2 flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-black hover:bg-blue-700 transition duration-150">
                            💾 Save Lead
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
