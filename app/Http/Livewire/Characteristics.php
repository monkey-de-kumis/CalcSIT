<?php

namespace App\Http\Livewire;

use App\Models\Characteristic as Char;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Characteristics extends Component
{
    public  $name, $code, $description, $user_id, $characteristic_id, $weight;
	public $isOpen = 0;

    public function render()
    {
        return view('livewire.characteristics',['chars' => Char::orderBy('created_at','desc')->paginate(20)]);
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

        $this->code = '';

        $this->description = '';

        $this->characteristic_id = '';
        $this->weight = '';

    }

   

    public function store()

    {

        $this->validate([

            'name' => 'required',
            'code' => 'required|unique:characteristics,id,'.$this->characteristic_id,
            'weight' => 'required',

        ]);
            
        

        $this->characteristic_id = empty($this->characteristic_id)?NULL:$this->characteristic_id;
       
        Char::updateOrCreate(['id' => $this->characteristic_id], [

            'code' => $this->code,
            'name' => $this->name,
            'weight' => $this->weight,

            'description' => $this->description,
            'user_id' => Auth::id()

        ]);

  

        session()->flash('message', 

            $this->characteristic_id ? 'Varietas '.$this->name.' Updated Successfully.' : 'Varietas '.$this->name.' Created Successfully.');

  

        $this->closeModal();

        $this->resetInputFields();

    }

    public function edit($id)

    {

        $char = Char::findOrFail($id);

        $this->characteristic_id = $id;

        $this->name = $char->name;

        $this->code = $char->code;
        $this->weight = $char->weight;
 
        $this->description = $char->description;

    

        $this->openModal();

    }

    public function delete($id)
    {

        Char::find($id)->delete();

        session()->flash('message', 'Karakteristik Deleted Successfully.');

    }



}
