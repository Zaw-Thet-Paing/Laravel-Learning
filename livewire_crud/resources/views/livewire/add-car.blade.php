<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2>Add New Car</h2>
                </div>
                <div class="col">
                    <a href="{{ route('cars.home') }}" wire:navigate class="btn btn-primary btn-sm float-end">Home</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit="saveCar">
                <div class="mb-3">
                    <label for="">Car Name</label>
                    <input type="text" class="form-control" name="name" wire:model='name'>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Car Brand</label>
                    <input type="text" class="form-control" name="brand" wire:model='brand'>
                    @error('brand')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Engine Capacity</label>
                    <input type="number" name="engine_capacity" class="form-control" wire:model='engine_capacity'>
                    @error('engine_capacity')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Fuel Type</label>
                    <select name="fuel_type" class="form-control" wire:model='fuel_type'>
                        <option value="">Select Fuel Type</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Petrol">Petrol</option>
                        <option value="Electricity">Electricity</option>
                    </select>
                    @error('fuel_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success w-100">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
