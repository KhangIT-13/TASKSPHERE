<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $IssueId
 * @property int $ProjectId
 * @property int|null $TaskId
 * @property int $ReportedBy
 * @property int|null $AssignedTo
 * @property string $Title
 * @property string $Description
 * @property string|null $Priority
 * @property string|null $Status
 * @property string|null $CreatedAt
 * @property string|null $ResolvedAt
 * @property-read \App\Models\User|null $assignedTo
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\User $reportedBy
 * @property-read \App\Models\Task|null $task
 * @method static \Database\Factories\IssueFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereAssignedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereIssueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereReportedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereResolvedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereTitle($value)
 * @mixin \Eloquent
 */
class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'ProjectId', 'TaskId', 'ReportedBy', 'AssignedTo', 'Title', 'Description', 'Priority', 'Status', 'ResolvedAt'
    ];
    protected $primaryKey = 'IssueId';
    public function project()
    {
        return $this->belongsTo(Project::class, 'ProjectId');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'TaskId');
    }

    public function reportedBy()
    {
        return $this->belongsTo(User::class, 'ReportedBy');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'AssignedTo');
    }
}
