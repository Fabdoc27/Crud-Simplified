@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <section class="py-8">
            <div class="flex flex-col gap-4 py-2 md:py-6 sm:py-12 md:flex-row md:justify-center align-items">
                <div
                    class="h-full max-w-3xl px-5 py-4 mx-6 bg-white shadow dark:bg-gray-800 md:w-full md:py-10 rounded-3xl ">
                    <h2
                        class="pb-2 text-xl font-semibold leading-relaxed text-center text-gray-700 border-b border-b-gray-500 dark:text-gray-100">
                        Offer details</h2>
                    <div class="p-4 space-y-4 text-base leading-6 text-gray-700 md:p-8 sm:text-lg sm:leading-7">
                        <div class="flex items-center justify-center p-4">
                            <img class="object-cover w-48 h-32 md:w-96 md:h-72 rounded-3xl"
                                src="{{ asset($offer->image_url) }}" alt="Preview Image">
                        </div>
                        <div class="flex flex-col dark:text-gray-100">
                            <label class="font-bold leading-loose">Title</label>
                            <p class="text-sm">
                                {{ $offer->title }}
                            </p>
                        </div>
                        <div class="flex flex-col dark:text-gray-100">
                            <label class="font-bold leading-loose">Price</label>
                            <div class="text-sm">
                                {{ $offer->price }}
                            </div>
                        </div>
                        <div class="flex flex-col dark:text-gray-100">
                            <label class="font-bold leading-loose">Created by</label>
                            <div class="text-sm">
                                {{ $offer->author->name }}
                            </div>
                        </div>
                        <div class="flex flex-col dark:text-gray-100">
                            <label class="font-bold leading-loose">Category</label>
                            <div class="text-sm">
                                {{ getTitles($offer->categories) }}
                            </div>
                        </div>
                        <div class="flex flex-col dark:text-gray-100">
                            <label class="font-bold leading-loose">Location</label>
                            <div class="text-sm">
                                {{ getTitles($offer->locations) }}
                            </div>
                        </div>
                        <div class="flex flex-col dark:text-gray-100">
                            <label class="font-bold leading-loose ">Description</label>
                            <div class="text-sm">
                                {{ $offer->description }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
