<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    <style>
        body {
            background-image: url('https://cdn.discordapp.com/attachments/1252921810148786208/1299078774855569488/flowers-flat-lay-flower-flatlay.png?ex=671be4e3&is=671a9363&hm=4d4b6ea35cd176ec9fd77b059c8f899751e1325445f6781de3add215c6c80ace&'); /* Replace with your image path */
            background-size: cover; /* Cover the whole screen */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Prevent repeating */
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Optional: semi-transparent background for better text readability */
            border-radius: 10px; /* Optional: rounded corners */
            padding: 20px; /* Optional: padding */
        }
    </style>
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
        <p class="mt-3">If you don't have an account, <a href="/register">click here to register</a>.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
