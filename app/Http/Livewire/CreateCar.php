<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCar extends Component
{
    use WithFileUploads;

    public $mostrar = false;
    public function render()
    {
        return view('livewire.create-car');
    }

    public function valorForm(){
        $this->mostrar = !$this->mostrar;
    }
}
