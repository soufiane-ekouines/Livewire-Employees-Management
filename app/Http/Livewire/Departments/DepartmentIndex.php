<?php

namespace App\Http\Livewire\Departments;

use App\Models\Departement;
use Livewire\Component;

class DepartmentIndex extends Component
{
    public $search = '';
    public $Departements_id;
    public $editMode = false;
    public $name;
    public $rules = [
        'name'=>'required',
    ];

    //store
    public function storeDepartements()
    {
        $this->validate();

        Departement::create([
            'name' => $this->name,
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#DepartementsModal', 'actionModal' => 'hide']);

    }

    //edite
    public function edit($id)
    {
        $Departement = Departement::where('id',$id)->first();
        $this->name = $Departement->name;
        $this->Departements_id =$id;
        $this->editMode = true;
        $this->dispatchBrowserEvent('modal', ['modalId' => '#DepartementsModal', 'actionModal' => 'show']);

    }

    //update
    public function update()
    {
        $this->validate();

        Departement::where('id',$this->Departements_id)->Update([
            'name' => $this->name,
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#DepartementsModal', 'actionModal' => 'hide']);

    }

    //delete
    public function delete($id)
    {
        Departement::where('id',$id)->delete();
    }


    //open model
    public function Openmodel()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#DepartementsModal', 'actionModal' => 'show']);

    }

    //close
    public function Closemodel()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#DepartementsModal', 'actionModal' => 'hide']);
    }


    public function render()
    {
        $dp = Departement::where('name','like',"%{$this->search}%")->get();

        return view('livewire.departments.department-index',
        [
            'Departements' => $dp
        ])->layout('layouts.main');
    }
}
