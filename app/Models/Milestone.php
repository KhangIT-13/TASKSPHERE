<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $MilestoneId
 * @property int $ProjectId
 * @property string $MilestoneName
 * @property string|null $DueDate
 * @property string|null $Status
 * @property string|null $CreatedAt
 * @property-read \App\Models\Project $project
 * @method static \Database\Factories\MilestoneFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Milestone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Milestone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Milestone query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Milestone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Milestone whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Milestone whereMilestoneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Milestone whereMilestoneName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Milestone whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Milestone whereStatus($value)
 * @mixin \Eloquent
 */
class Milestone extends Model
{
    use HasFactory;

    protected $fillable = ['ProjectId', 'MilestoneName', 'DueDate', 'Status'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'ProjectId');
    }
}
