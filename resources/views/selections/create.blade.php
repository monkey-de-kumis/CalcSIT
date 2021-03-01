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
                <div class="flex flex-col ">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-center inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden border-b border-white-200 sm:rounded-lg">

            <x-jet-validation-errors class="mb-4 bg-red-100" />

                <form method="POST" action="{{ route('selections.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                          <div class="grid grid-cols-5 gap-6">
                            <div class="col-start-2 col-span-3 ">
                    <div>
                        <x-jet-label for="name" value="{{ __('Varietas') }}" />
                        <select name="variety_id" id="variety_id" class="form-select rounded-md shadow-sm mt-1 block w-full appearance-none" required autofocus>
                            <option>Pilih Varietas</option>
                            @foreach($varieties as $row)
                              <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                          </select>
                            @error('variety_id')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="description" value="{{ __('Deskripsi') }}" />
                          
                        <textarea id="description" class="block mt-1 w-full" name="description" required></textarea>
                        @error('description')
                                <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="file-upload" value="{{ __('File') }}" />
                        <div class="flex text-sm text-gray-600">
                            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                
                                <input id="file-upload" name="file_upload" type="file">
                 
                               
                            </div>
                            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2  rounded-md">
                                <a href="{{ route('example') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded my-3">Template Dokumen</a>
                            </div>
                        </div>
                        @error('file-upload')
                                <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="characteristic" value="{{ __('Susunan Karakteristik') }}" />
                        <select class="form-multiselect block w-full mt-1 basic-multiple appearance-none" name="chars[]" multiple="multiple">
                            @foreach($chars as $row)
                            <option value="{{$row->code}}">{{$row->name}}</option>
                            @endforeach
                          </select>
                            @if($errors->has('chars'))
                                <span class="text-red-500">{{ $errors->first('chars') }}</span>
                            @endif
                    </div>

                    

                   

                    <div class="flex items-center justify-end mt-4">
                       

                        <x-jet-button class="ml-4">
                            {{ __('Save') }}
                        </x-jet-button>
                    </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </form>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </x-app-layout>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#variety_id').select2({
            placeholder: 'Pilih Varietas',
        });
        $('.basic-multiple').select2();
    });

</script>
