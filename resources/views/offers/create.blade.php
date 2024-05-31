@extends('layouts.app')

@section('content')
    <section>
        <div class="py-12">
            <div class="container mx-auto sm:px-6 lg:px-8">
                <form action="{{ route('offers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center justify-center">
                        <div class="w-1/2 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h2
                                    class="text-xl font-semibold leading-relaxed text-center text-gray-700 dark:text-gray-100">
                                    Create offer
                                </h2>
                                <div
                                    class="py-8 space-y-4 text-base leading-6 text-gray-700 dark:text-gray-100 sm:text-lg sm:leading-7">
                                    <div class="flex flex-col">
                                        <label class="leading-loose">
                                            Title
                                            <span class="text-sm text-red-400">*</span>
                                        </label>
                                        <input name="title" value="{{ old('title') }}" type="text" required="required"
                                            class="my_input" placeholder="Title">
                                        @error('title')
                                            <p class="p-2 text-red-700">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col">
                                        <label class="leading-loose">
                                            Price
                                            <span class="text-sm text-red-400">*</span>
                                        </label>
                                        <input name="price" value="{{ old('price') }}" type="number" min="0"
                                            required="required" class="my_input" placeholder="Price">
                                        @error('price')
                                            <p class="p-2 text-red-700">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col">
                                        <label class="leading-loose">
                                            Category
                                            <span class="text-sm text-red-400">*</span>
                                        </label>
                                        <select class="my_input" id="select-category" name="categories[]" multiple
                                            autocomplete="off">
                                            <option value="" class="dark:bg-gray-800">Select categories...</option>
                                            @foreach ($categories as $category)
                                                <option
                                                    {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}
                                                    value="{{ $category->id }}"> {{ $category->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('categories')
                                            <p class="p-2 text-red-700">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col">
                                        <label class="leading-loose">
                                            Location
                                            <span class="text-sm text-red-400">*</span>
                                        </label>
                                        <select class="my_input" id="select-location" name="locations[]" multiple
                                            autocomplete="off">
                                            <option value="">Select locations...</option>
                                            @foreach ($locations as $location)
                                                <option
                                                    {{ in_array($location->id, old('locations', [])) ? 'selected' : '' }}
                                                    value="{{ $location->id }}"> {{ $location->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('locations')
                                            <p class="p-2 text-red-700">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col image-preview">
                                        <label class="leading-loose">
                                            Image
                                        </label>
                                        <div class="flex items-center justify-center p-4">
                                            <img class="object-cover w-96 h-72 rounded-3xl"
                                                src="{{ asset(\App\Models\Offer::PLACEHOLDER_IMAGE) }}"
                                                alt="Preview Image">
                                        </div>
                                        <input name="image" type="file" class="my_input image-upload-input"
                                            placeholder="">
                                        @error('image')
                                            <p class="p-2 text-red-700">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col">
                                        <label class="leading-loose">
                                            Description
                                            <span class="text-sm text-red-400">*</span>
                                        </label>
                                        <textarea name="description" rows="5" class="my_input" placeholder="Description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <p class="p-2 text-red-700">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <a href=""
                                        class="flex items-center justify-center w-full px-4 py-3 text-gray-900 border border-gray-500 rounded-md dark:text-gray-900 dark:bg-gray-300 focus:outline-none">
                                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewbox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg> Cancel
                                    </a>
                                    <button
                                        class="flex items-center justify-center w-full px-4 py-3 text-white bg-green-500 rounded-md focus:outline-none">Create
                                    </button>

                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
    @include('layouts.scripts.image-upload-preview')

    <script>
        $(document).ready(function() {
            new TomSelect("#select-category", {
                plugins: ['remove_button'],
                maxItems: 5,
                onItemAdd: function() {
                    this.setTextboxValue('');
                },
            });

            new TomSelect("#select-location", {
                plugins: ['remove_button'],
                maxItems: 5,
                onItemAdd: function() {
                    this.setTextboxValue('');
                },
            });
        });
    </script>
@endsection
