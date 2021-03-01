<div>
    <x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        Manage Varietas

    </h2>

    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                @if (session()->has('message'))

                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">

                      <div class="flex">

                        <div>

                          <p class="text-sm">{{ session('message') }}</p>

                        </div>

                      </div>

                    </div>

                @endif

                <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">New Varietas</button>

                @if($isOpen ?? '')

                    @include('setup.varieties')

                @endif
                <table class="table-fixed w-full">

                    <thead>

                        <tr class="bg-gray-100">

                            <th class="border px-4 py-2">#</th>

                            <th class="border px-4 py-2">Name</th>

                            <th class="border px-4 py-2">Gambar</th>

                            <th class="border px-4 py-2">Deskripsi</th>

                            <th class="border px-4 py-2">Action</th>

                        </tr>

                    </thead>

                    <tbody>
                      
                        @foreach($varieties as $variety)

                        <tr>
                            
                            <th scope="row" class="border whitespace-nowrap">{{ $loop->iteration }}</th>

                            <td class="border px-4 py-2">{{ $variety->name }}</td>

                            <td class="border px-4 py-2"><img src="{{ asset('storage/images/'.$variety->image) }}" class="object-contain h-48 w-full"></td>

                            <td class="border px-4 py-2">{{ $variety->description }}</td>

                            <td class="border px-4 py-2">

                            <button wire:click="edit({{ $variety->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>

                                <button wire:click="delete({{ $variety->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>

                            </td>

                        </tr>

                        @endforeach
                     
                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>
