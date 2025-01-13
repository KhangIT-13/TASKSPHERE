<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int|null $TaskId
 * @property string $filename
 * @property string $filepath
 * @property string|null $filetype
 * @property int|null $uploadedby
 * @property string|null $createdat
 * @property string|null $updatedat
 * @property-read \App\Models\Task|null $task
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskFile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskFile whereCreatedat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskFile whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskFile whereFilepath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskFile whereFiletype($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskFile whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskFile whereUpdatedat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskFile whereUploadedby($value)
 * @mixin \Eloquent
 */
class TaskFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'taskid', 'filename', 'filepath', 'filetype', 'uploadedby',
    ];
    protected $table = 'TaskFiles';
    protected $primaryKey = 'SubTaskId';
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'uploadedby');
    }
}
