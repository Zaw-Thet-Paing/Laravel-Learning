<div class="container mt-3">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">User Profile</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Name : </strong>{{ Auth::user()->name }}</li>
                        <li class="list-group-item"><strong>Email : </strong>{{ Auth::user()->email }}</li>
                    </ul>
                    <button class="btn btn-danger mt-3" wire:click="logout()">Logout</button>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
