<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2>Edit Car</h2>
                </div>
                <div class="col">
                    <a href="{{ route('cars.home') }}" wire:navigate class="btn btn-primary btn-sm float-end">Home</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($is_flash_showing)
                <span class="alert alert-success p-2">Successfully updated car.</span>
            @endif
            <form wire:submit="updateCar">
                <div class="mb-3">
                    <label for="">Car Name</label>
                    <input type="text" class="form-control" name="name" wire:model='name' value="{{ $name }}">
                    Characters Left : <span x-text="$wire.name.length"></span>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Car Brand</label>
                    <input type="text" class="form-control" name="brand" wire:model='brand' value="{{ $brand }}">
                    @error('brand')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Engine Capacity</label>
                    <input type="number" name="engine_capacity" class="form-control" wire:model='engine_capacity' value="{{ $engine_capacity }}">
                    @error('engine_capacity')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Fuel Type</label>
                    <select name="fuel_type" class="form-control" wire:model='fuel_type'>
                        <option value="{{ $fuel_type }}">{{ $fuel_type }}</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Petrol">Petrol</option>
                        <option value="Electricity">Electricity</option>
                    </select>
                    @error('fuel_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success w-100">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
