<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $ProjectId
 * @property string $ProjectName
 * @property string|null $Description
 * @property int $CreatedBy
 * @property int|null $CategoryId
 * @property string|null $Status
 * @property \Illuminate\Support\Carbon|null $StartDate
 * @property \Illuminate\Support\Carbon|null $EndDate
 * @property string|null $CreatedAt
 * @property-read \App\Models\ProjectCategory|null $category
 * @property-read \App\Models\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Issue> $issues
 * @property-read int|null $issues_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $members
 * @property-read int|null $members_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Milestone> $milestones
 * @property-read int|null $milestones_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectFile> $projectfiles
 * @property-read int|null $projectfiles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read int|null $tasks_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereProjectName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStatus($value)
 * @mixin \Eloquent
 */
class Project extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'ProjectName', 'Description', 'CreatedBy', 'CategoryId', 'Status', 'StartDate', 'EndDate'
    ];
    protected $casts = [
        'StartDate' => 'datetime',
        'EndDate' => 'datetime',
    ];
    
    protected $primaryKey = 'ProjectId';
    protected $table = 'projects';

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'CategoryId');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'CreatedBy', 'UserId');
    }
    

    public function members()
    {
        return $this->belongsToMany(User::class, 'projectmembers', 'ProjectId', 'UserId')
                    ->withPivot('RoleInProject', 'JoinedAt');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class,'ProjectId','ProjectId');
    }
    

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }

    public function issues()
    {
        return $this->hasMany(Issue::class,"ProjectId","ProjectId");
    }
    public function projectfiles(){
        return $this->hasMany(ProjectFile::class, "ProjectId");
    }
}
