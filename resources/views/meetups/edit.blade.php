@extends('layouts.app')

@section('content')
    <div class="container md:w-[800px] mx-auto">
        @auth
            <form action="{{ route('meetups.update', $meetup) }}" method="post"
                class="bg-white p-6 mt-20 rounded-20 shadow-xl" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div>
                    <div>
                        <h3 class="text-xl leading-6 font-medium text-gray-900">
                            Edit Meetup
                        </h3>
                    </div>
                    <div class="mt-6 flex flex-col gap-7">
                        <div x-data class="sm:flex items-center">
                            <img x-ref="image" id="image" src="{{ $meetup->logoPath }}" alt="{{ $meetup->title }} logo"
                                class="w-full sm:w-[400px] h-[200px]">
                            <input @change="image.src = URL.createObjectURL($event.target.files[0])" type="file"
                                accept="image/*" id="logo" class="hidden" name="logo">
                            <label for="logo"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer mx-auto w-full justify-center mt-3 sm:w-auto sm:mt-0">
                                <i class="fa-solid fa-arrow-up-from-bracket mr-3"></i>
                                Upload Image
                            </label>
                        </div>
                        <div>
                            <label for="title" class="block font-medium text-gray-700">
                                Title
                            </label>
                            <div class="mt-1">
                                <input type="text" name="title" id="title" placeholder="Title..."
                                    value="{{ old('title', $meetup->title) }}"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                                <x-input-error for="title" />
                            </div>
                        </div>
                        <div>
                            <label for="description" class="block font-medium text-gray-700">
                                Description
                            </label>
                            <div class="mt-1">
                                <textarea rows="5" type="text" name="description" id="description" placeholder="Description..."
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description', $meetup->description) }}</textarea>
                                <x-input-error for="description" />
                            </div>
                        </div>
                        <div>
                            <label for="date" class="block font-medium text-gray-700">
                                Date
                            </label>
                            <div class="mt-1">
                                <input type="datetime-local" name="date" id="date" placeholder="Date..."
                                    value="{{ old('date', $meetup->date) }}"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                                <x-input-error for="date" />
                            </div>
                        </div>
                        <div>
                            <label for="place" class="block font-medium text-gray-700">
                                Place
                            </label>
                            <div class="mt-1">
                                <input type="text" name="place" id="place" placeholder="Place..."
                                    value="{{ old('place', $meetup->place) }}"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                                <x-input-error for="place" />
                            </div>
                        </div>
                        <div>
                            <label for="language" class="block font-medium text-gray-700">
                                Language
                            </label>
                            <div class="mt-1">
                                <input type="text" name="language" id="language" placeholder="Language..."
                                    value="{{ old('language', $meetup->language) }}"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                                <x-input-error for="language" />
                            </div>
                        </div>
                        <div>
                            <label for="organization_id" class="block font-medium text-gray-700">
                                Organization
                            </label>
                            <div class="mt-1">
                                <select name="organization_id" id="organization_id"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option selected value="">Without organization</option>
                                    @foreach ($organizations as $organization)
                                        <option value="{{ $organization['id'] }}"
                                                @if ($organization['id'] === old('organization_id', $meetup->organization?->id)) selected @endif>
                                            {{ $organization['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error for="organization_id"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-6">
                    <div class="flex justify-end">
                        <a href="{{ route('meetups') }}"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        @endauth
    </div>
@endsection
