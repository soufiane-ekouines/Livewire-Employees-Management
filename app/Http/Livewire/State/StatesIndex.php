<?php

namespace App\Http\Livewire\State;

use Livewire\Component;

class StatesIndex extends Component
{
    public function render()
    {
        return view('livewire.state.states-index')->layout('layouts.main');
    }
}
