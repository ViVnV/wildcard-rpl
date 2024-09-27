<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $account_id
 * @property int $model_id
 * @property string $model_type
 * @property string $key
 * @property mixed $value
 * @property string $created_at
 * @property string $updated_at
 * @property Post $post
 */
class PostMeta extends Model
{
    protected $fillable = [
        'post_id',
        'model_id',
        'model_type',
        'key',
        'value',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'value' => 'json',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
