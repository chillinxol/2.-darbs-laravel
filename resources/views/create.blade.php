<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Flower</title>
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
        <h2>Add New Flower</h2>

        <form action="{{ route('flowers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Flower Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Flower</button>
        </form>

        <a href="/" class="btn btn-secondary mt-3">Back to Flowers</a>
    </div>
</body>
</html>
