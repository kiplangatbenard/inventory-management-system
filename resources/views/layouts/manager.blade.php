<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manager Dashboard')</title>

    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom Styles -->
       <!-- Load compiled CSS -->
       <link rel="stylesheet" href="{{ asset('css/app.css') }}">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<style>
    body {
        background: linear-gradient(135deg, #667eea, #764ba2);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    .sidebar {
        height: 100vh;
        width: 225px;
        position: fixed;
        top: 0;
        left: 0;
        background: rgba(52, 58, 64, 0.9);
        backdrop-filter: blur(10px);
        padding-top: 20px;
        overflow-y: auto;
        max-height: 100vh;
        scrollbar-width: thin;
        scrollbar-color: #888 #343a40;
    }
    .sidebar a {
        padding: 10px 15px;
        font-size: 18px;
        color: white;
        display: block;
        text-decoration: none;
        transition: background 0.3s ease-in-out;
    }
    .sidebar a:hover {
        background-color: #495057;
    }
    .content {
        margin-left: 225px;
        padding: 25px;
    }
    .navbar {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .navbar-brand {
        font-weight: bold;
        font-size: 2.0rem;
        color: #333;
    }
    .nav-link {
        font-weight: 500;
        transition: color 0.3s ease-in-out;
    }
    .nav-link:hover {
        color: #5a67d8;
    }
    .dropdown-menu {
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
    @yield('styles')
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('user.sidebar')
        <div class="sidebar">
    <h4 class="text-white text-center">Manager's Dashboard</h4>
    <a href="#"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a class="nav-link" href="{{ route('manager.requestGadget') }}">Request Gadget</a>
    <a class="nav-link" href="{{ route('manager.gadgets') }}">View Gadgets</a>
    <a class="nav-link" href="{{ route('manager.allocations') }}">View Allocations</a>
    <a class="nav-link" href="{{ route('manager.reportIssue') }}">Report Issues</a>
    <a class="nav-link" href="{{route('manager.viewEmployees')}}">view Employees</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
            @yield('content')
        </main>
    </div>
</div>

<!-- Scripts -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@yield('scripts')

</body>
</html>
