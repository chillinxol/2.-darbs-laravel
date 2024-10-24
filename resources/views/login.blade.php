<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="container text-center">
        <h2>Login to Your Account</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" class="form-control mb-3" placeholder="Name" required>
            <input name="loginpassword" type="password" class="form-control mb-3" placeholder="Password" required>
            <button class="btn btn-primary">Log in</button>
        </form>
        <p class="mt-3">If you don't have an account, <a href="/">click here to register</a>.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
