<div class="p-6">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seleksi Index') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8 bg-white">
                    <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg ">
                        <a href="{{ route('selections.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">
                            New Seleksi Index</a>
                    <br>
                    <br>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs">
                                Varietas
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs">
                                Deskripsi
                                </th>
                                
                                <th scope="col" class="px-6 py-3 text-center text-xs">
                                Aksi
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($selections as $selection)  
                            <tr>
                                <th scope="row" class="whitespace-nowrap">{{ $loop->iteration }}</th>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="{{ asset('storage/images/'.$selection->varieties->image) }}" alt="">
                                    </div>
                                    <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $selection->varieties->name }}
                                    </div>
                                    
                                    </div>
                                </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $selection->description }}</div>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="{{ route('detail_selections', $selection->id) }}" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Show</a>
                                        <a href="{{ route('selections.delete', $selection->id) }}" 
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Delete</a>
                                        </td>
                                </td>
                                    
                            </tr>
                            @empty
                                <tr>
                                    <th colspan="4">Tidak ada data Seleksi Index</th>
                                </tr>
                            @endforelse
                            <!-- More items... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>
</div>
