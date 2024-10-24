<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Home</title>
    <style>
        body {
            background-image: url('https://img.freepik.com/premium-vector/watercolor-frame-flowers-watercolor-frame-flowers_912214-117423.jpg?semt=ais_hybrid'); /* Replace with your image path */
            background-size: cover; /* Cover the whole screen */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Prevent repeating */
                height: 100vh; /* Full viewport height */
    margin: 0;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Optional: semi-transparent background for better text readability */
            border-radius: 10px; /* Optional: rounded corners */
            padding: 20px; /* Optional: padding */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Welcome to the Flower Shop!</h1>
        @auth
        @else
            <p class="alert alert-warning">You are not logged in.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
        @endauth

        <h2 class="text-center mt-5">All Flowers</h2>
        <div id="flowers-container" class="row">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @auth
                <a href="{{ route('flowers.create') }}" class="btn btn-primary mb-3">Add New Flower</a>
            @endauth

            @foreach($flowers as $flower)
                <div class="col-md-4 mb-4">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <h3>{{ $flower->name }}</h3>
                        <p>{{ $flower->description }}</p>
                        <p>Price: ${{ $flower->price }}</p>
                        @auth
                            <a href="{{ route('flowers.edit', $flower->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('flowers.destroy', $flower->id) }}" method="POST" class="d-inline delete-flower-form">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>

        @auth
            <form action="/logout" method="POST" class="position-fixed bottom-0 end-0 p-3">
                @csrf
                <button class="btn btn-danger">Log out</button>
            </form>
        @endauth
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
