<div class="container mt-3">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Register Form</h2>
                </div>
                <div class="card-body">
                    <form wire:submit="registerUser">
                        <div class="mb-3">
                            <label for="">Name : </label>
                            <input type="text" name="name" wire:model='name' class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Email : </label>
                            <input type="email" name="email" wire:model='email' class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Password : </label>
                            <input type="password" name="password" wire:model='password' class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success w-100">
                                Register
                                <div class="spinner-border spinner-border-sm" wire:loading role="status">
                                </div>
                            </button>
                        </div>
                        <div class="text-center">
                            <a href="{{ route("login") }}" wire:navigate>Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
