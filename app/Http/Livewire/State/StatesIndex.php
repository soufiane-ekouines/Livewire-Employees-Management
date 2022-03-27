<?php

namespace App\Http\Livewire\State;

use App\Models\Country;
use App\Models\State;
use Livewire\Component;

class StatesIndex extends Component
{
    public $search = '';
    public $states_id;
    public $editMode = false;
    public $country_id;
    public $name;
    public $rules = [
        'name'=>'required',
        'country_id'=>'required',
    ];

    //store
    public function storeStates()
    {
        // $this->validate();

        State::create([
            'name' => $this->name,
            'country_id' => $this->country_id,
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#StatesModal', 'actionModal' => 'hide']);

    }

    //edite
    public function edit($id)
    {
        $state = State::where('id',$id)->first();
        $this->country_id = $state->country_id;
        $this->name = $state->name;
        $this->states_id =$id;
        $this->editMode = true;
        $this->dispatchBrowserEvent('modal', ['modalId' => '#StatesModal', 'actionModal' => 'show']);

    }

    //update
    public function update()
    {
        $this->validate();

        State::where('id',$this->states_id)->Update([
            'name' => $this->name,
            'country_id' => $this->country_id,
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#StatesModal', 'actionModal' => 'hide']);

    }

    //delete
    public function delete($id)
    {
        State::where('id',$id)->delete();
    }


    //open model
    public function Openmodel()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#StatesModal', 'actionModal' => 'show']);

    }

    //close
    public function Closemodel()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#StatesModal', 'actionModal' => 'hide']);
    }
    public function render()
    {
        $st = State::where('name','like',"%{$this->search}%")->get();

        // $st = State::all();

        return view('livewire.state.states-index',
            [
            'States'=>$st,
            'countrty' => Country::all()
            ]
        )->layout('layouts.main');
    }
}
