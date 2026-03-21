@extends('layouts.app')

@section('title', 'Larapets: Show User')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path
                d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
            </path>
        </svg>
        Show User
    </h1>
    <div class="card text-white md:w-[720px] w-[320px] bg-black/40 p-4 mb-4 rounded">
            <form method="POST" action="{{ url('users') }}" class="flex flex-col md:flex-row gap-4 mt-4" enctype="multipart/form-data">
                @csrf
                <div class="w-full md:w-[320px]">
                    <div class="avatar flex flex-col gap-1 items-center justify-center cursor-pointer hover:scale-105 transition ease-in">
                        <div id="upload" class="mask mask-squircle w-48">
                            <img src="{{ asset('images/' . $user->photo) }}" />
                        </div>
                    </div>
                    <input type="file" id="photo" name="photo" class="hidden" accept="image/*">
                </div>
                <div class="w-full md:w-[320px]">
                    {{-- Document --}}
                    <label class="label text-white">Document:</label>
                   <td class="hidden md:table-cell">{{ $user->document }}</td>
                    {{-- FullName --}}
                    <label class="label text-white">FullName:</label>
                    <input type="text" class="input bg-[#0009] outline-0" name="fullname" placeholder="Jeremias Springfield" value="{{ old('fullname') }}">
                    @error('fullname')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                    {{-- Gender --}}
                    <label class="label text-white">Gender:</label>
                    <select name="gender" class="select bg-[#0009] outline-0">
                        <option value="">Select...</option>
                        <option value="Female" @if(old('gender') == 'Female') selected @endif>Female</option>
                        <option value="Male" @if(old('gender') == 'Male') selected @endif>Male</option>
                    </select>
                    @error('gender')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                    {{-- Birthdate --}}
                    <label class="label text-white">Birthdate:</label>
                    <input type="date" class="input bg-[#0009] outline-0" name="birthdate" placeholder="1640-10-08" value="{{ old('birthdate') }}">
                    @error('birthdate')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                </div>
                <div class="w-full md:w-[320px]">
                    {{-- Phone --}}
                    <label class="label text-white">Phone:</label>
                    <input type="text" class="input bg-[#0009] outline-0" name="phone" placeholder="3101231234" value="{{ old('phone') }}">
                    @error('phone')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                    {{-- Email --}}
                    <label class="label text-white">Email:</label>
                    <input type="text" class="input bg-[#0009] outline-0" name="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                    {{-- Password --}}
                    <label class="label text-white">Password:</label>
                    <input type="password" class="input bg-[#0009] outline-0" name="password" placeholder="Secret">
                    @error('password')
                        <small class="badge badge-error w-full mt-1 text-xs py-3">{{ $message }}</small>
                    @enderror
                    {{-- Password Confirmation --}}
                    <label class="label text-white">Password Confirmation:</label>
                    <input type="password" class="input bg-[#0009] outline-0" name="password_confirmation" placeholder="Secret">

                    <button class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3 w-full">Add</button>
                </div>
            </form>
        </div>
@endsection
