<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $TaskId
 * @property int $ProjectId
 * @property string $TaskName
 * @property string|null $Description
 * @property int|null $AssignedTo
 * @property string|null $Status
 * @property string|null $Priority
 * @property \Illuminate\Support\Carbon|null $StartDate
 * @property \Illuminate\Support\Carbon|null $DueDate
 * @property \Illuminate\Support\Carbon|null $CompletedAt
 * @property string|null $CreatedAt
 * @property-read \App\Models\User|null $assignedToUser
 * @property-read \App\Models\Project $project
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subtask> $subtasks
 * @property-read int|null $subtasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TaskAssignment> $taskAssignments
 * @property-read int|null $task_assignments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TaskComment> $taskComments
 * @property-read int|null $task_comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TaskFile> $taskfiles
 * @property-read int|null $taskfiles_count
 * @method static \Database\Factories\TaskFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereAssignedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereTaskName($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'ProjectId', 'TaskName', 'Description', 'AssignedTo', 'Status', 'Priority', 'StartDate', 'DueDate', 'CompletedAt'
    ];
    protected $casts = [
        'StartDate'=> 'datetime',
        'DueDate' => 'datetime',
        'CompletedAt'=> 'datetime',
    ];
    
    protected $primaryKey = 'TaskId';
    public function project()
    {
        return $this->belongsTo(Project::class, 'ProjectId');
    }

    // public function assignedToUser()
    // {
    //     return $this->belongsTo(User::class, 'AssignedTo');
    // }
    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'taskassignments', 'TaskId', 'UserId')
                    ->withPivot('RoleInTask'); // Nếu có cột khác trong bảng trung gian
                    // ->withTimestamps();
    }
    public function taskAssignments()
    {
        return $this->hasMany(TaskAssignment::class,'TaskId','TaskId');
    }

    public function taskComments()
    {
        return $this->hasMany(TaskComment::class);
    }
    public function subtasks()
    {
        return $this->hasMany(Subtask::class, 'TaskId', 'TaskId');
    }
    public function taskfiles(){
        return $this->hasMany(TaskFile::class,'TaskId','TaskId');
    }
    
}
