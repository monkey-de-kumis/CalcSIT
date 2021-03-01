<div class="p-6">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Seleksi Index Terboboti') }}
            </h2>
        </x-slot>
        <!-- component -->
<style>
    :root {
        --main-color: #4a76a8;
    }

    .bg-main-color {
        background-color: var(--main-color);
    }

    .text-main-color {
        color: var(--main-color);
    }

    .border-main-color {
        border-color: var(--main-color);
    }
</style>




<div class="bg-gray-100 h-full">
 

    <div class="container mx-auto my-5 p-5">
        <div class="md:flex no-wrap md:-mx-2 ">
            <!-- Left Side -->
            <div class="w-full md:w-3/12 md:mx-2">
                <!-- Profile Card -->
                <div class="bg-white p-3 border-t-4 border-green-400">
                    
                    <div class="image overflow-hidden">
                        <img class="h-auto w-full mx-auto"
                            src="{{ asset('storage/images/'.$selection->varieties->image) }}"
                            alt="">
                    </div>
                    <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ $selection->varieties->name }}</h1>
                    <h3 class="text-gray-600 font-lg text-semibold leading-6">{{ $selection->varieties->description}}</h3>
                    <p class="text-sm text-gray-500 hover:text-gray-600 leading-6">
                        Deskripsi Seleksi Index :<br>
                        {{$selection->description }}</p>
                    <ul
                        class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                        <li class="flex items-center py-3">
                            <span>Status</span>
                            <span class="ml-auto"><span
                                    class="bg-green-500 py-1 px-2 rounded text-white text-sm">Active</span></span>
                        </li>
                        <li class="flex items-center py-3">
                            <span>Member since</span>
                            <span class="ml-auto">Nov 07, 2016</span>
                        </li>
                    </ul>

                </div>
                <!-- End of profile card -->
                <div class="my-4"></div>
               
            </div>
            <!-- Right Side -->
            <div class="w-full md:w-9/12 mx-2 h-64">
                <!-- Profile tab -->
                <!-- About Section -->
                <div class="bg-white p-3 shadow-sm rounded-sm">
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                        <span clas="text-green-500">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="tracking-wide">Data Pengamatan</span>
                    </div>
                    <div class="text-gray-700">
                            table
                            <div class="flex flex-wrap items-center content-center">    
                                <table class="table-auto w-full text-center">
                                    <thead class="justify-between flex w-full">
                                    <tr class="bg-gray-800 flex w-full mb-4">
                                        <th class="p-4 w-1/4">
                                        <span class="text-gray-300">#</span>
                                        </th>
                                        <th class="p-4 w-1/4">
                                        <span class="text-gray-300">Pohon</span>
                                        </th>
                                        @foreach($headers as $idx => $header)
                                        <th class="p-4 w-1/4">
                                            <span class="text-gray-300">{{ $header }}</span>
                                        </th> 
                                        @endforeach
                                    </thead>
                                    <tbody class="bg-gray-200 flex flex-col items-center overflow-y-scroll w-full" 
                                    style="height: 50vh;">
                                    @foreach($data as $key => $val)    
                                        <tr class="bg-white border-4 border-gray-200 mb-4 flex w-full">
                                            <td class="p-4 w-1/4">{{$loop->iteration}}</td>
                                            @foreach($val as $idx => $score)
                                            <td class="p-4 w-1/4">{{$score}}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                        <tr class="bg-white border-gray-200 mb-4 flex w-full">
                                            <th class="p-4 w-1/4" colspan=2>Avg : </th>
                                            @foreach($sum['avg'] as $k => $v)
                                                <td class="p-4 w-1/4">{{$v}}</td>
                                            @endforeach
                                        </tr>
                                        <tr class="bg-white border-gray-200 flex w-full">
                                            <th class="p-4 w-1/4" colspan=2>Stdv : </th>
                                            @foreach($sum['stdv'] as $k => $v)
                                                <td class="p-4 w-1/4">{{$v}}</td>
                                            @endforeach
                                        </tr>

                                    </tbody>        
                                </table>
                        </div>
                        
                    </div>
                    <button
                        class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Show
                        Full Information</button>
                </div>
                <!-- End of about section -->

                <div class="my-4"></div>

                <!-- Experience and education -->
                <div class="bg-white p-3 shadow-sm rounded-sm">

                    <div class="">
                        <div>
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                <span clas="text-green-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">Seleksi Index</span>
                            </div>
                           
                        </div>
                        <div class="text-gray-700">
                            
                            <div class="flex flex-wrap items-center content-center">
                                <table class="table-auto w-full text-center">
                                    <thead class="justify-between flex w-full">
                                    <tr class="bg-gray-800 flex w-full mb-2">
                                        <th class="p-4 w-1/4"> 
                                            <span class="text-gray-300">Pohon</span>
                                        </th>
                                        @foreach($headers as $idx => $header)
                                        <th class="p-4 w-1/4">
                                            <span class="text-gray-300">{{ $header }}@</span>
                                        </th> 
                                        @endforeach
                                        <th class="p-4 w-1/4"> 
                                            <span class="text-gray-300">Seleksi Index</span>
                                        </th>
                                    </tr> 
                                    </thead>
                                    <tbody class="bg-gray-200 flex flex-col items-center overflow-y-scroll w-full" 
                                    style="height: 50vh;">
                                    @foreach($selectionIndexs as $key => $idx)    
                                    <tr class="bg-white border-4 border-gray-200 mb-2 flex w-full">
                                        
                                        @foreach($idx as $x => $row)
                                        <td class="p-4 w-1/4">{{$row}}</td>
                                        @endforeach
                                    </tr>
                                @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                    <!-- End of Experience and education grid -->
                </div>
                <!-- End of profile tab -->
            </div>
        </div>
    </div>
</div>

    </x-app-layout>
</div>