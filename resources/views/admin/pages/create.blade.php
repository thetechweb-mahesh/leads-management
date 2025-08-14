@extends('layouts.admin')

@section('title', 'Add Page')

@section('content')
<div class="mb-4 border-b pb-2">
    <!-- <h2 class="text-3xl font-bold text-gray-800">Add New Page</h2> -->
    <!-- <p class="text-sm text-gray-500 mt-1">Fill in the details to create a new page.</p> -->
     <div class="flex items-center justify-between mb-6">
  
   
  <a href="{{ url('/admin/pages') }}" class="border px-4 py-2 rounded text-sm bg-white hover:bg-gray-100">All Pages</a>
  
  
  
  
  
  
  
  
 </div>
</div>

<div class="py-6">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-8">
            
            @if(session('message'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif

            <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Tabs -->
                <div x-data="{ tab: 'info' }">
                    <div class="flex space-x-4 border-b pb-2 mb-4">
                        @foreach(['info' => 'Info', 'banner' => 'Banner', 'meta' => 'Meta', 'extra' => 'Extra', 'faq' => 'FAQ', 'howto' => 'How To'] as $key => $label)
                            <button type="button" 
                                @click="tab='{{ $key }}'" 
                                :class="tab==='{{ $key }}' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500'"
                                class="px-3 py-2 font-medium focus:outline-none">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>

                    <!-- Info Tab -->
                    <div x-show="tab==='info'" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="slug" value="Slug" />
                            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="img" value="Featured Image" />
                            <input type="file" id="img" name="img" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        </div>
                        <div>
                            <x-input-label for="product_in_page" value="Product in this Page" />
                            <select name="product_in_page" id="product_in_page" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="subtitle" value="Subtitle" />
                            <x-text-input id="subtitle" name="subtitle" type="text" class="mt-1 block w-full" />
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="details" value="Description" />
                            <textarea id="details" name="details" rows="5" class="ckeditor mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>
                    </div>

                    <!-- Banner Tab -->
                    <div x-show="tab==='banner'">
                        <x-input-label for="extra[banner]" value="Banner Subtitle" />
                        <textarea name="extra[banner]" rows="2" class="ckeditor mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <!-- Meta Tab -->
                    <div x-show="tab==='meta'" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="meta[title]" value="Meta Title" />
                            <x-text-input id="meta[title]" name="meta[title]" type="text" class="mt-1 block w-full" />
                        </div>
                        <div>
                            <x-input-label for="meta[key]" value="Meta Key" />
                            <x-text-input id="meta[key]" name="meta[key]" type="text" class="mt-1 block w-full" />
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="meta[description]" value="Meta Description" />
                            <textarea id="meta[description]" name="meta[description]" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>
                    </div>

                    <!-- Extra Tab -->
                    <div x-show="tab==='extra'" class="space-y-4">
                        <div>
                            <x-input-label for="extra[css]" value="Extra CSS" />
                            <textarea id="extra[css]" name="extra[css]" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>
                        <div>
                            <x-input-label for="extra[js]" value="Extra JS" />
                            <textarea id="extra[js]" name="extra[js]" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>
                    </div>

                    <!-- FAQ Tab -->
                    <div x-show="tab==='faq'" id="dynamic_faq" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                            <div>
                                <x-input-label value="Question" />
                                <x-text-input name="faq[0][0]" type="text" placeholder="FAQ Question 1" class="block w-full" />
                            </div>
                            <div>
                                <x-input-label value="Answer" />
                                <textarea name="faq[0][1]" placeholder="FAQ Answer 1" class="block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                            </div>
                        </div>
                        <button type="button" id="addmorefaq" class="mt-2 px-4 py-2 bg-green-500 text-white rounded-md">+ Add More FAQ</button>
                    </div>

                    <!-- How To Tab -->
                    <div x-show="tab==='howto'" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <x-text-input name="extra[howtotitle]" placeholder="Procedure Title" />
                            <x-text-input name="extra[estimatedCost]" placeholder="Estimated Cost" />
                            <x-text-input name="extra[totalTime]" placeholder="Estimated Time" />
                        </div>
                        <textarea name="extra[howtodetails]" rows="3" placeholder="Procedure Details" class="block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        <textarea name="extra[tools]" rows="2" placeholder="Tools" class="block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        <textarea name="extra[supplies]" rows="2" placeholder="Supplies" class="block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-4">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Create</button>
                    <button type="submit" name="continue" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Create & Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
