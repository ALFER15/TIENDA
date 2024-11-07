<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{

    public $mTable = "Category";
    public function render()
    {
        return view('livewire.dashboard');
    }
}
