<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <small
                    class="block uppercase text-gray-500 tracking-wide font-regular text-xs">{{ $artist->genre }}</small>
                {{ $artist->name }}
            </h2>
            @if(Auth::user()->is_admin)
                <div>
                    <a href="{{route('admin.artists.edit',$artist)}}"
                       class="py-2 px-4 rounded bg-yellow-400 text-black">{{__('Edit')}}</a>
                    <a href="#"
                       onclick="window._deleteItem('deleteArtist','{{route('admin.artists.destroy',$artist)}}')"
                       class="py-2 px-4 rounded bg-red-500 text-white">{{__('Destroy')}}</a>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-4 gap-4">
                @foreach($artist->art as $art)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <span class="text-gray-400 text-xs">{{$art->created_at->diffForHumans(null,false,true)}}</span>
                        <h3 class="font-bold text-lg text-gray-700 leading-tight tracking-tight">
                            {{$art->title}}
                        </h3>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <form method="post" id="deleteArtist">
        @csrf
        @method('DELETE')
    </form>
</x-app-layout>
