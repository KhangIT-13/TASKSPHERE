<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $ProjectMemberId
 * @property int $ProjectId
 * @property int $UserId
 * @property string|null $RoleInProject
 * @property string|null $JoinedAt
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ProjectMemberFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectMember query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectMember whereJoinedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectMember whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectMember whereProjectMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectMember whereRoleInProject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectMember whereUserId($value)
 * @mixin \Eloquent
 */
class ProjectMember extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['ProjectId', 'UserId', 'RoleInProject', 'JoinedAt'];
    protected $table = 'projectmembers';
    protected $primaryKey = 'ProjectMemberId';

    public function project()
    {
        return $this->belongsTo(Project::class, 'ProjectId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserId','UserId');
    }
}
