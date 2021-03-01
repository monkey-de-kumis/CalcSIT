<div>
<x-slot name="header">

<h2 class="font-semibold text-xl text-gray-800 leading-tight">

    Manage Karakteristik

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

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">New Karakteristik</button>

            @if($isOpen ?? '')

                @include('setup.characteristics')

            @endif
            <table class="table-fixed w-full">

                <thead>

                    <tr class="bg-gray-100">

                        <th class="border px-1 py-1">#</th>

                        <th class="border px-4 py-2">Code</th>

                        <th class="border px-4 py-2">Nama</th>

                        <th class="border px-4 py-2">Deskripsi</th>

                        <th class="border px-4 py-2">Bobot</th>

                        <th class="border px-4 py-2">Action</th>

                    </tr>

                </thead>

                <tbody>
                  
                    @foreach($chars as $char)

                    <tr>
                        
                        <th class="border px-1 py-1">{{ $loop->iteration }}</th>

                        <td class="border px-4 py-2">{{ $char->code }}</td>

                        <td class="border px-4 py-2">{{ $char->name }}</td>

                        <td class="border px-4 py-2">{{ $char->description }}</td>

                        <td class="border px-4 py-2">{{ $char->weight }}</td>

                        <td class="border px-4 py-2">

                            <button wire:click="edit({{ $char->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>

                            <button wire:click="delete({{ $char->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>

                        </td>

                    </tr>

                    @endforeach
                 
                </tbody>

            </table>

        </div>

    </div>

</div>
</div>
