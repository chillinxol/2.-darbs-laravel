<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Flower</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Flower: {{ $flower->name }}</h2>

        <form action="{{ route('flowers.update', $flower->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Flower Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $flower->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ $flower->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $flower->price }}" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Flower</button>
        </form>

        <a href="{{ route('flowers.index') }}" class="btn btn-secondary mt-3">Back to Flowers</a>
    </div>
</body>
</html>