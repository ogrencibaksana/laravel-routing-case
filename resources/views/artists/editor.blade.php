<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $artist->created_at ? __('Edit Artist').' '.$artist->name : __('New Artist') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form
                        action="{{$artist->created_at ? route('admin.artists.update',$artist) : route('admin.artists.store')}}"
                        method="post">
                        @csrf
                        <div class="flex justify-between items-center gap-4">
                            <x-label for="name" :value="__('Name')"/>
                            <x-input id="name" class="block my-1 max-w-3xl" type="text" name="name"
                                     :value="old('email') ?? $artist->name" required/>
                        </div>
                        <div class="flex justify-between items-center gap-4">
                            <x-label for="genre" :value="__('Genre')"/>
                            <x-input id="genre" class="block my-1 max-w-3xl" type="text" name="genre"
                                     :value="old('genre') ?? $artist->genre" required/>
                        </div>
                        <div class="flex justify-end mt-4">
                            <x-button>
                                {{ $artist->created_at ? __('Update') : __('Store')}}
                            </x-button>
                        </div>
                        @if($artist->created_at)
                            @method('PATCH')
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
