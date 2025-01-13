<?php

use App\Http\Controllers\API\AuditLogController;
use App\Http\Controllers\API\IssueController;
use App\Http\Controllers\API\MilestoneController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\ProjectCategoryController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\ProjectFileController;
use App\Http\Controllers\API\ProjectMemberController;
use App\Http\Controllers\api\SubtaskController;
use App\Http\Controllers\API\TaskAssignmentController;
use App\Http\Controllers\API\TaskCommentController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController as ProjectControllerMain;
use App\Http\Controllers\TaskController as TaskControllerMain;
use App\Http\Controllers\SubtaskController as SubtaskControllerMain;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Thêm dòng sau để cấu hình auth routes
Auth::routes();

// Route::get('/', function () {
//     return view('dashboard');
// });
// Route::get('dash', function () {
//     return view('project.project-dash');
// });


// Route::get('/projectfile', [ProjectFileController::class, 'index'])->name('projectfile');
// Route::get('/taskdetail', function () {
//     return view('task.task-detail');
// });

// Route::prefix('project')->group(function () {
//     Route::get('/', [ProjectControllerMain::class, 'index'])->name('project.index');
//     Route::get('/dash', [ProjectControllerMain::class, 'dash'])->name('project.dash');
//     Route::get('/detail', function () {
//         return view('project.project-detail');
//     });
//     Route::get('/add', [ProjectControllerMain::class, 'add'])->name('project.add');
//     Route::post('/create', [ProjectControllerMain::class, 'create'])->name('project.create');
//     Route::get('/detail/{id}', [ProjectControllerMain::class, 'detail'])->name('project.detail');
//     Route::post('/projects/update-status', [ProjectControllerMain::class, 'updateStatus'])->name('projects.updateStatus');
//     Route::post('/projects/update-start-date', [ProjectControllerMain::class, 'updateStartDate'])->name('projects.updateStartDate');
//     Route::post('/projects/update-end-date', [ProjectControllerMain::class, 'updateEndDate'])->name('projects.updateEndDate');
//     Route::get('/addmember/{ProjectId}', [ProjectControllerMain::class, 'add_member'])->name('project.project-add-member');
//     Route::post('/createmember', [ProjectControllerMain::class, 'createMember'])->name('project.createmember');

//     Route::get('/edit/{id}', [ProjectControllerMain::class, 'edit'])->name('project.edit');
//     Route::post('/{id}', [ProjectControllerMain::class, 'update'])->name('project.update');

//     Route::delete('/{id}', [ProjectControllerMain::class, 'delete'])->name('project.delete');

// });


// Route::prefix('task')->group(function () {
//     Route::get('/{ProjectId}', [TaskControllerMain::class, 'index'])->name('task.index');
//     Route::get('/detail/{id}', [TaskControllerMain::class, 'detail'])->name('task.detail');
// });


// Route::prefix('subtask')->group(function () {
//     Route::get('/{TaskId}', [SubtaskControllerMain::class, 'index'])->name('subtask.index');
//     Route::get('/detail/{id}', [SubtaskControllerMain::class, 'detail'])->name('subtask.detail');
// });

// Route::prefix('auth')->name('auth.')->group(function () {
//     // Route cho trang đăng nhập
//     Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
//     Route::post('login', [AuthController::class, 'login']);

//     // Route cho trang đăng ký (nếu cần thiết)
//     Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
//     Route::post('register', [AuthController::class, 'register']);

//     // Route cho đăng xuất
//     Route::post('logout', [AuthController::class, 'logout'])->name('logout');
// });

// Middleware auth cho route cần đăng nhập
Route::middleware(['web', 'checkLogin'])->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    });
    Route::prefix('home')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
    });
    // Route cho Project
    Route::prefix('project')->group(function () {
        Route::get('/', [ProjectControllerMain::class, 'dash']);
        Route::get('/list', [ProjectControllerMain::class, 'index'])->name('project.index');
        Route::get('/dash', [ProjectControllerMain::class, 'dash'])->name('project.dash');
        Route::get('/add', [ProjectControllerMain::class, 'add'])->name('project.add');
        Route::post('/create', [ProjectControllerMain::class, 'create'])->name('project.create');
        Route::get('/detail/{id}', [ProjectControllerMain::class, 'detail'])->name('project.detail');
        Route::post('/projects/update-status', [ProjectControllerMain::class, 'updateStatus'])->name('projects.updateStatus');
        Route::post('/projects/update-start-date', [ProjectControllerMain::class, 'updateStartDate'])->name('projects.updateStartDate');
        Route::post('/projects/update-end-date', [ProjectControllerMain::class, 'updateEndDate'])->name('projects.updateEndDate');
        Route::get('/listmember/{ProjectId}', [ProjectControllerMain::class, 'member_list'])->name('project.list_member');
        Route::get('/addmember/{ProjectId}', [ProjectControllerMain::class, 'add_member'])->name('project.project-add-member');
        Route::post('/member/update-role', [ProjectControllerMain::class, 'updateRole'])->name('project.member.updateRole');
        Route::post('/createmember', [ProjectControllerMain::class, 'createMember'])->name('project.createmember');
        Route::post('/projectmembers/delete', [ProjectControllerMain::class, 'deleteMember'])->name('project.projectmembers.delete');
        Route::get('/edit/{id}', [ProjectControllerMain::class, 'edit'])->name('project.edit');
        Route::post('/{id}', [ProjectControllerMain::class, 'update'])->name('project.update');
        Route::delete('/{id}', [ProjectControllerMain::class, 'delete'])->name('project.delete');

        Route::get('/{projectId}/members', [ProjectControllerMain::class, 'getProjectMembers']);
    });

    // Route cho Task
    Route::get('/test/{TaskId}', [TaskControllerMain::class,'edit']);
    // Route::prefix('tasks')->group(function () {
    //     Route::get('/',[TaskControllerMain::class,'index'])->name('tasks.index');
    //     Route::get('/addtask', [TaskControllerMain::class,'create'])->name('tasks.addtask');
    //     Route::get('/dash', [TaskControllerMain::class,'dash'])->name('tasks.dash');
    //     Route::get('/detail/{TaskId}', [TaskControllerMain::class, 'detail'])->name('tasks.detail');
    //     Route::post('/create', [TaskControllerMain::class,'store'])->name('tasks.create');
    //     Route::get('/edit/{TaskId}', [TaskControllerMain::class,'edit'])->name('tasks.edit');

    //     Route::post('/update-field', [TaskControllerMain::class, 'updateField'])->name('tasks.updateField');
    //     Route::post('/update/{id}', [TaskControllerMain::class,'update'])->name('tasks.update');

    //     // member
    //     Route::get('/members/{TaskId}', [TaskControllerMain::class,'members'])->name('tasks.members');
    //     Route::get('/addmember/{TaskId}', [TaskControllerMain::class,'addMember'])->name('tasks.addMember');
    //     Route::post('/createMember', [TaskControllerMain::class,'createMember'])->name('tasks.createMember');
    //     Route::post('/update-member-role', [TaskControllerMain::class,'updateMemberRole'])->name('tasks.updateMemberRole');
    //     Route::post('/deletemember', [TaskControllerMain::class,'deleteMember'])->name('tasks.deleteProjectMember');
    //     Route::get('/{TaskId}/members', [TaskControllerMain::class,'getTaskMembers']);
    //     Route::get('/{ProjectId}', [TaskControllerMain::class,'tasksWithProject'])->name('tasks.tasksWithProject');

    // });
    Route::prefix('tasks')->group(function () {
        Route::get('/', [TaskControllerMain::class, 'index'])->name('tasks.index');
        Route::get('/addtask', [TaskControllerMain::class, 'create'])->name('tasks.addtask');
        Route::get('/dash', [TaskControllerMain::class, 'dash'])->name('tasks.dash');
        Route::get('/detail/{TaskId}', [TaskControllerMain::class, 'detail'])->name('tasks.detail');
        Route::get('/edit/{TaskId}', [TaskControllerMain::class, 'edit'])->name('tasks.edit');
        Route::post('/create', [TaskControllerMain::class, 'store'])->name('tasks.create');
    
        Route::post('/update-field', [TaskControllerMain::class, 'updateField'])->name('tasks.updateField');
        Route::post('/update/{id}', [TaskControllerMain::class, 'update'])->name('tasks.update');
    
        // Member routes
        Route::get('/members/{TaskId}', [TaskControllerMain::class, 'members'])->name('tasks.members');
        Route::get('/addmember/{TaskId}', [TaskControllerMain::class, 'addMember'])->name('tasks.addMember');
        Route::post('/createMember', [TaskControllerMain::class, 'createMember'])->name('tasks.createMember');
        Route::post('/update-member-role', [TaskControllerMain::class, 'updateMemberRole'])->name('tasks.updateMemberRole');
        Route::post('/deletemember', [TaskControllerMain::class, 'deleteMember'])->name('tasks.deleteProjectMember');
        Route::get('/{TaskId}/members', [TaskControllerMain::class, 'getTaskMembers']);
    
        // Place the dynamic project route at the end
        Route::get('/{ProjectId}', [TaskControllerMain::class, 'tasksWithProject'])->name('tasks.tasksWithProject');
    });
    
    // Route cho Subtask
    Route::prefix('subtask')->group(function () {
        Route::get('/', [SubtaskControllerMain::class, 'index'])->name('subtask.index');
        Route::get('/subtasklist', [SubtaskControllerMain::class,'list'])->name('subtask.subtasklist');
        Route::get('/dash', [SubtaskControllerMain::class,'dash'])->name('subtask.dash');
        Route::get('/detail/{id}', [SubtaskControllerMain::class, 'detail'])->name('subtask.detail');
        Route::get('/add-subtask', [SubtaskControllerMain::class,'addsubtask'])->name('subtask.addSubtask');
        Route::post('/create', [SubtaskControllerMain::class,'store'])->name('subtask.create');
        Route::post('/update-field', [SubtaskControllerMain::class, 'updateField'])->name('subtask.updateField');
        Route::post('/complete', [SubtaskControllerMain::class, 'complete'])->name('subtask.complete');

        Route::get('/{TaskId}', [SubtaskControllerMain::class,'subtasksWithTask'])->name('subtask.subtasksWithTask');

    });

    // Route cho Logout
    Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class,'index'])->name('profile.me');
    });
});

// Route cho Auth (không cần đăng nhập)
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);

    Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgotpass');
    Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail']);

    Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('resetpass');
    Route::post('resetpassword', [AuthController::class, 'resetPassword'])->name('resetpassword');
});


// ------------------------API-------------------------------------------------------------
// Route::prefix('api')->group(function () {
//     Route::prefix('users')->group(function () {
//         Route::get('/', [UserController::class, 'index'])->name('users.index');
//         Route::post('/', [UserController::class, 'store'])->name('users.store');
//         Route::get('{userid}', [UserController::class, 'show'])->name('users.show');
//         Route::put('{id}', [UserController::class, 'update'])->name('users.update');
//         Route::delete('{id}', [UserController::class, 'destroy'])->name('users.destroy');
//     });
//     Route::prefix('project-categories')->group(function () {
//         Route::get('/', [ProjectCategoryController::class, 'index'])->name('project-categories.index');
//         Route::post('/', [ProjectCategoryController::class, 'store'])->name('project-categories.store');
//         Route::get('{id}', [ProjectCategoryController::class, 'show'])->name('project-categories.show');
//         Route::put('{id}', [ProjectCategoryController::class, 'update'])->name('project-categories.update');
//         Route::delete('{id}', [ProjectCategoryController::class, 'destroy'])->name('project-categories.destroy');
//     });

//     Route::prefix('projects')->group(function () {
//         Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
//         Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
//         Route::put('{id}', [ProjectController::class, 'update'])->name('projects.update');
//         Route::delete('{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
//     });

//     Route::prefix('project-members')->group(function () {
//         Route::get('/', [ProjectMemberController::class, 'index'])->name('project-members.index');
//         Route::post('/', [ProjectMemberController::class, 'store'])->name('project-members.store');
//         Route::get('{id}', [ProjectMemberController::class, 'show'])->name('project-members.show');
//         Route::put('{id}', [ProjectMemberController::class, 'update'])->name('project-members.update');
//         Route::delete('{id}', [ProjectMemberController::class, 'destroy'])->name('project-members.destroy');
//     });
//     Route::prefix('tasks')->group(function () {
//         Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
//         Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
//         Route::get('{id}', [TaskController::class, 'show'])->name('tasks.show');
//         Route::put('{id}', [TaskController::class, 'update'])->name('tasks.update');
//         Route::delete('{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
//     });
//     Route::prefix('task-assignments')->group(function () {
//         Route::get('/', [TaskAssignmentController::class, 'index'])->name('task-assignments.index');
//         Route::post('/', [TaskAssignmentController::class, 'store'])->name('task-assignments.store');
//         Route::get('{id}', [TaskAssignmentController::class, 'show'])->name('task-assignments.show');
//         Route::put('{id}', [TaskAssignmentController::class, 'update'])->name('task-assignments.update');
//         Route::delete('{id}', [TaskAssignmentController::class, 'destroy'])->name('task-assignments.destroy');
//     });
//     Route::prefix('task-comments')->group(function () {
//         Route::get('/', [TaskCommentController::class, 'index'])->name('task-comments.index');
//         Route::post('/', [TaskCommentController::class, 'store'])->name('task-comments.store');
//         Route::get('{id}', [TaskCommentController::class, 'show'])->name('task-comments.show');
//         Route::put('{id}', [TaskCommentController::class, 'update'])->name('task-comments.update');
//         Route::delete('{id}', [TaskCommentController::class, 'destroy'])->name('task-comments.destroy');
//     });

//     Route::prefix('milestones')->group(function () {
//         Route::get('/', [MilestoneController::class, 'index'])->name('milestones.index');
//         Route::post('/', [MilestoneController::class, 'store'])->name('milestones.store');
//         Route::get('{id}', [MilestoneController::class, 'show'])->name('milestones.show');
//         Route::put('{id}', [MilestoneController::class, 'update'])->name('milestones.update');
//         Route::delete('{id}', [MilestoneController::class, 'destroy'])->name('milestones.destroy');
//     });
//     Route::prefix('notifications')->group(function () {
//         Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
//         Route::post('/', [NotificationController::class, 'store'])->name('notifications.store');
//         Route::get('{id}', [NotificationController::class, 'show'])->name('notifications.show');
//         Route::put('{id}', [NotificationController::class, 'update'])->name('notifications.update');
//         Route::delete('{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
//     });
//     Route::prefix('audit-logs')->group(function () {
//         Route::get('/', [AuditLogController::class, 'index'])->name('audit-logs.index');
//         Route::get('{id}', [AuditLogController::class, 'show'])->name('audit-logs.show');
//     });
//     Route::prefix('issues')->group(function () {
//         Route::get('/', [IssueController::class, 'index'])->name('issues.index');
//         Route::post('/', [IssueController::class, 'store'])->name('issues.store');
//         Route::get('{id}', [IssueController::class, 'show'])->name('issues.show');
//         Route::put('{id}', [IssueController::class, 'update'])->name('issues.update');
//         Route::delete('{id}', [IssueController::class, 'destroy'])->name('issues.destroy');
//     });
//     // Group routes for Subtasks
//     Route::prefix('subtasks')->group(function () {
//         Route::get('/', [SubtaskController::class, 'index'])->name('index'); // Danh sách subtasks
//         Route::get('/create', [SubtaskController::class, 'create'])->name('create'); // Form tạo subtask mới
//         Route::post('/', [SubtaskController::class, 'store'])->name('store'); // Lưu subtask mới
//         Route::get('/{id}', [SubtaskController::class, 'show'])->name('show'); // Xem chi tiết subtask
//         Route::get('/{id}/edit', [SubtaskController::class, 'edit'])->name('edit'); // Form sửa subtask
//         Route::put('/{id}', [SubtaskController::class, 'update'])->name('update'); // Cập nhật subtask
//         Route::delete('/{id}', [SubtaskController::class, 'destroy'])->name('destroy'); // Xóa subtask
//     });
// });
