<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $AssignmentId
 * @property int $TaskId
 * @property int $UserId
 * @property string|null $RoleInTask
 * @property string|null $AssignedAt
 * @property string|null $DueDate
 * @property string|null $Status
 * @property string|null $Notes
 * @property string|null $CompletionDate
 * @property-read \App\Models\Task $task
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\TaskAssignmentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskAssignment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskAssignment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskAssignment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskAssignment whereAssignedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskAssignment whereAssignmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskAssignment whereCompletionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskAssignment whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskAssignment whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskAssignment whereRoleInTask($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskAssignment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskAssignment whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskAssignment whereUserId($value)
 * @mixin \Eloquent
 */
class TaskAssignment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'TaskId', 'UserId', 'RoleInTask', 'AssignedAt', 'DueDate', 'Status', 'Notes', 'CompletionDate'
    ];
    protected $table = 'taskassignments';
    public function task()
    {
        return $this->belongsTo(Task::class, 'TaskId','TaskId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserId','UserId');
    }
}
