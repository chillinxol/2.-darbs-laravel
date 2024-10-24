<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery for AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home</title>
    <style>
        body {
            background-image: url('https://img.freepik.com/premium-vector/watercolor-frame-flowers-watercolor-frame-flowers_912214-117423.jpg?semt=ais_hybrid'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8); 
            border-radius: 10px; 
            padding: 20px;
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

    <script>
        // Setup CSRF for AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // AJAX for deleting a flower
        $(document).ready(function() {
            $('.delete-flower-form').submit(function(e) {
                e.preventDefault(); // Prevent form submission

                if (confirm('Are you sure you want to delete this flower?')) {
                    var form = $(this);
                    var url = form.attr('action');

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: form.serialize(),
                        success: function(response) {
                            form.closest('.col-md-4').remove(); // Remove flower from UI
                            alert('Flower deleted successfully!');
                        },
                        error: function(error) {
                            alert('Something went wrong!');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
