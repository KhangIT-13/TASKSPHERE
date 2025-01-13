<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $LogId
 * @property string $ActionType
 * @property string $ActionDescription
 * @property int $UserId
 * @property string|null $Timestamp
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\AuditLogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereActionDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereActionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereLogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereUserId($value)
 * @mixin \Eloquent
 */
class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = ['ActionType', 'ActionDescription', 'UserId'];
    protected $table = 'Auditlogs';
    public function user()
    {
        return $this->belongsTo(User::class, 'UserId');
    }
}
