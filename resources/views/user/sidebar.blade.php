<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse bg-dark vh-100">
    <div class="text-center py-4 border-bottom">
        <h4 class="text-white"><i class="fas fa-user-circle"></i> User Dashboard</h4>
    </div>
    
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="#user-details" class="nav-link text-light">
                    <i class="fas fa-user me-2"></i> User Details
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.gadget.assigned') }}" class="nav-link text-light">
                    <i class="fas fa-laptop me-2"></i> View Assigned Gadgets
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.gadget.report') }}" class="nav-link text-light">
                    <i class="fas fa-exclamation-circle me-2"></i> Report Issues
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.gadget.return') }}" class="nav-link text-light">
                    <i class="fas fa-sync-alt me-2"></i> Request Return
                </a>
            </li>
            <li class="nav-item">
                <a href="#gadget-details" class="nav-link text-light">
                    <i class="fas fa-info-circle me-2"></i> Check Gadget Details
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.gadget_requests.index') }}" class="nav-link text-light">
                    <i class="fas fa-laptop-medical me-2"></i> Request Gadget
                </a>
            </li>
            <li class="nav-item">
                <a href="#request-gadget" class="nav-link text-light">
                    <i class="fas fa-box me-2"></i> Available Gadgets
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link text-danger">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
