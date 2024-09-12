<nav class="navbar bg-body-tertiary">
    <div class="container">
        <a href="{{ route('user.home') }}" class="navbar-brand fs-2">User Home</a>
        <form action="{{ route('logout') }}" method="POST" class="d-flex">
            @csrf
            <button class="btn btn-outline-secondary btn-sm" type="submit">Logout</button>
        </form>
    </div>
</nav>
