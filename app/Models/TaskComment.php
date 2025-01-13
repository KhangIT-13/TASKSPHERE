<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $CommentId
 * @property int $TaskId
 * @property int $UserId
 * @property string $Comment
 * @property string|null $CreatedAt
 * @property-read \App\Models\Task $task
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\TaskCommentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskComment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskComment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskComment whereCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskComment whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskComment whereUserId($value)
 * @mixin \Eloquent
 */
class TaskComment extends Model
{
    use HasFactory;

    protected $fillable = ['TaskId', 'UserId', 'Comment'];
    protected $table = 'taskcomments';
    public function task()
    {
        return $this->belongsTo(Task::class, 'TaskId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserId');
    }
}
