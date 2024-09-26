<?php

namespace App\Livewire;

use App\Models\Car;
use Livewire\Component;

class AddCar extends Component
{

    public $name = '';
    public $brand = '';
    public $engine_capacity = '';
    public $fuel_type = '';

    public function saveCar()
    {
        // dd($this->name);
        $this->validate([
            'name'=> 'required',
            'brand'=> 'required',
            'engine_capacity'=> 'required',
            'fuel_type'=> 'required'
        ]);
        $new_car = new Car();
        $new_car->name = $this->name;
        $new_car->brand = $this->brand;
        $new_car->engine_capacity = $this->engine_capacity;
        $new_car->fuel_type = $this->fuel_type;
        $new_car->save();

        return $this->redirect(route('cars.home'), navigate:true);
    }

    public function render()
    {
        return view('livewire.add-car');
    }
}
