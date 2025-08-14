@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-6">
   
   
   
   

   
   
   
   
   

   
   
   
   

   
   
    <!-- Leads Table -->
    <div class="overflow-x-auto bg-white shadow-sm rounded-xl">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-white border-b font-medium text-gray-600">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">slug</th>
                    <th class="px-6 py-4">Status</th>
                   
                   
                   
                   
                    <th class="px-6 py-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($content as $item)
                    <tr class="hover:bg-gray-50 text-gray-800">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->title }}</td>
                        <td class="px-6 py-4">{{ $item->slug }}</td>
                        <td class="px-2 py-4">      <form class="forms-sample" data-id="{{ $item->id }}">
     @csrf
     <input type="hidden" name="id" value="{{ $item->id }}">
     <input type="hidden" name="status" id="status-{{ $item->id }}" value="{{ $item->status }}">
     <label class="toggle-switch">
         <input type="checkbox" id="toggle-{{ $item->id }}" class="toggle-input"
             {{ $item->status == '1' ? 'checked' : '' }}
             onchange="updateStatus({{ $item->id }}, this.checked)">
         <span class="toggle-slider"></span>
     </label>
     <label for="toggle-{{ $item->id }}" class="toggle-label">
         {{ $item->status == '1' ? 'Active' : 'Inactive' }}
     </label>
 </form></td>
                       
    
       
       
       <td> 
  
 <a  class="p-2 bg-yellow-100 rounded-full hover:bg-yellow-200 transition" href="{{ route('pages.edit', $item->id) }}">Edit</a>
     <form action="{{ route('pages.destroy', $item->id) }}" method="POST" style="display:inline;">
         @csrf
         @method('DELETE')
         <button type="submit" class="p-2 bg-red-100 rounded-full hover:bg-red-200 transition">Delete</button>
     </form>
     
         
 
  </td>
       
        @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    
    
    
</div>
@endsection

<style>
    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
    }
  
    .toggle-switch input {
        display: none;
    }
  
    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }
  
    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 15px;
        width: 15px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }
  
    input:checked + .toggle-slider {
        background-color: #2196F3;
    }
  
    input:checked + .toggle-slider:before {
        transform: translateX(20px);
    }
  
    .toggle-label {
        display: inline-block;
        margin-left: 10px;
    }
  </style>
      