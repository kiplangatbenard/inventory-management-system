<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse bg-dark vh-100">
    <div class="text-center py-4 border-bottom">
        <h4 class="text-white"><i class="fas fa-user-circle"></i> User Dashboard</h4>
    </div>
    
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
            <a href="{{ route('user.details', ['id' => auth()->id()]) }}">View My Details</a>
            </li>
            <li class="nav-item">
                    <i class="fas fa-user me-2"></i> User Details
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.gadget.assigned') }}" class="nav-link text-light">
                    <i class="fas fa-laptop me-2"></i> View Assigned Gadgets
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.issues.index') }}" class="nav-link text-light">
                    <i class="fas fa-exclamation-circle me-2"></i> Report Issues
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.returns.create') }}" class="nav-link text-light">
                    <i class="fas fa-sync-alt me-2"></i> Request Return
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('user.gadget_requests.index') }}" class="nav-link text-light">
                    <i class="fas fa-laptop-medical me-2"></i> Request Gadget
                </a>
            </li>

<form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
    @method('POST')
    <button type="submit">Logout</button>
</form>

        </ul>
    </div>
</nav>
