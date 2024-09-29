<div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">User Home</h2>
                    </div>
                    <div class="card-body">
                        <strong>Name : </strong> {{ Auth::user()->name }}
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-danger" wire:click="logout">Logout</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>
