<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body style="background: linear-gradient(135deg, #667eea, #764ba2); min-height: 100vh; padding: 20px; color: white;">

    <div class="container">
        <h2 class="text-center my-4"><i class="bi bi-person-circle"></i> User Dashboard</h2>
        @yield('content')
    </div>

</body>
</html>
