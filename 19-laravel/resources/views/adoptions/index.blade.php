@extends('layouts.app')

@section('title', 'Larapets: Module Adoptions')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-10" fill="currentColor" viewBox="0 0 256 256">
            <path d="M178,40c-20.65,0-38.73,8.88-50,23.89C116.73,48.88,98.65,40,78,40a62.07,62.07,0,0,0-62,62c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,228.66,240,172,240,102A62.07,62.07,0,0,0,178,40ZM128,214.8C109.74,204.16,32,155.69,32,102A46.06,46.06,0,0,1,78,56c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,155.61,146.24,204.15,128,214.8Z"></path>
        </svg>
        Module Adoptions
    </h1>

    {{-- Options --}}
    <div class="flex flex-col gap-4 justify-center items-center">
        <div class="join mx-auto">
            <a class="btn btn-outline text-white hover:bg-[#fff6] hover:text-white join-item" href="{{ url('export/adoptions/pdf') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M224,152a8,8,0,0,1-8,8H192v16h16a8,8,0,0,1,0,16H192v16a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8h32A8,8,0,0,1,224,152ZM92,172a28,28,0,0,1-28,28H56v8a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8H64A28,28,0,0,1,92,172Zm-16,0a12,12,0,0,0-12-12H56v24h8A12,12,0,0,0,76,172Zm88,8a36,36,0,0,1-36,36H112a8,8,0,0,1-8-8V152a8,8,0,0,1,8-8h16A36,36,0,0,1,164,180Zm-16,0a20,20,0,0,0-20-20h-8v40h8A20,20,0,0,0,148,180ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,0,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.69L160,51.31Z"></path>
                </svg>
                <span class="hidden md:inline">Export</span>
            </a>
            <a class="btn btn-outline text-white hover:bg-[#fff6] hover:text-white join-item" href="{{ url('export/adoptions/excel') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M156,208a8,8,0,0,1-8,8H120a8,8,0,0,1-8-8V152a8,8,0,0,1,16,0v48h20A8,8,0,0,1,156,208ZM92.65,145.49a8,8,0,0,0-11.16,1.86L68,166.24,54.51,147.35a8,8,0,1,0-13,9.3L58.17,180,41.49,203.35a8,8,0,0,0,13,9.3L68,193.76l13.49,18.89a8,8,0,0,0,13-9.3L77.83,180l16.68-23.35A8,8,0,0,0,92.65,145.49Zm98.94,25.82c-4-1.16-8.14-2.35-10.45-3.84-1.25-.82-1.23-1-1.12-1.9a4.54,4.54,0,0,1,2-3.67c4.6-3.12,15.34-1.72,19.82-.56a8,8,0,0,0,4.07-15.48c-2.11-.55-21-5.22-32.83,2.76a20.58,20.58,0,0,0-8.95,14.95c-2,15.88,13.65,20.41,23,23.11,12.06,3.49,13.12,4.92,12.78,7.59-.31,2.41-1.26,3.33-2.15,3.93-4.6,3.06-15.16,1.55-19.54.35A8,8,0,0,0,173.93,214a60.63,60.63,0,0,0,15.19,2c5.82,0,12.3-1,17.49-4.46a20.81,20.81,0,0,0,9.18-15.23C218,179,201.48,174.17,191.59,171.31ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,1,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.68L160,51.31Z"></path>
                </svg>
                <span class="hidden md:inline">Export</span>
            </a>
        </div>
        {{-- Search --}}
        <label class="input text-white bg-[#0009] w-58 md:w-110 outline outline-white mb-10">
            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </g>
            </svg>
            <input type="search" placeholder="Search..." name="qsearch" id="qsearch" />
        </label>
    </div>

    <div class="w-full max-w-2xl mx-auto flex flex-col mt-4 datalist">
        @forelse ($adoptions as $adoption)
            <div class="flex flex-col items-center justify-center border-b border-dashed border-gray-600 py-8 last:border-b-0">
                <div class="flex items-center justify-center -space-x-6 mb-4">
                    {{-- User image --}}
                    <div class="avatar z-10">
                        <div class="w-28 h-28 rounded-full border-4 border-black bg-white">
                            <img src="{{ asset('images/' . $adoption->user->photo) }}" onerror="this.src='{{ asset('images/no-photo.png') }}'" />
                        </div>
                    </div>
                    {{-- Pet image --}}
                    <div class="avatar z-0">
                        <div class="w-28 h-28 rounded-full border-4 border-black bg-white">
                            <img src="{{ asset('images/' . $adoption->pet->image) }}" />
                        </div>
                    </div>
                </div>
                
                <p class="text-white text-base mb-6 text-center">
                    <strong>{{ $adoption->pet->name }}</strong> was adopted by <strong>{{ $adoption->user->fullname }}</strong> {{ $adoption->created_at->diffForHumans() }}
                </p>
                
                <a href="{{ url('adoptions/' . $adoption->id) }}" class="btn btn-outline text-white hover:bg-[#fff6] hover:text-white px-8 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4 mr-2" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                    </svg>
                    Show more
                </a>
            </div>
        @empty
            <div class="text-center py-10">
                <p class="text-lg text-white opacity-70">No adoptions found.</p>
            </div>
        @endforelse

        <div class="mt-8 flex justify-center w-full">
            {{ $adoptions->links('partials.pagination') }}
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Search - - - - - - - - - - - - - - - -
        function debounce(func, wait) {
            let timeout
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout)
                    func(...args)
                };
                clearTimeout(timeout)
                timeout = setTimeout(later, wait)
            }
        }
        const search = debounce(function(query) {
            $token = $('input[name=_token]').val()
            $.post("search/adoptions", {'q': query, '_token': $token},
                function (data) {
                    $('.datalist').html(data).hide().fadeIn(1000)
                }
            )
        }, 500)
        
        $('body').on('input', '#qsearch', function(event) {
            event.preventDefault()
            const query = $(this).val()
            
            $('.datalist').html(`<div class="text-center py-18 w-full"><span class="loading loading-spinner loading-xl"></span></div>`)
            
            if(query != '') {
                search(query)
            } else {
                setTimeout(() => {
                    window.location.replace('adoptions')
                }, 500)
            }
        })
    </script>
@endsection
