@extends('layouts.app')

@section('title', 'Larapets: Show Adoption')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
         <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M178,40c-20.65,0-38.73,8.88-50,23.89C116.73,48.88,98.65,40,78,40a62.07,62.07,0,0,0-62,62c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,228.66,240,172,240,102A62.07,62.07,0,0,0,178,40ZM128,214.8C109.74,204.16,32,155.69,32,102A46.06,46.06,0,0,1,78,56c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,155.61,146.24,204.15,128,214.8Z"></path>
        </svg>
        Show Adoption
    </h1>
    {{-- Breadcrumbs --}}
    <div class="breadcrumbs text-sm text-white mb-6">
        <ul>
            <li>
            <a href="{{ url('dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48Z"></path>
                </svg>
                Dashboard
            </a>
            </li>
            <li>
            <a href="{{ url('adoptions') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z"></path>
                </svg>
                Adoption Module
            </a>
            </li>
            <li>
            <span class="inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4"  fill="currentColor" viewBox="0 0 256 256">
                    <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H136v32a8,8,0,0,1-16,0V136H88a8,8,0,0,1,0-16h32V88a8,8,0,0,1,16,0v32h32A8,8,0,0,1,176,128Z"></path>
                </svg>
                Show Adoption
            </span>
            </li>
        </ul>
        </div>
        <div class="card text-white md:w-[720px] w-[320px] bg-black/40 p-6 mb-4 rounded mx-auto flex flex-col md:flex-row gap-6">
            <div class="flex-1 border-r border-gray-600 pr-4">
                <h2 class="text-xl font-bold mb-4 border-b border-gray-600 pb-2 text-center">Customer</h2>
                <div class="flex flex-col items-center">
                    <div class="avatar mb-4">
                        <div class="w-32 rounded-full border-4 border-gray-600">
                            <img src="{{ asset('images/' . $adoption->user->photo) }}" />
                        </div>
                    </div>
                    <div class="text-lg font-bold">{{ $adoption->user->fullname }}</div>
                    <div class="text-sm opacity-70">{{ $adoption->user->email }}</div>
                    <div class="text-sm opacity-70 mt-2">Phone: {{ $adoption->user->phone }}</div>
                </div>
            </div>
            
            <div class="flex-1 pl-4">
                <h2 class="text-xl font-bold mb-4 border-b border-gray-600 pb-2 text-center">Adopted Pet</h2>
                <div class="flex flex-col items-center">
                    <div class="avatar mb-4">
                        <div class="w-32 mask mask-squircle border-4 border-gray-600">
                            <img src="{{ asset('images/' . $adoption->pet->image) }}" />
                        </div>
                    </div>
                    <div class="text-lg font-bold">{{ $adoption->pet->name }}</div>
                    <div class="text-sm opacity-70">{{ $adoption->pet->kind }} - {{ $adoption->pet->bread }}</div>
                    <div class="text-sm opacity-70 mt-2">Age: {{ $adoption->pet->age }} months | Weight: {{ $adoption->pet->weight }}kg</div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4 mb-10 text-white">
            <p>Adoption Date: <span class="font-bold">{{ $adoption->created_at->format('M d, Y') }}</span></p>
        </div>
@endsection
