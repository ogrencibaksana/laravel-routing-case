<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Artists') }}
            </h2>
            @if(auth()->user()->is_admin)
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a class="py-2 px-4 rounded bg-blue-500 text-white"
                       href="{{route('admin.artists.create')}}">+&emsp;{{__('New')}}</a>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Name')}}</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Genre')}}</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Arts')}}</th>
                        @if(auth()->user()->is_admin)
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Actions')}}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($artists as $artist)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{$artist->id}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{route('artists.show',$artist)}}"
                                   class="text-blue-500 hover:underline">
                                    {{$artist->name}}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$artist->genre}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$artist->art_count}}</td>
                            @if(auth()->user()->is_admin)
                                <td class="px-6 py-4 whitespace-nowrap text-right gap-2">
                                    <a href="{{route('admin.artists.edit',$artist)}}"
                                       class="py-2 px-4 rounded bg-yellow-400 text-black">{{__('Edit')}}</a>
                                    <a href="#"
                                       onclick="window._deleteItem('deleteArtist','{{route('admin.artists.destroy',$artist)}}')"
                                       class="py-2 px-4 rounded bg-red-500 text-white">{{__('Destroy')}}</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{$artists->links()}}
        </div>
    </div>
    <form method="post" id="deleteArtist">
        @csrf
        @method('DELETE')
    </form>
</x-app-layout>
