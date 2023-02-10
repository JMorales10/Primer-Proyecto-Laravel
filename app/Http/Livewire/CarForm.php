<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Car;

class CarForm extends Component
{
    public $nombre;

    public $buscador;

    public $campoorden="id";

    public $orden = "asc";

    public function render()
    {
        $cars = Car::where('marca','like','%'.$this->buscador.'%')->orderBy($this->campoorden, $this->orden)->get();
        return view('livewire.car-form')->with('cars',$cars);
    }

    public function ordenar($campo){
        if($this->campoorden==$campo){
            if($this->orden=="desc"){
                $this->orden=="asc";
            }else{
                $this->orden=="desc";
            }
        }else{
        $this->campoorden=$campo;
        $this->orden = "asc";
        }
    }
}
