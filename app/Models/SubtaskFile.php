<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int|null $SubtaskId
 * @property string $filename
 * @property string $filepath
 * @property string|null $filetype
 * @property int|null $uploadedby
 * @property string|null $createdat
 * @property string|null $updatedat
 * @property-read \App\Models\Subtask|null $subtask
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubtaskFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubtaskFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubtaskFile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubtaskFile whereCreatedat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubtaskFile whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubtaskFile whereFilepath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubtaskFile whereFiletype($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubtaskFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubtaskFile whereSubtaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubtaskFile whereUpdatedat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubtaskFile whereUploadedby($value)
 * @mixin \Eloquent
 */
class SubtaskFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'subtaskid', 'filename', 'filepath', 'filetype', 'uploadedby',
    ];
    protected $table = "SubtaskFiles";
    public function subtask()
    {
        return $this->belongsTo(Subtask::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'uploadedby');
    }
}
