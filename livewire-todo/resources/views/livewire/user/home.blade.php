<div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">User Home - {{ Auth::user()->name }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="input-group mb-3">
                                <input type="text" name="name" wire:model="name" class="form-control" placeholder="Enter task..." required>
                                <button class="btn btn-primary" wire:click="saveTask">Save</button>
                            </div>

                            @if (count($tasks))
                            <ul class="list-group">
                                @foreach ($tasks as $task)
                                    <li class="list-group-item">
                                        <input type="checkbox" wire:click="toggleStatus({{ $task->id }})" {{ $task->status ? 'checked' : '' }}>
                                        <span class="{{ $task->status ? 'text-decoration-line-through' : '' }}">
                                            {{ $task->name }}
                                        </span>
                                        <button class="btn btn-danger btn-sm float-end" wire:click="deleteTask({{ $task->id }})">x</button>
                                    </li>
                                @endforeach
                            </ul>
                            @else
                            <div class="text-center">
                                <span>No tasks to show!</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-secondary" wire:click="logout">Logout</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>
