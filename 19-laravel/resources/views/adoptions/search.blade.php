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
