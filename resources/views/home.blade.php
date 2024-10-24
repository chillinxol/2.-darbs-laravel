<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Flower Shop</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="container text-center">
        @auth
            <p class="alert alert-success">Congrats, you are logged in.</p>
            <form action="/logout" method="POST">
                @csrf
                <button class="btn btn-danger">Log out</button>
            </form>

            <div class="mt-4 p-4 border rounded">
                <h2>Create a New Flower</h2>
                <form id="create-flower-form">
                    @csrf
                    <input type="text" name="name" class="form-control mb-3" placeholder="Flower Name" required>
                    <textarea name="description" class="form-control mb-3" placeholder="Flower Description" required></textarea>
                    <input type="number" name="price" class="form-control mb-3" placeholder="Price" required>
                    <button type="submit" class="btn btn-primary">Add Flower</button>
                </form>
                <div id="flower-message" class="mt-2"></div>
            </div>

            <div class="mt-4 p-4 border rounded">
                <h2>All Flowers</h2>
                <div id="flowers-container">
                    @foreach($flowers as $flower)
                    <div class="bg-light p-3 mb-3 rounded flower" data-id="{{$flower->id}}">
                        <h3>{{$flower['name']}}</h3>
                        <p>{{$flower['description']}}</p>
                        <p>Price: ${{$flower['price']}}</p>
                        <a href="/edit-flower/{{$flower->id}}" class="btn btn-warning">Edit</a>
                        <form action="/delete-flower/{{$flower->id}}" method="POST" class="d-inline delete-flower-form">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>

        @else
            <div class="mt-4 p-4 border rounded">
                <h2>Register</h2>
                <form action="/register" method="POST">
                    @csrf
                    <input name="name" type="text" class="form-control mb-3" placeholder="Name" required>
                    <input name="email" type="email" class="form-control mb-3" placeholder="Email" required>
                    <input name="password" type="password" class="form-control mb-3" placeholder="Password" required>
                    <button class="btn btn-primary">Register</button>
                    <p class="mt-3">If you already have an account, <a href="/login">click here to log in</a>.</p>
                </form>
            </div>
        @endauth
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#create-flower-form').on('submit', function(event) {
                event.preventDefault();
                
                $.ajax({
                    url: '/create-flower',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#flower-message').html('<div class="alert alert-success">Flower added successfully!</div>');
                        $('#flowers-container').prepend(response); // Assuming the response contains the HTML for the new flower
                        $('#create-flower-form')[0].reset(); // Reset the form
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '<div class="alert alert-danger">';
                        for (let key in errors) {
                            errorMessage += errors[key].join('<br>');
                        }
                        errorMessage += '</div>';
                        $('#flower-message').html(errorMessage);
                    }
                });
            });

            $(document).on('click', '.delete-flower-form button', function(event) {
                event.preventDefault();
                const flowerElement = $(this).closest('.flower');
                const flowerId = flowerElement.data('id');

                $.ajax({
                    url: `/delete-flower/${flowerId}`,
                    method: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        flowerElement.remove();
                    }
                });
            });
        });
    </script>
</body>
</html>
