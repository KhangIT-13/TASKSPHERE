<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Thừa kế từ Authenticatable để hỗ trợ xác thực
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
// /**
//  * @property \Illuminate\Database\Eloquent\Collection $projects
//  */
/**
 * 
 *
 * @property int $UserId
 * @property string $FullName
 * @property string $Email
 * @property string $PasswordHash
 * @property string|null $Role
 * @property string|null $CreatedAt
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AuditLog> $auditLogs
 * @property-read int|null $audit_logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Issue> $issuesAssigned
 * @property-read int|null $issues_assigned_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Issue> $issuesReported
 * @property-read int|null $issues_reported_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectMember> $projectMembers
 * @property-read int|null $project_members_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TaskAssignment> $taskAssignments
 * @property-read int|null $task_assignments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TaskComment> $taskComments
 * @property-read int|null $task_comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read int|null $tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasksAssigned
 * @property-read int|null $tasks_assigned_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePasswordHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUserId($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable; // Thêm Notifiable để hỗ trợ gửi thông báo

    // Tắt timestamps nếu không cần
    public $timestamps = false;

    // Đặt tên bảng nếu không phải bảng mặc định (Laravel sử dụng 'users' theo mặc định)
    protected $table = 'users';

    // Đặt khóa chính là 'UserId'
    protected $primaryKey = 'UserId';

    // Các trường có thể gán giá trị (fillable)
    protected $fillable = [
        'FullName',
        'Email',
        'PasswordHash',
        'Role'
    ];

    // Cung cấp phương thức lấy mật khẩu cho xác thực
    public function getAuthPassword()
    {
        return $this->PasswordHash; // Lấy trường mật khẩu Hash
    }

    // Quan hệ một-nhiều với các bảng khác (các mối quan hệ Eloquent)
    // public function projects()
    // {
    //     return $this->hasMany(Project::class, 'CreatedBy');

    // }
    public function projects() : BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'projectmembers', 'UserId', 'ProjectId')
            ->withPivot('RoleInProject', 'JoinedAt'); // Nếu bạn cần thông tin bổ sung từ bảng pivot
    }
    public function tasks(): BelongsToMany{
        return $this->belongsToMany(Task::class,'taskassignments','UserId','TaskId')->withPivot('RoleInTask');
    }
    // public function tasks()
    // {
    //     return $this->belongsToMany(Task::class, 'task_assignments', 'UserId', 'TaskId')
    //                 ->withPivot('RoleInTask') // Nếu có cột khác trong bảng trung gian
    //                 ->withTimestamps();
    // }
    public function projectMembers()
    {
        return $this->hasMany(ProjectMember::class);
    }

    public function tasksAssigned()
    {
        return $this->hasMany(Task::class, 'AssignedTo');
    }

    public function taskAssignments()
    {
        return $this->hasMany(TaskAssignment::class);
    }
    public function subtasks(){
        return $this->hasMany(Subtask::class,"AssignedTo","UserId");
    }
    public function taskComments()
    {
        return $this->hasMany(TaskComment::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }

    public function issuesReported()
    {
        return $this->hasMany(Issue::class, 'ReportedBy');
    }
    
    public function issuesAssigned()
    {
        return $this->hasMany(Issue::class, 'AssignedTo');
    }

    // Phương thức đăng ký người dùng mới (nếu có)
    public static function createNewUser($data)
    {
        // Hash mật khẩu trước khi lưu
        $data['PasswordHash'] = Hash::make($data['PasswordHash']);

        // Tạo người dùng mới
        return self::create($data);
    }

    // Nếu bạn muốn kiểm tra mật khẩu khi đăng nhập
    public function checkPassword($password)
    {
        return Hash::check($password, $this->PasswordHash);
    }
}
