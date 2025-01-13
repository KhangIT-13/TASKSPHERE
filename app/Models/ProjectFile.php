<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int|null $ProjectId
 * @property string $filename
 * @property string $filepath
 * @property string|null $filetype
 * @property int|null $uploadedby
 * @property string|null $createdat
 * @property string|null $updatedat
 * @property-read \App\Models\Project|null $project
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectFile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectFile whereCreatedat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectFile whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectFile whereFilepath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectFile whereFiletype($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectFile whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectFile whereUpdatedat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectFile whereUploadedby($value)
 * @mixin \Eloquent
 */
class ProjectFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'ProjectId', 'filename', 'filepath', 'filetype', 'uploadedby',
    ];
    protected $table = "ProjectFiles";
    public function project()
    {
        return $this->belongsTo(Project::class,"ProjectId");
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'uploadedby');
    }
}
