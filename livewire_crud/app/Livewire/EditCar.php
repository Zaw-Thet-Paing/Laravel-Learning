<?php

namespace App\Livewire;

use App\Models\Car;
use Livewire\Component;

class EditCar extends Component
{

    public $is_flash_showing = false;

    public $car_id;

    public Car $car;

    public $name;
    public $brand;
    public $engine_capacity;
    public $fuel_type;

    public function mount($id)
    {
        $this->car_id = $id;

        $this->car = Car::where('id', $id)->first();

        $this->name = $this->car->name;
        $this->brand = $this->car->brand;
        $this->engine_capacity = $this->car->engine_capacity;
        $this->fuel_type = $this->car->fuel_type;
    }

    public function updateCar()
    {
        $this->validate([
            'name'=> 'required',
            'brand'=> 'required',
            'engine_capacity'=> 'required',
            'fuel_type'=> 'required'
        ]);

        try {
            Car::where('id', $this->car_id)->update([
                'name'=> $this->name,
                'brand'=> $this->brand,
                'engine_capacity'=> $this->engine_capacity,
                'fuel_type'=> $this->fuel_type
            ]);

            $this->is_flash_showing = true;

            $this->redirect(route('cars.home'), navigate:true);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    public function render()
    {
        return view('livewire.edit-car');
    }
}
