<?php

namespace App\Http\Livewire\Country;

use App\Models\Country;
use Livewire\Component;

class CountryIndex extends Component
{
    public $editMode = false;
    public $search = '';
    public $country_code;
    public $name;
    public $countryid;
    protected $rules = [
        'country_code' => 'required',
        'name' => 'required|min:6',
    ];

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    //edit
    public function edit($id)
    {
        $Cnt = Country::where('id',$id)->first();
        $this->countryid = $id;
        $this->country_code = $Cnt->country_code;
        $this->name = $Cnt->name;
        $this->editMode = true;

        $this->dispatchBrowserEvent('modal', ['modalId' => '#countryModal', 'actionModal' => 'show']);

    }
    //update
    public function update()
    {
        $this->validate();
        Country::where('id',$this->countryid)->update([
            'country_code' => $this->country_code,
            'name' => $this->name
        ]);
        $this->dispatchBrowserEvent('modal', ['modalId' => '#countryModal', 'actionModal' => 'hide']);
        $this->reset();
        session()->flash('Country_message','Country successfully updated');
    }
    //delete
    public function delete($id)
    {
        $Cnt = Country::where('id',$id)->delete();
        session()->flash('Country_message','Country successfully deleted');
    }
    //store
    public function storeCountry()
    {
        $this->validate();
        Country::create([
            'country_code' => $this->country_code,
            'name' => $this->name
        ]);
        $this->dispatchBrowserEvent('modal', ['modalId' => '#countryModal', 'actionModal' => 'hide']);
        $this->reset();
        session()->flash('Country_message','Country successfully created');

    }
    //open model
    public function Openmodel()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#countryModal', 'actionModal' => 'show']);

    }
    //close model
    public function Closemodel()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#countryModal', 'actionModal' => 'hide']);
    }

    public function render()
    {
        $Country = Country::where('name','like',"%{$this->search}%")->paginate(5);
        return view('livewire.country.country-index',
            ['Country'=>$Country]
        )->layout('layouts.main');
    }
}
