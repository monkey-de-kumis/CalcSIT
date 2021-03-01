<?php

namespace App\Http\Livewire;


use App\Models\Variety;

use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;


class Varieties extends Component
{
	use WithPagination;
	use WithFileUploads;
	public  $name, $image, $description, $user_id, $variety_id;
	public $isOpen = 0;


    public function render()
    {

        
        return view('livewire.varieties', ['varieties' => Variety::orderBy('created_at','desc')->paginate(20)]);
    }

    public function create()
	{

        $this->resetInputFields();

        $this->openModal();

    }

    public function openModal()
	{

        $this->isOpen = true;

    }

    public function closeModal()
	{

        $this->isOpen = false;

    }

    private function resetInputFields()
    {

        $this->name = '';

        $this->image = '';

        $this->description = '';

        $this->variety_id = '';

    }

    public function previewImage() 
    {
    	$this->validate([
    		'image'=>'image|max:2040'
    	]);
    }

    public function store()

    {

        $this->validate([

            'name' => 'required',
            'image' => 'required|image|max:2048',
            'description' => 'required',

        ]);
            
        $imageName = md5($this->image.microtime().'.'.$this->image->extension());
        Storage::putFileAs(
        	'public/images',
        	$this->image,
        	$imageName
        );

        $this->variety_id = empty($this->variety_id)?NULL:$this->variety_id;
        
        Variety::updateOrCreate(['id' => $this->variety_id], [

            'name' => $this->name,
            'image' =>$imageName,

            'description' => $this->description,
            'user_id' => Auth::id()

        ]);

  

        session()->flash('message', 

            $this->variety_id ? 'Varietas '.$this->name.' Updated Successfully.' : 'Varietas '.$this->name.' Created Successfully.');

  

        $this->closeModal();

        $this->resetInputFields();

    }

        public function edit($id)

    {

        $variety = Variety::findOrFail($id);

        $this->variety_id = $id;

        $this->name = $variety->name;

        $this->image = '';

        $this->description = $variety->description;

    

        $this->openModal();

    }

    public function delete($id)
    {

        Variety::find($id)->delete();

        session()->flash('message', 'Varietas Deleted Successfully.');

    }

}
