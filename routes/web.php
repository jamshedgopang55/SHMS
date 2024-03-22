<?php

use App\Http\Controllers\Admin\Attendance\AttendanceController;
use App\Http\Controllers\Admin\Attendance\WorkFromHomePermissionController;
use App\Http\Controllers\Admin\Employee\Attendance\AttendanceContoller;
use App\Models\Employee;
use App\Models\SubDepartment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\temp_filesController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Sub_DepartmentController;
use App\Http\Controllers\Admin\Schedule\ScheduleController;
use App\Http\Controllers\Roles_and_Permission\RolesController;
use App\Http\Controllers\Roles_and_Permission\PermissionController;
use App\Http\Controllers\Admin\TicketController as adminTicketController;
use App\Http\Controllers\Employee\indexController as EmployeeIndexController;
use App\Http\Controllers\Employee\Project\IndexController as ProjectIndexController;
use App\Http\Controllers\Admin\Employee\indexController as AdminEmployeeIndexController;
use App\Http\Controllers\Employee\Client\IndexController as EmployeeClientindexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


///404 Page
Route::fallback(function () {
    return view('errors.404');
});

Route::get('/', function () {
    return redirect()->route('user.login');
});


// Role Crud
Route::prefix('admin')->middleware(['role:super-admin|admin'])->name('admin.')->group(function () {
    ///STATIC ROUTES
    Route::get('roles/create', function () {
        return view('admin.role.create');
    })->name('role.create');

    // Route::get('department/create', function () {
    //     return view('admin.department.create');
    // })->name('department.create');

    Route::get('position/create', function () {
        return view('admin.position.create');
    })->name('position.create');


    //////Roles Routes
    Route::prefix('roles')->name('roles.')->controller(RolesController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{role}', 'edit')->name('edit');
        Route::post('update', 'update')->name('update');
        Route::post('destroy/{role}', 'destroy')->name('destroy');
        Route::get('{roleId}/give-permissions', 'addPermissionToRole');
        Route::put('{roleId}/give-permissions', 'givePermissionToRole');
    });

    Route::prefix('Permission')->name('Permission.')->controller(PermissionController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{permission}', 'edit')->name('edit');
        Route::post('update', 'update')->name('update');
        Route::post('destroy', 'destroy')->name('destroy');
        // Route::get('{roleId}/give-permissions', 'addPermissionToRole');
        // Route::put('{roleId}/give-permissions', 'givePermissionToRole');
    });



    // Route::get('sub/department/create' , function(){
    //     return view('sub_department.create');
    // })->name('subdepartment.create');

    Route::controller(dashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getEmployee', 'getEmployee')->name('getEmployee');
    });

    Route::resource('schedules', ScheduleController::class);

    Route::prefix('attendance')->name('attendance.')->controller(AttendanceController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::resource('permissions', WorkFromHomePermissionController::class);
        Route::get('show/{id}', 'show')->name('show');
    });


    Route::controller(UserController::class)->group(function () {
        // Route::get('roles/', 'roleIndex')->name('role.index');
        // Route::get('roles/destory/{id}', 'roleDestory')->name('role.destory');
        // Route::get('roles/edit/{id}', 'roleEdit')->name('role.edit');
        // Route::post('roles/store', 'roleStore')->name('role.store');
        // Route::post('roles/edit/store', 'roleEditStore')->name('role.edit.store');
    });
    Route::prefix('department')->name('department.')->controller(DepartmentController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update', 'update')->name('update');
        Route::post('destroy', 'destroy')->name('destroy');
    });

    Route::prefix('sub/department')->name('subdepartment.')->controller(Sub_DepartmentController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update', 'update')->name('update');
        Route::post('destroy', 'destroy')->name('destroy');


        // Route::post('department/store', 'departmentStore')->name('department.store');
        // Route::post('department/edit/store', 'departmentEditStore')->name('department.edit.store');
        // Route::get('sub/department/', 'subdepartmentIndex')->name('subdepartment.index');
        // Route::get('sub/department/create', 'subdepartmentCreate')->name('subdepartment.create');
        // Route::get('sub/department/destory/{id}', 'subdepartmentDestory')->name('subdepartment.destory');
        // Route::get('sub/department/edit/{id}', 'subdepartmentEdit')->name('subdepartment.edit');
        // Route::post('sub/department/store', 'subdepartmentStore')->name('subdepartment.store');
        // Route::post('sub/department/edit/store', 'subdepartmentEditStore')->name('subdepartment.edit.store');
    });


    Route::prefix('position')->name('position.')->group(function () {
        Route::controller(PositionController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('destroy/{id}', 'destroy')->name('destroy');
        });
    });
    Route::prefix('Employee')->name('Employee.')->group(function () {
        Route::controller(AdminEmployeeIndexController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('destory/{id}', 'destory')->name('destory');
        });
    });
    Route::prefix('ticket')->name('ticket.')->group(function () {
        Route::controller(adminTicketController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('show/{id}', 'show')->name('show');
            Route::get('accepted', 'accepted')->name('accepted');
            Route::get('rejected', 'rejected')->name('rejected');
            // Accept Ticket
            Route::post('accept/{ticket}', 'accept')->name('accept');
            // Reject Ticket
            Route::post('reject/{ticket}', 'reject')->name('reject');
        });
    });


    Route::prefix('project')->name('project.')->controller(ProjectController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('update', 'update')->name('update');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('destory/{id}', 'destory')->name('destory');
        });
    });
});


///Route for user
Route::prefix('admin')->name('user.')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('login', 'login')->name('login')->middleware('redirectIfAuthenticated');
        Route::post('authenticate', 'authenticate')->name('authenticate');
        Route::get('logout', 'logout')->name('logout');
    });
});


Route::prefix('employee')->middleware(['isEmployee', 'officeWifi'])->name('employee.')->group(function () {

    Route::prefix('ticket')->name('ticket.')->group(function () {
        Route::controller(TicketController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('/show/{ticket}', 'show')->name('show');
        });
    });
    Route::controller(EmployeeIndexController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('logout', 'logout')->name('logout');
    });

    Route::prefix('client')->controller(EmployeeClientindexController::class)->name('client.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{client}', 'edit')->name('edit');
        Route::post('update', 'update')->name('update');
        Route::get('/search', 'search')->name('search');
        Route::get('/fetch', 'fetchClient')->name('fetch');
    });


    Route::prefix('project')->controller(ProjectIndexController::class)->name('project.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::prefix('attendance')->controller(AttendanceContoller::class)->name('attendance.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('checkin', 'checkin')->name('checkin');
        Route::post('checkout', 'checkout')->name('checkout');
    });



    // Route::controller(EmployeeController::class)->group(function () {
    //     Route::get('login', 'login')->name('login')->middleware('redirectIfAuthenticated');
    //     Route::post('authenticate', 'authenticate')->name('authenticate');
    //     Route::get('logout', 'logout')->name('logout');
    // });
});


Route::prefix('employee')->name('employee.')->group(function () {
    Route::controller(EmployeeIndexController::class)->group(function () {
        Route::get('login', 'login')->name('login')->middleware('RedirectIfEmployeeAuthenticated');
            Route::post('authenticate', 'authenticate')->name('authenticate');
    });
});


Route::get('/product-subCategory/create', [EmployeeIndexController::class, 'subCategory'])->name('get/sub/department');
Route::controller(temp_filesController::class)->group(function () {
    Route::post('create', 'create')->name('temp_file.create');
});
