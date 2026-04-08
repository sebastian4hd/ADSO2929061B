@extends('layouts.app')

@section('title', 'Larapets: Show Pet')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"/>
        </svg>
        Show Pet
    </h1>
    <div class="breadcrumbs text-sm text-white mb-6">
        <ul>
            <li>
                <a href="{{ url('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48Z"/>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ url('pets') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z"/>
                    </svg>
                    Pet Module
                </a>
            </li>
            <li>
                <span class="inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"/>
                    </svg>
                    Show Pet
                </span>
            </li>
        </ul>
    </div>

    <div class="card text-white md:w-[720px] w-[95%] max-w-[720px] bg-black/50 p-4 md:p-8 mb-4 mx-auto">
        <div class="flex flex-col items-center gap-6">
            {{-- Photo with error handling --}}
            <div class="mask mask-squircle w-32 md:w-48">
                @php
                    $photoPath = 'images/' . ($pet->image ?? 'no-image.png');
                    $fullPhotoPath = public_path($photoPath);
                    $photoExists = file_exists($fullPhotoPath);
                @endphp

                @if($photoExists && !empty($pet->image))
                    <img src="{{ asset($photoPath) }}" alt="Photo of {{ $pet->name ?? 'Pet' }}" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('images/no-image.png') }}" alt="Default pet image" class="w-full h-full object-cover">
                @endif
            </div>

            {{-- Responsive grid: 1 columna en móvil, 2 columnas en desktop --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 md:gap-x-16 gap-y-4 w-full">
                {{-- Columna izquierda --}}
                <div class="flex flex-col gap-4">
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Name:</span>
                        <span class="break-all">{{ $pet->name ?? 'Not specified' }}</span>
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Kind:</span>
                        <span class="break-all">{{ $pet->kind ?? 'Not specified' }}</span>
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Age (months):</span>
                        <span class="break-all">{{ $pet->age ?? 'Not specified' }}</span>
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Weight (kg):</span>
                        <span class="break-all">{{ $pet->weight ?? 'Not specified' }}</span>
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Breed:</span>
                        <span class="break-all">{{ $pet->bread ?? 'Not specified' }}</span>
                    </div>
                </div>

                {{-- Columna derecha --}}
                <div class="flex flex-col gap-4">
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Location:</span>
                        <span class="break-all">{{ $pet->location ?? 'Not specified' }}</span>
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Active:</span>
                        <span class="badge badge-outline mt-1">
                            @if(isset($pet->active))
                                {{ $pet->active ? 'Yes' : 'No' }}
                            @else
                                Not specified
                            @endif
                        </span>
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Adopted:</span>
                            @if ($pet->adopted)
                                <span class="badge badge-outline badge-success">Adopted</span>
                            @else
                                <span class="badge badge-outline badge-info">Available</span>
                            @endif
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Description:</span>
                        <span class="break-all">{{ $pet->description ?? 'Not specified' }}</span>
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Created At:</span>
                        @if(isset($pet->created_at))
                            {{ $pet->created_at->diffForHumans() }}
                        @else
                            Not available
                        @endif
                    </div>
                </div>
            </div>

            <a href="{{ url('pets') }}" class="btn btn-outline hover:bg-[#fff6] hover:text-white w-full mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5 mr-2" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"/>
                </svg>
                Back
            </a>
        </div>
    </div>
@endsection
