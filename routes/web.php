<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GadgetController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GadgetRequestController;
use App\Http\Controllers\DepartmentManagerController;


use App\Http\Controllers\IssueController;



// Welcome Route
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Authentication Routes (Provided by Laravel Auth)
Auth::routes();
//Auth::routes(['reset' => true]);  // This will generate the reset routes

// Fallback Route
Route::get('/fallback', function () {
    return 'You do not have permission to access this page.';
})->name('fallback');


// Admin Routes
Route::middleware(['auth', 'role.admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/reports', [AdminController::class, 'generateReports'])->name('admin.reports');
    Route::get('/admin/employees', [AdminController::class, 'viewEmployees'])->name('admin.viewEmployees');
    Route::get('/admin/employees/{id}', [AdminController::class, 'viewEmployee'])->name('admin.viewEmployee');
    Route::get('/admin/employees/{id}/edit', [AdminController::class, 'editEmployee'])->name('admin.editEmployee');
    Route::post('/admin/employees/{id}/update', [AdminController::class, 'updateEmployee'])->name('admin.updateEmployee');
    Route::get('/admin/pending-requests', [AdminController::class, 'showPendingRequests'])->name('admin.pendingRequests');
    Route::get('/admin/pending-requests/{id}', [AdminController::class, 'showPendingRequest'])->name('admin.pendingRequest');
    Route::post('/admin/pending-requests/{id}/approve', [AdminController::class, 'approvePendingRequest'])->name('admin.approvePendingRequest');
    Route::post('/admin/pending-requests/{id}/reject', [AdminController::class, 'rejectPendingRequest'])->name('admin.rejectPendingRequest');
    Route::post('/admin/pending-requests/{id}/return', [AdminController::class, 'returnPendingRequest'])->name('admin.returnPendingRequest');
    Route::post('/admin/pending-requests/{id}/report-issue', [AdminController::class, 'reportIssue'])->name('admin.reportIssue');
    Route::get('/admin/departments', [AdminController::class, 'viewDepartments'])->name('admin.viewDepartments');
    Route::get('/admin/departments/{id}', [AdminController::class, 'viewDepartment'])->name('admin.viewDepartment');
    Route::post('/admin/departments/{id}/update', [AdminController::class, 'updateDepartment'])->name('admin.updateDepartment');
    Route::post('/admin/departments/{id}/delete', [AdminController::class, 'deleteDepartment'])->name('admin.deleteDepartment');

    Route::get('/admin/pending-requests', [AdminController::class, 'getPendingRequests'])->name('admin.pendingRequests');
    Route::get('/admin/pending-requests/{id}', [AdminController::class, 'getPendingRequest'])->name('admin.pendingRequest');
    Route::post('/admin/pending-requests/{id}/approve', [AdminController::class, 'approvePendingRequest'])->name('admin.approvePendingRequest');

    Route::get('/admin/employees/{id}/assign-gadget', [AdminController::class, 'assignGadget'])->name('admin.assignGadget');

    Route::get('/admin/employees/{id}/assign-gadget', [AdminController::class, 'assignGadget'])->name('admin.assignGadget');

    Route::get('/admin/manager-requests', [AdminController::class, 'managerRequests'])->name('admin.manager_requests.manager.requests');
    Route::get('/admin/manager-allocations', [AdminController::class, 'managerAllocations'])->name('admin.manager_requests.manager.allocations');
    Route::get('/admin/manager-issues', [AdminController::class, 'managerIssues'])->name('admin.manager_requests.manager.issues');


    Route::get('/admin/employees/{id}/assing-gadget', [AdminController::class, 'assignGadget'])->name('admin.assignGadget');

    Route::post('/admin/employees/{id}/return-gadget', [AdminController::class, 'returnGadget'])->name('admin.returnGadget');
    Route::get('/admin/gadgets', [AdminController::class, 'viewGadgets'])->name('admin.viewGadgets');
    Route::get('/admin/gadgets/{id}', [AdminController::class, 'viewGadget'])->name('admin.viewGadget');
    Route::post('/admin/gadgets/{id}/update', [AdminController::class, 'updateGadget'])->name('admin.updateGadget');
    Route::post('/admin/gadgets/{id}/delete', [AdminController::class, 'deleteGadget'])->name('admin.deleteGadget');
    Route::get('/admin/requests', [AdminController::class, 'viewRequests'])->name('admin.viewRequests');
    Route::get('/admin/requests/{id}', [AdminController::class, 'viewRequest'])->name('admin.viewRequest');
    Route::post('/admin/requests/{id}/approve', [AdminController::class, 'approveRequest'])->name('admin.approveRequest');
    Route::post('/admin/requests/{id}/reject', [AdminController::class, 'rejectRequest'])->name('admin.rejectRequest');
    Route::post('/admin/requests/{id}/return', [AdminController::class, 'returnRequest'])->name('admin.returnRequest');
    Route::post('/admin/requests/{id}/report-issue', [AdminController::class, 'reportIssue'])->name('admin.reportIssue');
    Route::get('/admin/departments', [AdminController::class, 'viewDepartments'])->name('admin.viewDepartments');
    Route::get('/admin/departments/{id}', [AdminController::class, 'viewDepartment'])->name('admin.viewDepartment');
    Route::post('/admin/departments/{id}/update', [AdminController::class, 'updateDepartment'])->name('admin.updateDepartment');
    Route::post('/admin/departments/{id}/delete', [AdminController::class, 'deleteDepartment'])->name('admin.deleteDepartment');
    Route::get('/admin/roles', [AdminController::class, 'viewRoles'])->name('admin.viewRoles');
    Route::post('/admin/process-assignment/{id}', [AdminController::class, 'processAssignment'])->name('admin.processAssignment');
    Route::post('/admin/process-return/{id}', [AdminController::class, 'processReturn'])->name('admin.processReturn');
    
   Route::get('/admin/assign-gadget/{id}', [AdminController::class, 'assignGadget'])->name('admin.assignGadget');
   Route::post('/admin/process-assignment/{id}', [AdminController::class, 'processAssignment'])->name('admin.processAssignment');
   

   //REPORTED ISSUES
   Route::get('/admin/issues', [\App\Http\Controllers\GadgetIssueController::class, 'adminIndex'])->name('admin.issues.index');
    Route::post('/admin/issues/{id}/update-status', [\App\Http\Controllers\GadgetIssueController::class, 'updateStatus'])->name('admin.issues.updateStatus');
   //gadget return
   Route::get('/admin/returns', [\App\Http\Controllers\GadgetReturnController::class, 'adminIndex'])->name('admin.returns.index');
    Route::post('/admin/returns/{id}/update-status', [\App\Http\Controllers\GadgetReturnController::class, 'updateStatus'])->name('admin.returns.updateStatus');
    Route::get('/admin/pending-requests', [AdminController::class, 'pendingRequests'])->name('admin.pendingRequests');
    Route::get('/admin/assign-gadget/{id}', [AdminController::class, 'assignGadget'])->name('admin.assignGadget');
    Route::post('/admin/process-assignment/{id}', [AdminController::class, 'processAssignment'])->name('admin.processAssignment');
    Route::post('/admin/process-return/{id}', [AdminController::class, 'processReturn'])->name('admin.processReturn');

    Route::patch('/admin/returns/{id}/approve', [\App\Http\Controllers\GadgetReturnController::class, 'approve'])->name('admin.returns.approve');
    Route::patch('/admin/returns/{id}/reject', [\App\Http\Controllers\GadgetReturnController::class, 'reject'])->name('admin.returns.reject');

    Route::patch('/admin/returns/{id}/approve', [\App\Http\Controllers\GadgetReturnController::class, 'approveReturn'])->name('admin.returns.approve');
Route::patch('/admin/returns/{id}/reject', [\App\Http\Controllers\GadgetReturnController::class, 'rejectReturn'])->name('admin.returns.reject');


    Route::get('user/requests/{id}/return', [UserController::class, 'returnGadget'])->name('user.returnGadget');
    Route::post('/gadget/return/{id}', [GadgetController::class, 'returnGadget']);
    
    Route::patch('admin/returns/{id}/approve', [\App\Http\Controllers\GadgetReturnController::class, 'approve'])->name('admin.returns.approve');
    Route::patch('admin/returns/{id}/reject', [\App\Http\Controllers\GadgetReturnController::class, 'reject'])->name('admin.returns.reject');
    // Department Routes
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departments/{id}', [DepartmentController::class, 'show'])->name('departments.show');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::put('/departments/{id}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');


    // Request Management Routes
    Route::get('/admin/return-requests', [AdminController::class, 'returnRequests'])->name('admin.returnRequests');
    Route::get('/admin/return-requests/{id}', [AdminController::class, 'returnRequest'])->name('admin.returnRequest');
    Route::patch('/admin/approve-return/{id}', [AdminController::class, 'approveReturn'])->name('admin.approveReturn');
    Route::patch('/admin/reject-return/{id}', [AdminController::class, 'rejectReturn'])->name('admin.rejectReturn');
    Route::get('/admin/requests', [RequestController::class, 'index'])->name('admin.requests');
    Route::post('/admin/requests/{id}/approve', [RequestController::class, 'approve'])->name('admin.requests.approve');
    Route::post('/admin/requests/{id}/reject', [RequestController::class, 'reject'])->name('admin.requests.reject');
    Route::post('/admin/requests/{id}/cancel', [RequestController::class, 'cancel'])->name('admin.requests.cancel');
    Route::post('/admin/requests/{id}/return', [RequestController::class, 'returnGadget'])->name('admin.requests.return');


    Route::get('/admin/gadget-requests', [GadgetRequestController::class, 'adminIndex'])->name('admin.gadget_requests.index');
    Route::put('/admin/gadget-requests/{id}', [GadgetRequestController::class, 'adminUpdate'])->name('admin.gadget_requests.update');
    Route::get('/admin/return-requests', [AdminController::class, 'viewReturnRequests'])->name('admin.return.requests');
    Route::post('/admin/return-requests/{id}/approve', [AdminController::class, 'approveReturnRequest'])->name('admin.return.approve');
    Route::post('/admin/return-requests/{id}/reject', [AdminController::class, 'rejectReturnRequest'])->name('admin.return.reject');

    Route::get('/admin/reported-issues', [AdminController::class, 'viewReportedIssues'])->name('admin.issues');


});

// Manager Routes
Route::middleware(['auth', 'role.manager'])->group(function () {
    Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::match(['get', 'post'], '/manager/request-gadget', [RequestController::class, 'store']);
    Route::post('/manager/report-issue', [RequestController::class, 'store']);
    Route::match(['get', 'post'], '/manager/report-issue', [RequestController::class, 'store']);

    Route::post('/manager/request-gadget', [ManagerController::class, 'requestGadget'])->name('manager.requestGadget');
    Route::get('/manager/requests', [ManagerController::class, 'viewRequests'])->name('manager.viewRequests');
    Route::get('/manager/requests/{id}', [ManagerController::class, 'viewRequest'])->name('manager.viewRequest');
    Route::post('/manager/requests/{id}/cancel', [ManagerController::class, 'cancelRequest'])->name('manager.cancelRequest');
    Route::post('/manager/requests/{id}/return', [ManagerController::class, 'returnGadget'])->name('manager.returnGadget');
    Route::post('/manager/report-issue', [ManagerController::class, 'reportIssue'])->name('manager.reportIssue');
    Route::get('/manager/employees', [ManagerController::class, 'viewEmployees'])->name('manager.viewEmployees');
    Route::get('/manager/employees/{id}', [ManagerController::class, 'viewEmployee'])->name('manager.viewEmployee');
    Route::post('/manager/employees/{id}/assign-gadget', [ManagerController::class, 'assignGadget'])->name('manager.assignGadget');
    Route::post('/manager/employees/{id}/return-gadget', [ManagerController::class, 'returnGadget'])->name('manager.returnGadget'); 
    Route::get('/manager/requests', [ManagerController::class, 'viewRequests'])->name('manager.viewRequests');
    Route::get('/manager/requests/{id}', [ManagerController::class, 'viewRequest'])->name('manager.viewRequest');
    Route::post('/manager/requests/{id}/approve', [ManagerController::class, 'approveRequest'])->name('manager.approveRequest');


    Route::get('/manager/dashboard', [DepartmentManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/manager/gadgets', [DepartmentManagerController::class, 'viewGadgets'])->name('manager.gadgets');
    Route::post('/manager/request-gadget', [DepartmentManagerController::class, 'requestGadget'])->name('manager.requestGadget');
    Route::post('/manager/report-issue', [DepartmentManagerController::class, 'reportIssue'])->name('manager.reportIssue');
    Route::post('/manager/return-gadget', [DepartmentManagerController::class, 'returnGadget'])->name('manager.returnGadget');
    Route::get('/manager/user-allocations', [DepartmentManagerController::class, 'viewAllocations'])->name('manager.allocations');
});




// Manager Routes

Route::middleware(['auth', 'ensure.user.is.manager'])->group(function () {
    Route::get('/manager/dashboard', [DepartmentManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/manager/gadget-requests', [ManagerController::class, 'managerGadgetRequests'])->name('manager.gadget.requests');
    Route::get('/manager/gadget-requests/{id}', [ManagerController::class, 'managerGadgetRequest'])->name('manager.gadget.request');
});


Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // User Management
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    //user requests return
    Route::get('/user/return-request', [\App\Http\Controllers\GadgetReturnController::class, 'create'])->name('user.returns.create');
    Route::post('/user/return-request', [\App\Http\Controllers\GadgetReturnController::class, 'store'])->name('user.returns.store');
    Route::get('/user/return-requests', [\App\Http\Controllers\GadgetReturnController::class, 'index'])->name('user.returns.index');
    
    Route::get('/user/gadget/details', [UserController::class, 'showDetails'])->name('user.gadget.details');

    // Gadget Requests
    Route::post('/gadget/return', [GadgetController::class, 'return'])->name('gadget.return');

    
    Route::get('/gadget-requests', [GadgetRequestController::class, 'index'])->name('user.gadget_requests.index');
    Route::get('/gadget-requests/create', [GadgetRequestController::class, 'create'])->name('user.gadget_requests.create');
    Route::post('/gadget-requests', [GadgetRequestController::class, 'store'])->name('user.gadget_requests.store');
    Route::get('/gadget-requests/{id}/edit', [GadgetRequestController::class, 'edit'])->name('user.gadget_requests.edit');
    Route::put('/gadget-requests/{id}', [GadgetRequestController::class, 'update'])->name('user.gadget_requests.update');
    Route::delete('/gadget-requests/{id}', [GadgetRequestController::class, 'destroy'])->name('user.gadget_requests.destroy');
    // Requests and Returns
    Route::post('user/report-issue', [UserController::class, 'reportIssue'])->name('user.reportIssue');
    Route::get('user/requests/{id}/return', [UserController::class, 'returnGadget'])->name('user.returnGadget');
    Route::post('user/requests/{id}/return', [UserController::class, 'returnGadget'])->name('user.gadget.returnGadget');
    Route::post('user/requests/{id}/report-issue', [UserController::class, 'reportIssue'])->name('user.reportIssue');
   
    Route::get('/user/requests', [UserController::class, 'viewRequests'])->name('user.viewRequests');
    Route::get('/user/requests/{id}', [UserController::class, 'viewRequest'])->name('user.viewRequest');    
    Route::post('/user/requests/{id}/report-issue', [UserController::class, 'reportIssue'])->name('user.reportIssue');
    Route::get('/user/requests', [UserController::class, 'viewRequests'])->name('user.viewRequests');
    Route::get('/user/requests/{id}', [UserController::class, 'viewRequest'])->name('user.viewRequest');
    Route::post('/user/requests/{id}/cancel', [UserController::class, 'cancelRequest'])->name('user.cancelRequest');
    Route::post('/user/requests/{id}/report-issue', [UserController::class, 'reportIssue'])->name('user.reportIssue');
   // Route::post('/user/return-gadget', [UserController::class, 'requestReturn'])->name('user.returnGadget'); 
    Route::post('/user/request-replacement', [UserController::class, 'requestReplacement'])->name('user.requestReplacement');

    // User Details
Route::get('/user/gadget/details', [UserController::class, 'showDetails'])->name('user.gadget.details');
Route::get('/gadget/details/{id}', [GadgetController::class, 'gadgetDetails'])
    ->name('gadget.details');
Route::get('/user/details/{id}', [UserController::class, 'showDetails'])
    ->name('user.details');

// View Assigned Gadgets
Route::get('/assigned', [GadgetController::class, 'assignedGadgets'])->name('user.gadget.assigned');
// Return Gadget
//Route::post('/user/requests/{id}/return', [GadgetController::class, 'returnGadget'])->name('user.gadget.returnGadget');

//Route::post('/user/gadget/return', [GadgetController::class, 'returnGadget'])->name('user.gadget.return');
Route::get('/user/gadget/return', [GadgetController::class, 'showReturnForm'])->name('user.gadget.returnForm');

// Process the return gadget request (POST)
Route::post('/gadgets/return', [GadgetController::class, 'returnGadget'])->name('gadget.return');
// Process the return gadget request (GET)
Route::get('/gadgets/return', [GadgetController::class, 'returnGadget'])->name('gadget.return');
Route::post('/user/gadget/return', [GadgetController::class, 'returnGadget'])->name('user.gadget.return');
// Report Gadget Issue
Route::post('/user/gadget/report', [GadgetController::class, 'reportIssue'])->name('user.gadget.report');
Route::get('/user/gadget/report', [GadgetController::class, 'reportIssue'])->name('user.gadget.report');

// Gadget Details (First Assigned Gadget)
//Route::get('/user/gadgets/details', [GadgetController::class, 'gadgetDetails'])->name('user.gadget.details');
Route::get('/user/gadgets', [GadgetController::class, 'viewAssignedGadgets'])->name('user.gadget.view');

    // Profile & Notifications
    Route::get('/user/profile', [UserController::class, 'viewProfile'])->name('user.viewProfile');
    Route::post('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.updateProfile');
    Route::post('/user/profile/update-password', [UserController::class, 'updatePassword'])->name('user.updatePassword');
    Route::get('/user/notifications', [UserController::class, 'viewNotifications'])->name('user.viewNotifications');
    Route::get('/user/notifications/{id}', [UserController::class, 'viewNotification'])->name('user.viewNotification');
    Route::post('/gadgets/return/{id}', [GadgetController::class, 'returnGadget'])
    ->name('gadget.return');
    
    Route::get('/gadgets/return/{id}', [GadgetController::class, 'returnGadget']);
    // Departments
    Route::get('/user/departments', [UserController::class, 'viewDepartments'])->name('user.viewDepartments');
    Route::get('/user/departments/{id}', [UserController::class, 'viewDepartment'])->name('user.viewDepartment');
});


// Gadget Routes (Accessible by authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/gadgets', [GadgetController::class, 'index'])->name('gadgets.index');
    Route::get('/gadgets/create', [GadgetController::class, 'create'])->name('gadgets.create');
    Route::post('/gadgets', [GadgetController::class, 'store'])->name('gadgets.store');
    Route::get('/gadgets/{id}', [GadgetController::class, 'show'])->name('gadgets.show');
    Route::post('/gadgets/{id}/request', [GadgetController::class, 'request'])->name('gadgets.request');
    Route::get('/gadgets/{id}/report-issue', [GadgetController::class, 'reportIssue'])->name('gadgets.reportIssue');
    Route::get('/gadgets/{id}/return', [GadgetController::class, 'return'])->name('gadgets.return');
    Route::get('/gadgets/{id}/edit', [GadgetController::class, 'edit'])->name('gadgets.edit');
    Route::put('/gadgets/{id}', [GadgetController::class, 'update'])->name('gadgets.update');
    Route::delete('/gadgets/{id}', [GadgetController::class, 'destroy'])->name('gadgets.destroy');


    // Gadget Report issue
    
    // Show the form to report an issue (select a gadget)
    Route::get('/user/report-issue', [\App\Http\Controllers\GadgetIssueController::class, 'create'])->name('user.issues.create');
    
    // Store the reported issue
    Route::post('/user/report-issue', [\App\Http\Controllers\GadgetIssueController::class, 'store'])->name('user.issues.store');
    
    Route::get('/user/issues', [\App\Http\Controllers\GadgetIssueController::class, 'index'])->name('user.issues.index');

});


Route::post('/admin/assign-gadget/{id}', [AdminController::class, 'storeAssignedGadget'])
    ->name('admin.storeAssignedGadget');
    Route::post('/admin/assign-gadget/{id}', [AdminController::class, 'storeAssignedGadget'])->name('admin.storeAssignedGadget');
    Route::post('/admin/assign-gadget/{id}', [AdminController::class, 'storeAssignedGadget'])->name('admin.storeAssignedGadget');
    Route::post('/admin/assign-gadget/{id}', [AdminController::class, 'storeAssignedGadget'])->name('admin.storeAssignedGadget');
    Route::post('/admin/assign-gadget/{id}', [AdminController::class, 'storeAssignedGadget'])->name('admin.storeAssignedGadget');
//Route::middleware('auth')->group(function () {
   // Route::resource('gadgets', GadgetController::class);
//});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('manager_/manager-requests', [AdminController::class, 'managerRequests'])->name('managerRequests');
    Route::get('/approve-request/{id}', [AdminController::class, 'approveRequest'])->name('approveRequest');
    Route::get('/reject-request/{id}', [AdminController::class, 'rejectRequest'])->name('rejectRequest');
});


Route::get('/manager/employees', [ManagerController::class, 'employees'])->name('manager.employees');
Route::prefix('manager')->name('manager.')->group(function () {
    Route::get('/employees', [ManagerController::class, 'employees'])->name('viewEmployees');
});

Route::get('/user/details/{id}', [UserController::class, 'showDetails'])->name('user.details');


// Home Route (Optional)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
