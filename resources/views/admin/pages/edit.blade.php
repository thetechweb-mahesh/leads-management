@extends('layouts.admin')

@section('title', isset($pages) ? 'Edit Page' : 'Add Page')

@section('content')
<div class="mb-4 border-b pb-2">
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

            <form 
                action="{{ route('pages.update', $pages->id) }}" 
                method="POST" 
                enctype="multipart/form-data"
            >
                @csrf
                @if(isset($pages))
                    @method('PUT')
                @endif

                <div x-data="{ tab: 'info' }">
                    <!-- Tabs -->
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
                            <x-text-input id="title" name="title" type="text" value="{{ old('title', $pages->title ?? '') }}" required />
                        </div>
                        <div>
                            <x-input-label for="slug" value="Slug" />
                            <x-text-input id="slug" name="slug" type="text" value="{{ old('slug', $pages->slug ?? '') }}" required />
                        </div>
                        <div>
                            <x-input-label for="img" value="Featured Image" />
                            @if(!empty($pages->img))
                                <img src="{{ asset($pages->img) }}" alt="Current Image" class="h-20 mt-2 mb-2">
                            @endif
                            <input type="file" id="img" name="img" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        </div>
                        <div>
                            <x-input-label for="product_in_page" value="Product in this Page" />
                            <select name="product_in_page" id="product_in_page" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="No"  {{ old('product_in_page', $pages->product_in_page ?? 'No') == 'No' ? 'selected' : '' }}>No</option>
                                <option value="Yes" {{ old('product_in_page', $pages->product_in_page ?? 'No') == 'Yes' ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="subtitle" value="Subtitle" />
                            <x-text-input id="subtitle" name="subtitle" value="{{ old('subtitle', $pages->subtitle ?? '') }}" type="text" />
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="details" value="Description" />
                            <textarea id="details" name="details" rows="5" class="ckeditor mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('details', $pages->details ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Banner Tab -->
                    <div x-show="tab==='banner'">
                        <x-input-label for="extra[banner]" value="Banner Subtitle" />
                        <textarea name="extra[banner]" rows="2" class="ckeditor mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('extra.banner', $pages->extra['banner'] ?? '') }}</textarea>
                    </div>

                    <!-- Meta Tab -->
                    <div x-show="tab==='meta'" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="meta[title]" value="Meta Title" />
                            <x-text-input id="meta[title]" name="meta[title]" value="{{ old('meta.title', $pages->meta['title'] ?? '') }}" type="text" />
                        </div>
                        <div>
                            <x-input-label for="meta[key]" value="Meta Key" />
                            <x-text-input id="meta[key]" name="meta[key]" value="{{ old('meta.key', $pages->meta['key'] ?? '') }}" type="text" />
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="meta[description]" value="Meta Description" />
                            <textarea id="meta[description]" name="meta[description]" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('meta.description', $pages->meta['description'] ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Extra Tab -->
                    <div x-show="tab==='extra'" class="space-y-4">
                        <div>
                            <x-input-label for="extra[css]" value="Extra CSS" />
                            <textarea id="extra[css]" name="extra[css]" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('extra.css', $pages->extra['css'] ?? '') }}</textarea>
                        </div>
                        <div>
                            <x-input-label for="extra[js]" value="Extra JS" />
                            <textarea id="extra[js]" name="extra[js]" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('extra.js', $pages->extra['js'] ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- FAQ Tab -->
                    <div x-show="tab==='faq'" id="dynamic_faq" class="space-y-4">
                        @php
                            $faqs = old('faq', $pages->faq ?? [['','']]);
                        @endphp
                        @foreach($faqs as $i => $faq)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                                <div>
                                    <x-input-label value="Question" />
                                    <x-text-input name="faq[{{ $i }}][0]" type="text" value="{{ $faq[0] ?? '' }}" placeholder="FAQ Question {{ $i+1 }}" />
                                </div>
                                <div>
                                    <x-input-label value="Answer" />
                                    <textarea name="faq[{{ $i }}][1]" placeholder="FAQ Answer {{ $i+1 }}" class="block w-full border-gray-300 rounded-md shadow-sm">{{ $faq[1] ?? '' }}</textarea>
                                </div>
                            </div>
                        @endforeach
                        <button type="button" id="addmorefaq" class="mt-2 px-4 py-2 bg-green-500 text-white rounded-md">+ Add More FAQ</button>
                    </div>

                    <!-- How To Tab -->
                    <div x-show="tab==='howto'" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <x-text-input name="extra[howtotitle]" placeholder="Procedure Title" value="{{ old('extra.howtotitle', $pages->extra['howtotitle'] ?? '') }}" />
                            <x-text-input name="extra[estimatedCost]" placeholder="Estimated Cost" value="{{ old('extra.estimatedCost', $pages->extra['estimatedCost'] ?? '') }}" />
                            <x-text-input name="extra[totalTime]" placeholder="Estimated Time" value="{{ old('extra.totalTime', $pages->extra['totalTime'] ?? '') }}" />
                        </div>
                        <textarea name="extra[howtodetails]" rows="3" placeholder="Procedure Details" class="block w-full border-gray-300 rounded-md shadow-sm">{{ old('extra.howtodetails', $pages->extra['howtodetails'] ?? '') }}</textarea>
                        <textarea name="extra[tools]" rows="2" placeholder="Tools" class="block w-full border-gray-300 rounded-md shadow-sm">{{ old('extra.tools', $pages->extra['tools'] ?? '') }}</textarea>
                        <textarea name="extra[supplies]" rows="2" placeholder="Supplies" class="block w-full border-gray-300 rounded-md shadow-sm">{{ old('extra.supplies', $pages->extra['supplies'] ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-4 mt-6">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        {{ isset($pages) ? 'Update' : 'Create' }}
                    </button>
                    <button type="submit" name="continue" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        {{ isset($pages) ? 'Update & Continue' : 'Create & Continue' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
