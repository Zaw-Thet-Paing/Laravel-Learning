<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2>Car Lists</h2>
                </div>
                <div class="col">
                    <a href="{{ route('cars.create') }}" wire:navigate class="btn btn-success btn-sm float-end">Add New</a>
                </div>
            </div>
        </div>
        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Engine Capacity</th>
                        <th>Fuel Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                        <tr>
                            <td>{{ $car->id }}</td>
                            <td>{{ $car->name }}</td>
                            <td>{{ $car->brand }}</td>
                            <td>{{ $car->engine_capacity }}</td>
                            <td>{{ $car->fuel_type }}</td>
                            <td>
                                <a href="{{ route('cars.edit', $car->id) }}" wire:navigate class="btn btn-primary btn-sm" style="width:80px">Edit</a>
                                <button class="btn btn-danger btn-sm" style="width:80px" wire:click="delete({{ $car->id }})" wire:confirm="Are you sure?">
                                    Delete
                                    <div class="spinner-border spinner-border-sm" wire:loading wire:target="delete({{ $car->id }})" role="status">
                                    </div>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
