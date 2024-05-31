@extends('layouts.app')

@section('content')
    <div class="container mx-auto">

        <section class="py-4 mt-4 bg-white rounded-xl dark:bg-gray-800 dark:text-gray-100">
            <div class="container px-4 mx-auto">
                <div class="flex flex-wrap items-center justify-between mx-4">
                    <div class="w-full px-4 mb-2 text-center md:text-left md:w-auto md:mb-0">
                        <h2 class="text-3xl font-bold leading-relaxed font-heading">Offers</h2>
                    </div>
                </div>
            </div>
        </section>

        <section class="container px-4 py-8 mx-auto">
            <div class="py-4 mb-4 bg-white rounded-xl dark:bg-gray-800 dark:text-gray-100">
                <form action="{{ auth()->user()->isAdmin() ? route('offers.index') : route('offers.seller') }}" method="GET"
                    class="flex flex-col items-center justify-center gap-8 md:flex-row">

                    <div class="px-2 bg-white rounded-3xl">
                        <select name="status"
                            class="font-bold text-gray-900 placeholder-gray-200 bg-transparent border-0 focus:border-0">
                            <option value="" selected class="dark:text-gray-100 dark:bg-gray-800">Select status...
                            </option>
                            @foreach (\App\Constants\Status::LIST as $status)
                                <option class="dark:text-gray-100 dark:bg-gray-800"
                                    {{ request()->query('status') === $status ? 'selected' : '' }}
                                    value="{{ $status }}">{{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="px-2 bg-white border border-gray-200 rounded-3xl">
                        <select class="font-bold text-gray-900 placeholder-gray-200 bg-transparent border-0 focus:border-0"
                            name="location">
                            <option selected class="dark:text-gray-100 dark:bg-gray-800">Select location...
                            </option>
                            @foreach ($locations as $location)
                                <option class="dark:text-gray-100 dark:bg-gray-800"
                                    {{ request()->query('location') == $location->id ? 'selected' : '' }}
                                    value="{{ $location->id }}">{{ $location->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="px-2 bg-white border border-gray-200 rounded-3xl">
                        <select class="font-bold text-gray-900 bg-transparent border-0 focus:border-0" name="category">
                            <option selected class="dark:text-gray-100 dark:bg-gray-800">Select category...
                            </option>
                            @foreach ($categories as $category)
                                <option class="dark:text-gray-100 dark:bg-gray-800"
                                    {{ request()->query('category') == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input class="pl-6 font-bold text-gray-900 placeholder-gray-800 rounded-full" type="text"
                            name="title" placeholder="Search by title..." value="{{ request()->query('title') }}">
                    </div>
                    <div>
                        <button type="submit"
                            class="inline-block w-full max-w-full px-8 py-2 text-lg font-bold text-center text-white bg-green-700 rounded-full place-items-center md:max-w-max hover:bg-green-800 focus:ring-2 focus:ring-green-200">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-6">
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path
                                    d="M18.031 16.617l4.283 4.282-1.415 1.415-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9 9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.868-3.133-7-7-7-3.868 0-7 3.132-7 7 0 3.867 3.132 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15z"
                                    fill="rgba(255,255,255,1)" />
                            </svg>
                        </button>
                    </div>
                    <a href="{{ url()->current() }}"
                        class="inline-block px-8 py-2 font-bold text-center text-black bg-gray-200 rounded-full place-items-center md:max-w-max text-md hover:bg-gray-300 focus:ring-4 focus:ring-gray-200">
                        Clear filter
                    </a>
                </form>
            </div>

            @if ($offers->count() <= 0)
                <div class="mb-16 bg-white border border-gray-100 rounded-xl dark:bg-gray-800 dark:text-gray-100">
                    <div class="flex flex-col items-center justify-center">
                        <img class="max-w-sm" src="{{ asset('images/no-result.png') }}" alt="No result">
                        <h3 class="p-6 text-xl text-center">
                            No data found
                        </h3>
                    </div>
                </div>
            @else
                <div
                    class="mb-2 overflow-x-auto bg-white border border-gray-100 rounded-xl dark:bg-gray-800 dark:text-gray-100">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="h-20 py-10 bg-gray-200">
                                @foreach (['Created by', 'Title', 'Price', 'Category', 'Location', 'Status'] as $title)
                                    <td class="px-2 border-b border-gray-100 dark:bg-gray-700 dark:text-gray-100">
                                        <div class="flex items-center pl-4 text-sm font-semibold uppercase font-heading">
                                            {{ $title }}
                                        </div>
                                    </td>
                                @endforeach
                                <td class="relative px-2 border-b border-gray-100 dark:bg-gray-700 dark:text-gray-100">
                                    <div
                                        class="flex items-center justify-center pl-4 text-sm font-semibold uppercase font-heading">
                                        Action
                                    </div>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offers as $offer)
                                <tr class="border-b border-gray-100">
                                    <td class="p-0">
                                        <div class="flex items-center pl-4 break-words">
                                            <img class="object-cover w-8 h-8 rounded-full"
                                                src="{{ asset($offer->author->image_url) }}" alt="User">
                                            <span
                                                class="inline-block ml-5 font-medium font-heading">{{ $offer->author->name }}</span>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <a href="{{ route('offers.show', $offer) }}"
                                            class="flex items-center pl-4 break-words">
                                            <span class="font-medium font-heading">{{ $offer->title }}</span>
                                        </a>
                                    </td>
                                    <td class="p-0">
                                        <div class="flex items-center p-5 break-words">
                                            <span class="text-darkBlueGray-400 font-heading">{{ $offer->price }}</span>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="flex items-center p-5 break-words">
                                            <span
                                                class="text-darkBlueGray-400 font-heading">{{ getTitles($offer->categories) }}</span>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="flex items-center p-5 break-words">
                                            <span
                                                class="text-darkBlueGray-400 font-heading">{{ getTitles($offer->locations) }}</span>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="flex items-center p-5">
                                            @if ($offer->status === \App\Constants\Status::DRAFT)
                                                <span
                                                    class="px-2 py-1 text-white bg-gray-500 font-heading rounded-xl">{{ $offer->status }}</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 text-white bg-green-500 font-heading rounded-xl">{{ $offer->status }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="flex items-center justify-center p-5">
                                            <a class="inline-flex items-center justify-center w-8 h-8 mr-2 bg-green-500 hover:bg-green-600 rounded-2xl"
                                                href="{{ route('offers.edit', $offer->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                                    height="20">
                                                    <path fill="none" d="M0 0h24v24H0z" />
                                                    <path
                                                        d="M15.728 9.686l-1.414-1.414L5 17.586V19h1.414l9.314-9.314zm1.414-1.414l1.414-1.414-1.414-1.414-1.414 1.414 1.414 1.414zM7.242 21H3v-4.243L16.435 3.322a1 1 0 0 1 1.414 0l2.829 2.829a1 1 0 0 1 0 1.414L7.243 21z"
                                                        fill="rgba(255,255,255,1)" />
                                                </svg>
                                            </a>
                                            <button data-delete-route="{{ route('offers.destroy', $offer->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 bg-red-500 delete-item-btn hover:bg-red-600 rounded-2xl">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                                    height="20">
                                                    <path fill="none" d="M0 0h24v24H0z" />
                                                    <path
                                                        d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"
                                                        fill="rgba(255,255,255,1)" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{ $offers->links() }}
                </div>
            @endif
        </section>
    </div>
@endsection
@section('script')
    @include('layouts.scripts.delete-script')
@endsection
