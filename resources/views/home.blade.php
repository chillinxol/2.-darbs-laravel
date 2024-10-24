<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome to the Flower Shop!</h1>
        @auth
    <p class="alert alert-success">Congrats, you are logged in.</p>
    <form action="/logout" method="POST">
        @csrf
        <button class="btn btn-danger">Log out</button>
    </form>
@else
    <p class="alert alert-warning">You are not logged in.</p>
    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
@endauth

        <h2>All Flowers</h2>
        <div id="flowers-container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @auth
                <a href="{{ route('flowers.create') }}" class="btn btn-primary mb-3">Add New Flower</a>
            @endauth

            @foreach($flowers as $flower)
                <div class="bg-light p-3 mb-3 rounded">
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
            @endforeach
        </div>

        <h2>Your Posts</h2>
        <div id="posts-container">
            @foreach($posts as $post)
                <div class="bg-light p-3 mb-3 rounded">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->content }}</p>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline delete-post-form">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
