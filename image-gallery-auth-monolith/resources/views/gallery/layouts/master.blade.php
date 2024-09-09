<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a href="{{ route('gallery.index') }}" class="navbar-brand fs-2">Image Gallery - {{ Auth::user()->name }}</a>

            <div class="d-flex">
                <a href="{{ route('gallery.create') }}" class="btn btn-sm btn-outline-danger me-2">Create</a>
                <form role="search" action="{{ route('logout') }}" method="POST">
                    @csrf
                    {{-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> --}}
                    <button class="btn btn-sm btn-outline-secondary" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    @yield('content')

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
