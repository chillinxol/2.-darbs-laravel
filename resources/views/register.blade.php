
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Register</title>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

  <div class="container text-center">
    <h2>Create Your Account</h2>
    <p>Please enter your name, email, and password to register.</p>
    <form action="/register" method="POST">
      @csrf
      <input name="name" type="text" class="form-control mb-3" placeholder="Name" required>
      <input name="email" type="email" class="form-control mb-3" placeholder="Email" required>
      <input name="password" type="password" class="form-control mb-3" placeholder="Password" required>
      <button class="btn btn-primary">Register</button>
    </form>
    <p class="mt-3">If you already have an account, <a href="/login">click here to login</a>.</p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>