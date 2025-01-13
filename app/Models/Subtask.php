<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $SubTaskId
 * @property int $TaskId
 * @property string $SubTaskName
 * @property string|null $Description
 * @property int|null $AssignedTo
 * @property string|null $Status
 * @property string|null $Priority
 * @property \Illuminate\Support\Carbon|null $StartDate
 * @property \Illuminate\Support\Carbon|null $DueDate
 * @property \Illuminate\Support\Carbon|null $CompletedAt
 * @property string|null $CreatedAt
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubtaskFile> $subtaskfiles
 * @property-read int|null $subtaskfiles_count
 * @property-read \App\Models\Task $task
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subtask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subtask newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subtask query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subtask whereAssignedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subtask whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subtask whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subtask whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subtask whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subtask wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subtask whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subtask whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subtask whereSubTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subtask whereSubTaskName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subtask whereTaskId($value)
 * @mixin \Eloquent
 */
class Subtask extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'TaskId',
        'SubTaskName',
        'Description',
        'AssignedTo',
        'Status',
        'Priority',
        'StartDate',
        'DueDate',
        'CompletedAt',
    ];
    protected $casts = [
        'StartDate' => 'datetime',
        'DueDate' => 'datetime',
        'CompletedAt' => 'datetime',
    ];
    protected $primaryKey = 'SubTaskId';
    // Quan hệ với Task
    public function task()
    {
        return $this->belongsTo(Task::class, 'TaskId', 'TaskId');
    }

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class, 'AssignedTo');
    }

    public function subtaskfiles(){
        return $this->hasMany(SubtaskFile::class,'SubtaskId',);
    }
}
