<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $CategoryId
 * @property string $CategoryName
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 * @method static \Database\Factories\ProjectCategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectCategory whereCategoryName($value)
 * @mixin \Eloquent
 */
class ProjectCategory extends Model
{
    use HasFactory;

    protected $fillable = ['CategoryName'];
    protected $primaryKey = 'CategoryId';
    protected $table = 'projectcategories';

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
