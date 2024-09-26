<?php

namespace App\Livewire;

use App\Models\Car;
use Livewire\Component;

class CarList extends Component
{

    public $cars;

    public function mount()
    {
        $this->cars = Car::all();
    }

    public function delete($id)
    {
        try {
            Car::where('id', $id)->delete();

            return $this->redirect(route('cars.home'), navigate:true);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.car-list', [
            'cars'=> $this->cars
        ]);
    }
}
